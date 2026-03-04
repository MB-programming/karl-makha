<?php
// ================================================
// Public API — Returns all active site data
// File-cached: cache HIT = 0 DB queries
// ================================================
// Suppress PHP errors/warnings from corrupting JSON output
ini_set('display_errors', 0);
error_reporting(0);
require_once __DIR__ . '/config.php';

// ── Cache setup ──────────────────────────────────
$cacheDir  = __DIR__ . '/../cache/data/';
$cacheFile = $cacheDir . 'api_response.json';
$metaFile  = $cacheDir . 'api_meta.json';

// ── Fast path: serve from file (no DB) ───────────
if (is_file($cacheFile) && is_file($metaFile)) {
    $meta = json_decode(file_get_contents($metaFile), true) ?: [];
    $age  = time() - (int)($meta['written_at'] ?? 0);
    $ttl  = max(60, (int)($meta['ttl'] ?? 300));
    if ($age < $ttl) {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Cache-Control: public, max-age=' . ($ttl - $age));
        header('X-Cache: HIT');
        readfile($cacheFile);
        exit;
    }
}

// ── Slow path: query the database ────────────────
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Vary: Accept-Encoding');
header('X-Cache: MISS');

try {
    $db = getDB();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database unavailable'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Settings first (controls cache TTL + feature flags)
$settings = [];
try {
    $settingsRows = $db->query("SELECT `key`, value FROM settings")->fetchAll();
    foreach ($settingsRows as $r) $settings[$r['key']] = $r['value'];
} catch (Exception $e) {}

$cacheEnabled = ($settings['perf_cache_api'] ?? '1') !== '0';
$cacheTTL     = max(60, (int)($settings['cache_ttl'] ?? 300));

// Branches
$branches   = [];
$hours_map  = [];
try {
    $branches = $db->query("
        SELECT id, name_ar, name_en, city_ar, city_en, address_ar, address_en, phone, map_url, sort_order
        FROM branches WHERE is_active = 1
        ORDER BY sort_order ASC, city_ar ASC
        LIMIT 200
    ")->fetchAll();

    $hours_rows = $db->query("
        SELECT branch_id, day_type, day_label, opens_at, closes_at, is_closed, note, sort_order
        FROM branch_hours
        WHERE is_active = 1
        ORDER BY branch_id ASC, sort_order ASC, id ASC
    ")->fetchAll();

    foreach ($hours_rows as $h) {
        $hours_map[$h['branch_id']][] = [
            'day_type'  => $h['day_type'],
            'day_label' => $h['day_label'],
            'opens_at'  => substr($h['opens_at'],  0, 5),
            'closes_at' => substr($h['closes_at'], 0, 5),
            'is_closed' => (bool)$h['is_closed'],
            'note'      => $h['note'],
        ];
    }
    foreach ($branches as &$b) {
        $b['working_hours'] = $hours_map[$b['id']] ?? [];
    }
    unset($b);
} catch (Exception $e) {
    $branches = [];
}

// Categories, Brands, Social, Contact
$categories = [];
try {
    $categories = $db->query("
        SELECT id, name_ar, slug, icon, description
        FROM categories WHERE is_active = 1
        ORDER BY sort_order ASC, id ASC LIMIT 200
    ")->fetchAll();
} catch (Exception $e) {}

$brands = [];
try {
    $brands = $db->query("
        SELECT id, name_ar, name_en, logo_url, website_url, sort_order
        FROM brands WHERE is_active = 1
        ORDER BY sort_order ASC, name_en ASC LIMIT 200
    ")->fetchAll();
} catch (Exception $e) {}

$social = [];
try {
    $social = $db->query("
        SELECT id, platform, platform_ar, url, username, icon, color, sort_order
        FROM social_media WHERE is_active = 1
        ORDER BY sort_order ASC LIMIT 50
    ")->fetchAll();
} catch (Exception $e) {}

$contact = [];
try {
    $contact = $db->query("
        SELECT id, type, value, label_ar
        FROM contact_info WHERE is_active = 1
        ORDER BY sort_order ASC LIMIT 50
    ")->fetchAll();
} catch (Exception $e) {}

// Articles from separate DB — hard 3-second connect timeout to prevent hangs
// PDO::MYSQL_ATTR_CONNECT_TIMEOUT is the correct constant for MySQL connection timeouts
// (PDO::ATTR_TIMEOUT only controls statement execution, not the initial TCP connect)
$articles = [];
try {
    $artPDO = new PDO(
        'mysql:host=localhost;dbname=makhazenalenaya_blogs;charset=utf8mb4;connect_timeout=3',
        'makhazenalenaya_blogs',
        '?BN0Mn5x$(K$',
        [
            PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES    => false,
            PDO::MYSQL_ATTR_CONNECT_TIMEOUT => 3,
        ]
    );
    $articles = $artPDO->query("
        SELECT id, title, slug, excerpt, cover_image, category, author_name, published_at, is_featured
        FROM articles
        WHERE is_active = 1
        ORDER BY is_featured DESC, sort_order ASC, created_at DESC
        LIMIT 50
    ")->fetchAll();
} catch (Exception $e) {
    $articles = [];
}

// ── Build response ────────────────────────────────
$response = json_encode([
    'success'    => true,
    'branches'   => $branches,
    'brands'     => $brands,
    'categories' => $categories,
    'articles'   => $articles,
    'social'     => $social,
    'contact'    => $contact,
    'settings'   => $settings,
], JSON_UNESCAPED_UNICODE);

// ── Write to file cache (atomic rename) ──────────
if ($cacheEnabled) {
    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0755, true);
        // Deny direct web access to cache directory
        file_put_contents($cacheDir . '.htaccess', "Deny from all\n");
    }
    $tmp = $cacheFile . '.tmp.' . getmypid();
    if (file_put_contents($tmp, $response, LOCK_EX) !== false) {
        rename($tmp, $cacheFile);
        file_put_contents($metaFile, json_encode([
            'written_at'   => time(),
            'ttl'          => $cacheTTL,
            'generated_at' => date('Y-m-d H:i:s'),
        ]));
    } else {
        @unlink($tmp);
    }
}

header('Cache-Control: public, max-age=' . $cacheTTL);
echo $response;
