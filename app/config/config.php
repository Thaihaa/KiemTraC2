<?php
// Cấu hình Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'test1');
define('DB_USER', 'root');
define('DB_PASS', '');

// Cấu hình đường dẫn
define('DOMAIN', 'http://localhost');
define('BASE_URL', DOMAIN . '/quanlysinhvien');

// Cấu hình thư mục
define('APP_PATH', dirname(__FILE__) . '/..');
define('CONTROLLER_PATH', APP_PATH . '/controllers/');
define('MODEL_PATH', APP_PATH . '/models/');
define('VIEW_PATH', APP_PATH . '/views/');
define('CORE_PATH', APP_PATH . '/core/');
?> 