<?php
require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';
require_once 'helper/url_helper.php';
require_once 'config/session.php';

$url = $_GET['url'] ?? $route['default_controller']. '/index';
$url = trim($url, '/');
$segment = explode('/', $url);

// CEK APAKAH URL PAKE FOLDER (c_master/Mobil_C/index) ATAU ENGGAK (Mobil_C/index)
if (count($segment) >= 2 && (is_dir('controller/'. $segment[0]) || is_dir('controller/'.ucfirst($segment[0])) || is_dir($segment[0]))) {
    // ADA FOLDER MISAL: c_master/Mobil_C/index
    $folder = $segment[0];
    $controller = $segment[1] ?? $route['default_controller'];
    $method = $segment[2] ?? 'index';
    $parameter = $segment[3] ?? null;
    
    // Cari folder yang bener (C_master atau c_master)
    if (is_dir('controller/'.$folder)) {
        $folder_path = 'controller/'.$folder;
    } elseif (is_dir('controller/'.ucfirst($folder))) {
        $folder_path = 'controller/'.ucfirst($folder);
    } elseif (is_dir('controller/'.strtolower($folder))) {
        $folder_path = 'controller/'.strtolower($folder);
    } else {
        $folder_path = $folder;
    }
    
    $controllerFile = $folder_path . '/' . $controller . '.php';
    $controllerName = $controller;
    
} else {
    // GAK ADA FOLDER MISAL: Login_C/index atau Mobil_C/index
    $controller = $segment[0] ?? $route['default_controller'];
    $method = $segment[1] ?? 'index';
    $parameter = $segment[2] ?? null;

    if (strtolower($controller) === 'login_c') {
        $controllerName = 'Login_C';
        $controllerFile = 'controller/'. $controllerName. '.php';
    } else {
        $controllerName = $controller; // Biar Mobil_C tetap Mobil_C
        // FIX UTAMA DISINI - CEK DI 3 TEMPAT
        if (file_exists('controller/'.$controllerName.'.php')) {
            $controllerFile = 'controller/'.$controllerName.'.php';
        } elseif (file_exists('controller/C_master/'.$controllerName.'.php')) {
            $controllerFile = 'controller/C_master/'.$controllerName.'.php';
        } elseif (file_exists('controller/c_master/'.$controllerName.'.php')) {
            $controllerFile = 'controller/c_master/'.$controllerName.'.php';
        } else {
            $controllerFile = 'controller/'.$controllerName.'.php';
        }
    }
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $objController = new $controllerName();
    if (method_exists($objController, $method)) {
        if ($parameter !== null) {
            $objController->$method($parameter);
        } else {
            $objController->$method();
        }
    } else {
        echo "Method $method tidak ditemukan di $controllerName";
    }
} else {
    echo "Controller file tidak ditemukan: $controllerFile - URL kamu: $url";
}