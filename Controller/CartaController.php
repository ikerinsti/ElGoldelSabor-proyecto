<?php 
include_once 'Model/DescuentoDAO.php';
include_once 'Model/ProductoDAO.php';
include_once 'Model/CategoriaDAO.php';

class CartaController {
    public function index() {
        $view = 'view/carta.php';

        $listaCategorias = CategoriaDAO::getCategorias();
        $categoriaActiva = $_GET['cat'] ?? null;

        $descuentoModel = new DescuentoDAO();
        $listadescuentos = $descuentoModel->getDescuentoByAmbito('producto');

        $productoModel = new ProductoDAO();
        $listaproductos = $productoModel->getProductos();

        $idCategoriaActiva = CategoriaDAO::getIdCategoriaActiva($categoriaActiva);
        $listaProductosPorCategoria = ProductoDAO::getProductosPorCategoriaPadre($idCategoriaActiva[0]->getId_Categoria());

        $idsCategoriasHijas = CategoriaDAO::getCategoriasDelPadre($idCategoriaActiva[0]->getId_categoria());

        //crea un array asociativo con los productos de las categorías hijas
        $arrayProductosHijas = [];
        foreach ($idsCategoriasHijas as $categoriaHija) {
            $productosHija = ProductoDAO::getProductosPorCategoriaHija($categoriaHija->getId_Categoria());
            $arrayProductosHijas[$categoriaHija->getNombre()] = $productosHija;
        }

        $listaProductosPorCategoriaHija = ProductoDAO::getProductosPorCategoriaHija($idsCategoriasHijas[0]->getId_Categoria());
        

        include 'View/main.php';
    }
}
?>