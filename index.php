<?php
// Định nghĩa hằng số cho đường dẫn
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('APP', ROOT . DS . 'app');
define('URL', 'http://localhost/quanlysinhvien');
define('ASSETS', URL . '/public/assets');

// Load các file cấu hình
require_once APP . DS . 'config' . DS . 'config.php';
require_once APP . DS . 'config' . DS . 'database.php';

// Lấy URL từ thanh địa chỉ
$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
$url = rtrim($url, '/');
$url = explode('/', $url);

// Xác định controller
$controller = isset($url[0]) ? $url[0] : 'home';
$controller = ucfirst($controller) . 'Controller';
$controllerPath = APP . DS . 'controllers' . DS . $controller . '.php';

// Xác định action
$action = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Kiểm tra và load controller
if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controller();
    
    if (method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], $params);
    } else {
        // Xử lý khi action không tồn tại
        die('Action không tồn tại');
    }
} else {
    // Xử lý khi controller không tồn tại
    die('Controller không tồn tại');
}
?> 