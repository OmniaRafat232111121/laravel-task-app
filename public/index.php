<?php
// Simple Laravel-like routing
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Remove query string
$path = strtok($path, '?');

// Debug: Show what path we're trying to access
echo "<!-- Debug: Requested path: " . $path . " -->";

// Route handling
switch ($path) {
    case '/':
    case '/home':
        if (file_exists('home.html')) {
            include 'home.html';
        } else {
            echo '<h1>home.html not found</h1>';
        }
        break;
    case '/users':
        if (file_exists('users.html')) {
            include 'users.html';
        } else {
            echo '<h1>users.html not found</h1>';
        }
        break;
    default:
        // Try to serve static files
        $file = __DIR__ . $path;
        if (file_exists($file) && is_file($file)) {
            $mime_type = mime_content_type($file);
            header('Content-Type: ' . $mime_type);
            readfile($file);
        } else {
            http_response_code(404);
            echo '<h1>404 - Page Not Found</h1>';
            echo '<p>Requested path: ' . $path . '</p>';
            echo '<p>Files in directory:</p>';
            echo '<ul>';
            foreach (scandir(__DIR__) as $file) {
                if ($file != '.' && $file != '..') {
                    echo '<li>' . $file . '</li>';
                }
            }
            echo '</ul>';
        }
        break;
}
?>