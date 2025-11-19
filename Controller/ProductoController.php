<?php
    include_once 'Model/ProductoDAO.php';

    class ProductoController {
        public function show() {
            $view = 'View/Producto/show.php';
            $idProducto=$_GET['idProducto'];
            $producto = ProductoDAO::getProductoById($idProducto);
            include_once 'View/main.php';
        }
        public function index() {
            $view = 'View/Producto/index.php';
            $listaProductos = ProductoDAO::getProductos();
            include_once 'View/main.php';
        }
    }
?>