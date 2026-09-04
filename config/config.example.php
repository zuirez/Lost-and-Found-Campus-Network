<?php
/**
 * Application Configuration Example
 * Copy this file to config.php and enter your actual credentials
 */

define('DB_HOST', 'your-aiven-host-url.aivencloud.com');
define('DB_USER', 'avnadmin');
define('DB_PASS', 'your-aiven-password');
define('DB_NAME', 'defaultdb');
define('DB_PORT', '12978');

// Aiven requires SSL. Download the CA certificate and place it in the config folder as ca.pem.
define('DB_SSL_CA', APP_ROOT . '/config/ca.pem');
