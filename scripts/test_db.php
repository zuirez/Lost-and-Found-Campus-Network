<?php
define('APP_ROOT', 'c:/xampp/htdocs/Lost-and-Found-Campus-Network');
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/app/models/Database.php';

try {
    $db = Database::getInstance()->getConnection();
    echo "Connection Successful!";
} catch (Exception $e) {
    echo "Connection Failed: " . $e->getMessage();
}
