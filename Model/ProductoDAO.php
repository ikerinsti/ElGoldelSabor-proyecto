<?php 
    include_once 'Database/Database.php';
    include_once 'Producto.php';

    class ProductoDAO {
        public static function getProductoById($id_producto) {
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
        public static function getProductos() {
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
    }
?>