<?php
// ================================================
// Clear Site Cache
// Protected: requires active admin session
// ================================================
require_once __DIR__ . '/config.php';
requireAuth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}

$cleared = [];

// 1. PHP OPcache
if (function_exists('opcache_reset') && opcache_reset()) {
    $cleared[] = 'OPcache';
}

// 2. Reset get_data.php cache header timestamp via settings
// (forces CDN/browser to re-fetch on next request with new ETag)
try {
    $db   = getDB();
    $stmt = $db->prepare("INSERT INTO settings (`key`, value, label_ar)
                          VALUES ('cache_cleared_at', :v, 'وقت مسح الكاش')
                          ON DUPLICATE KEY UPDATE value = :v2");
    $ts = date('Y-m-d H:i:s');
    $stmt->execute(['v' => $ts, 'v2' => $ts]);
    $cleared[] = 'Cache timestamp';
} catch (Exception $e) {
    // non-fatal
}

// 3. Any temp/cached files in a cache directory (if exists)
$cacheDir = __DIR__ . '/../cache/';
if (is_dir($cacheDir)) {
    $files = glob($cacheDir . '*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    $cleared[] = 'File cache';
}

$msg = count($cleared)
    ? 'تم مسح الكاش بنجاح: ' . implode(', ', $cleared)
    : 'تم تنفيذ الأمر — لا يوجد كاش مخزّن';

jsonResponse(['success' => true, 'message' => $msg]);
