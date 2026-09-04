<?php
/**
 * Lost & Found Campus Network (AIUB)
 * Front Controller & Entry Point
 */

// Define application root directory
define('APP_ROOT', __DIR__);

// Load configuration
require_once APP_ROOT . '/config/config.php';

// Load Database
require_once APP_ROOT . '/app/models/Database.php';

// Load helpers
require_once APP_ROOT . '/app/helpers/session_helper.php';

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
        require_once APP_ROOT . '/app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->login();
        break;
    case 'register':
        require_once APP_ROOT . '/app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->register();
        break;
    case 'logout':
        require_once APP_ROOT . '/app/controllers/AuthController.php';
        $auth = new AuthController();
        $auth->logout();
        break;
    case 'posts':
        require_once APP_ROOT . '/app/controllers/PostsController.php';
        $posts = new PostsController();
        $method = isset($url[1]) ? $url[1] : 'index';
        $param = isset($url[2]) ? $url[2] : null;
        
        if (method_exists($posts, $method)) {
            if ($param !== null) {
                $posts->$method($param);
            } else {
                $posts->$method();
            }
        } else {
            $posts->index();
        }
        break;
    case 'profile':
        require_once APP_ROOT . '/app/controllers/ProfileController.php';
        $profile = new ProfileController();
        $method = isset($url[1]) && !empty($url[1]) ? $url[1] : 'index';
        $param  = isset($url[2]) ? $url[2] : null;

        if (method_exists($profile, $method)) {
            if ($param !== null) {
                $profile->$method($param);
            } else {
                $profile->$method();
            }
        } else {
            $profile->index();
        }
        break;
    case 'home':
    default:
        // We can route home to PostsController index if we want, or keep it separate.
        // Let's redirect home to /posts/lost for now or create a Feed method.
        require_once APP_ROOT . '/app/controllers/PostsController.php';
        $posts = new PostsController();
        $posts->index();
        break;
}
