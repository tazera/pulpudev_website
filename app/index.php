
<?php
// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];

// Strip off any query string or fragment from the URL for matching
$base_url = preg_replace('/[?#].*$/', '', $current_url);

// If directly accessing home.php (ignoring any fragments or query strings), redirect to root
// and preserve the fragment if it exists
if ($base_url == '/pages/home/home.php') {
    $fragment = '';
    if (strpos($current_url, '#') !== false) {
        $fragment = substr($current_url, strpos($current_url, '#'));
    }
    header("Location: /" . $fragment);
    exit;
}

// If not at the root URL or index.php, and not accessing specific assets, redirect to root
if (
    $base_url != '/' && $base_url != '/index.php' &&
    !preg_match('~\.(css|js|png|jpg|jpeg|gif|webp|ico|svg|woff|woff2|ttf|eot)$~i', $base_url)
) {
    header("Location: /");
    exit;
}

// Otherwise include the home page content
include_once($_SERVER['DOCUMENT_ROOT'] . '/pages/home/home.php');
