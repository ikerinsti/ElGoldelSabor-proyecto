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

    public static function getIngredientesProducto($id_producto)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT nombre FROM ingrediente 
                                JOIN ingrediente_has_producto ON ingrediente_has_producto.ingrediente_id_ingrediente = ingrediente.id_ingrediente 
                                WHERE ingrediente_has_producto.producto_id_producto = ? AND ingrediente_has_producto.defecto = 1");
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $results = $stmt->get_result();

        $ingredientes = [];
        while ($row = $results->fetch_assoc()) {
            $ingredientes[] = $row['nombre'];
        }

        $stmt->close();
        $conn->close();
        return $ingredientes;
    }

    public static function calcularPrecioConDescuento($producto, $descuentos)
{
    $precioBase = $producto->getPrecio();

    if ($producto->getId_descuento() === null) {
        return [
            'precio_final' => $precioBase,
            'precio_original' => $precioBase,
            'en_oferta' => false
        ];
    }

    foreach ($descuentos as $descuento) {
        if ($descuento->getId_descuento() == $producto->getId_descuento()) {

            if ($descuento->getTipo() === 'porcentaje') {
                $precioFinal = $precioBase * (1 - $descuento->getValor() / 100);
            } else { // fijo
                $precioFinal = $precioBase - $descuento->getValor();
            }

            return [
                'precio_final' => round($precioFinal, 2),
                'precio_original' => $precioBase,
                'en_oferta' => true
            ];
        }
    }

    // Seguridad
    return [
        'precio_final' => $precioBase,
        'precio_original' => $precioBase,
        'en_oferta' => false
    ];
}

}
