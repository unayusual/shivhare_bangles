<?php
// config/config.php

// Database Credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'shivhare_bangles');
define('DB_USER', 'root'); // Default for local, change for prod
define('DB_PASS', '');     // Default for local, change for prod
define('DB_CHARSET', 'utf8mb4');

// Site Identifiers
define('SITE_NAME', 'Shivhare Bangle Store');
define('SITE_URL', 'http://localhost/shivhare_bangles'); // Change for prod

// Error Reporting (Turn off for production)
// Error Reporting (Turn off for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
?>
