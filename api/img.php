<?php
/**
 * On-the-fly image resizer + WebP converter + proper cache headers
 * Usage: /api/img.php?src=logob.webp&w=340
 *        /api/img.php?src=pattern-1.webp&w=1440&q=60
 *
 * - Resizes to requested width (height auto)
 * - Converts to WebP for maximum compression
 * - Sets 1-year Cache-Control via PHP header() (works even if mod_headers disabled)
 * - Caches result to disk so subsequent requests skip resizing
 */

// Allowed source files (prevent path traversal)
$ALLOWED_EXTS = ['webp', 'jpg', 'jpeg', 'png', 'gif'];

$src  = trim($_GET['src'] ?? '');
$w    = max(10, min(3000, intval($_GET['w'] ?? 0)));
$q    = max(30, min(100, intval($_GET['q'] ?? 82)));  // WebP quality 1-100

// ── Validate ──────────────────────────────────────────────────
if (!$src) { http_response_code(400); exit('Missing src'); }

// Strip directory traversal
$src = ltrim(str_replace(['..', '\\'], '', $src), '/');
$ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));

if (!in_array($ext, $ALLOWED_EXTS, true)) {
    http_response_code(403); exit('Forbidden');
}

$root     = dirname(__DIR__);   // /home/user/karl-makha
$srcPath  = $root . '/' . $src;

if (!is_file($srcPath)) { http_response_code(404); exit('Not found'); }

// ── Cache lookup ──────────────────────────────────────────────
$cacheDir  = $root . '/cache/img/';
if (!is_dir($cacheDir)) mkdir($cacheDir, 0755, true);

$cacheKey  = md5($src . '|' . $w . '|' . $q) . '.webp';
$cachePath = $cacheDir . $cacheKey;
$srcMtime  = filemtime($srcPath);

// Serve headers helper
function serveWebP(string $data, int $srcMtime): void {
    $etag = '"' . md5($data) . '"';

    // 1-year cache — set via PHP so it ALWAYS works even without mod_headers
    header('Content-Type: image/webp');
    header('Cache-Control: public, max-age=31536000, immutable');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $srcMtime) . ' GMT');
    header('ETag: ' . $etag);
    header('Vary: Accept-Encoding');
    header('Content-Length: ' . strlen($data));

    // Handle conditional GET
    $ifNoneMatch  = trim($_SERVER['HTTP_IF_NONE_MATCH']  ?? '');
    $ifModSince   = trim($_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '');
    if ($ifNoneMatch === $etag ||
        ($ifModSince && strtotime($ifModSince) >= $srcMtime)) {
        http_response_code(304);
        exit;
    }

    echo $data;
    exit;
}

// Serve from disk cache if fresh
if (is_file($cachePath) && filemtime($cachePath) >= $srcMtime) {
    serveWebP(file_get_contents($cachePath), $srcMtime);
}

// ── Resize & Convert ──────────────────────────────────────────
// Load source image
$img = null;
switch ($ext) {
    case 'webp': $img = @imagecreatefromwebp($srcPath); break;
    case 'jpg':
    case 'jpeg': $img = @imagecreatefromjpeg($srcPath);  break;
    case 'png':  $img = @imagecreatefrompng($srcPath);   break;
    case 'gif':  $img = @imagecreatefromgif($srcPath);   break;
}

if (!$img) {
    // Fallback: serve original with cache headers
    serveWebP(file_get_contents($srcPath), $srcMtime);
}

$origW = imagesx($img);
$origH = imagesy($img);

// If no width requested, or image already smaller → serve as-is (just convert to webp)
if ($w <= 0 || $w >= $origW) {
    // Just re-encode as WebP without resizing
    ob_start();
    imagewebp($img, null, $q);
    $data = ob_get_clean();
    imagedestroy($img);
    file_put_contents($cachePath, $data);
    serveWebP($data, $srcMtime);
}

// Calculate proportional height
$newH = intval($origH * ($w / $origW));

// Create resized image
$resized = imagecreatetruecolor($w, $newH);

// Preserve transparency (for PNG / WebP with alpha)
imagealphablending($resized, false);
imagesavealpha($resized, true);
$transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
imagefilledrectangle($resized, 0, 0, $w, $newH, $transparent);

imagecopyresampled($resized, $img, 0, 0, 0, 0, $w, $newH, $origW, $origH);
imagedestroy($img);

// Encode to WebP
ob_start();
imagewebp($resized, null, $q);
$data = ob_get_clean();
imagedestroy($resized);

// Save to disk cache
file_put_contents($cachePath, $data);

serveWebP($data, $srcMtime);
