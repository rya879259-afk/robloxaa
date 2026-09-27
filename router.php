<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($uri === '/capture') { require __DIR__ . '/capture.php'; return true; }
if ($uri === '/' || $uri === '/index.html') {
    header('Content-Type: text/html; charset=utf-8');
    readfile(__DIR__ . '/index.html');
    return true;
}
$file = __DIR__ . $uri;
if (file_exists($file) && is_file($file)) return false;
http_response_code(404);
echo 'not found';
return true;
