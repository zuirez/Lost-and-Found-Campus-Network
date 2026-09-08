<?php
define('APP_ROOT', __DIR__ . '/..');
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/app/models/Database.php';

$db    = Database::getInstance()->getConnection();
$email = 'rijoanmaruf@gmail.com';

$stmt = $db->prepare("UPDATE users SET role = 'admin' WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "Success: '{$email}' is now an admin.\n";
} else {
    echo "No user found with email '{$email}'. Check the email and try again.\n";
}
