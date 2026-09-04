<?php
define('APP_ROOT', __DIR__);
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/app/models/Database.php';

try {
    $db = Database::getInstance()->getConnection();
    
    // Create users table
    $query = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        student_id VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('student', 'admin', 'security') DEFAULT 'student',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    
    $db->exec($query);
    echo "Successfully created users table.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
