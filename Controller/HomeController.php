<?php 
include_once 'Model/DescuentoDAO.php';
include_once 'Model/ProductoDAO.php';

class HomeController {
    public function index() {
        $view = 'view/home.php';
        $descuentoModel = new DescuentoDAO();
        $listadescuentos = $descuentoModel->getDescuentoByAmbito('producto');
        $productoModel = new ProductoDAO();
        $listaproductos = $productoModel->getProductos();
        include 'View/main.php';
    }
}
?>