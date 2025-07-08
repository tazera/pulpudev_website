<?php
// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];

// If directly accessing home.php, redirect to root
if ($current_url == '/pages/home/home.php') {
    header("Location: /");
    exit;
}

// If not at the root URL or index.php, and not accessing specific assets, redirect to root
if (
    $current_url != '/' && $current_url != '/index.php' &&
    !preg_match('~\.(css|js|png|jpg|jpeg|gif|webp|ico|svg|woff|woff2|ttf|eot)$~i', $current_url)
) {
    header("Location: /");
    exit;
}

// Otherwise include the home page content
include_once($_SERVER['DOCUMENT_ROOT'] . '/pages/home/home.php');
