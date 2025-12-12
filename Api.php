<?php
include_once 'Controller/CartaController.php';
include_once 'Controller/HomeController.php';
include_once 'Controller/LoginController.php';
include_once 'Controller/AdminController.php';
include_once 'Controller/UserController.php';
include_once 'Controller/ApiController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['controller'])) {
    $nombre_controller = $_GET['controller'] . 'Controller';
    if (class_exists($nombre_controller)) {
        $controller = new $nombre_controller();
        $action = $_GET['action'];
        if (isset($action) && method_exists($controller, $action)) {
            $controller->$action();
        } else {
            header("location: 404.php");
        }
    }
    else {
        echo "El controlador " . $nombre_controller . " no existe.";
        header("location: 404.php");    
    }
} else {
    $controller = new HomeController();
    $controller -> index();
}


//http://localhost/ElGoldelSabor/?controller=Producto&action=show
?>

