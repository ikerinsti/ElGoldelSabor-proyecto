<?php
include_once 'Database/Database.php';
include_once 'Producto.php';

class ProductoDAO
{
    public static function getProductoById($id_producto)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $results = $stmt->get_result();

        $producto = $results->fetch_object('Producto');
        $stmt->close();
        $conn->close();
        return $producto;
    }
    public static function getProductos()
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM producto");
        $stmt->execute();
        $results = $stmt->get_result();

        $productos = [];
        while ($row = $results->fetch_object('Producto')) {
            $productos[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $productos;
    }
    
    public static function getProductosPorCategoriaPadre($id_categoria)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM producto where id_categoria IN (SELECT id_categoria FROM categoria WHERE categoria_padre = ?)");
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        $results = $stmt->get_result();

        $productos = [];
        while ($row = $results->fetch_object('Producto')) {
            $productos[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $productos;
    }
    public static function getProductosPorCategoriaHija($id_categoria)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM producto where id_categoria = ? ORDER BY nombre ASC");
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        $results = $stmt->get_result();

        $productos = [];
        while ($row = $results->fetch_object('Producto')) {
            $productos[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $productos;
    }
}
