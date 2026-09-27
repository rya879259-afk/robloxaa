<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// /capture は capture.php に流す
if ($uri === '/capture') {
    require __DIR__ . '/capture.php';
    return true;
}

// ルートは index.html
if ($uri === '/' || $uri === '/index.html') {
    header('Content-Type: text/html; charset=utf-8');
    readfile(__DIR__ . '/index.html');
    return true;
}

// 実ファイルが存在すればPHPビルトインサーバーに任せる
$file = __DIR__ . $uri;
if (file_exists($file) && is_file($file)) {
    return false;  // PHPビルトインサーバーが直接返す
}

// それ以外は404
http_response_code(404);
echo 'not found';
return true;
