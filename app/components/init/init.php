<?php
session_start();

# IP info
get_ip_information();

$db = new SQLite3("{$_SERVER['DOCUMENT_ROOT']}/db.sqlite", SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
$db->enableExceptions(true);

# Language
set_language($db);

# User visit
log_user_visit($db, $page);

$db->close();

# Theme
theme_preset($default_theme);

# Page checkpoint
$_SESSION['page_checkpoint'] = $_SERVER['PHP_SELF'];
