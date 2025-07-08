<?php
// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];

// If not at the root URL, redirect to root
if ($current_url != '/' && $current_url != '/index.php') {
    header("Location: /");
    exit;
}

// Otherwise include the home page content
include_once($_SERVER['DOCUMENT_ROOT'] . '/pages/home/home.php');
