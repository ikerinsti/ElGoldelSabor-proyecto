<?php
    include_once 'Model/ProductoDAO.php';

    class ProductoController {
        public function verProducto() {
            $view = 'View/Producto/Producto.php';
            $idProducto = $_GET['id_producto'];
            $producto = ProductoDAO::getProductoById($idProducto);
            $ingredientes = ProductoDAO::getIngredientesProducto( $idProducto );
            include_once 'View/main.php';
        }
    }
?>