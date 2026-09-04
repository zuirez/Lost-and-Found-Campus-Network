<?php
/**
 * Lost & Found Campus Network (AIUB)
 * Front Controller & Entry Point
 */

// Define application root directory
define('APP_ROOT', __DIR__);

// Load configuration
require_once APP_ROOT . '/config/config.php';

// Define base URL dynamically
$base_url = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\\/');
define('BASE_URL', $base_url);

// Basic routing
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$page = str_replace('.php', '', $url[0]) ?: 'home';

switch ($page) {
    case 'login':
        require_once APP_ROOT . '/app/views/auth/login.php';
        break;
    case 'register':
        require_once APP_ROOT . '/app/views/auth/register.php';
        break;
    case 'home':
    default:
        require_once APP_ROOT . '/app/views/home/index.php';
        break;
}
