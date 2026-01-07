<?php
include_once 'Model/ProductoDAO.php';
include_once 'Model/DescuentoDAO.php';

class CarritoController
{

    // Mostrar carrito
    public function index()
    {
        // Inicializamos arrays y totales
        $productosCarrito = [];
        $subtotal = 0;
        $descuentoTotal = 0;
        $total = 0;

        // Obtenemos todos los descuentos
        $descuentos = DescuentoDAO::getDescuentos();

        // Si hay productos en el carrito
        if (!empty($_SESSION['carrito'])) {

            foreach ($_SESSION['carrito'] as $idProducto => $cantidad) {

                $producto = ProductoDAO::getProductoById($idProducto);

                if ($producto) {

                    // Precio original
                    $precioOriginal = $producto->getPrecio();
                    $precioFinal = $precioOriginal;
                    $enOferta = false;

                    // Si tiene descuento
                    if ($producto->getId_descuento() !== null) {
                        foreach ($descuentos as $descuento) {
                            if ($descuento->getId_descuento() == $producto->getId_descuento()) {

                                $enOferta = true;

                                if ($descuento->getTipo() === 'porcentaje') {
                                    $precioFinal = $precioOriginal * (1 - $descuento->getValor() / 100);
                                } elseif ($descuento->getTipo() === 'fijo') {
                                    $precioFinal = $precioOriginal - $descuento->getValor();
                                }

                                break;
                            }
                        }
                    }

                    // Totales
                    $subtotal += $precioOriginal * $cantidad;
                    $descuentoTotal += ($precioOriginal - $precioFinal) * $cantidad;

                    // Producto para la vista
                    $productosCarrito[] = [
                        'id' => $producto->getId_Producto(),
                        'nombre' => $producto->getNombre(),
                        'precio' => number_format($precioFinal, 2),
                        'precio_original' => number_format($precioOriginal, 2),
                        'en_oferta' => $enOferta,
                        'cantidad' => $cantidad,
                        'imagen' => $producto->img_producto()
                    ];
                }
            }
        }

        // Total final
        $total = $subtotal - $descuentoTotal;

        // Vista
        $view = 'View/Carrito.php';
        include_once 'View/main.php';
    }




    public function add()
    {
        $idProducto = $_POST['producto_id'] ?? null;
        $cantidad = (int) ($_POST['cantidad'] ?? 1);
        $returnUrl = $_POST['return_url'] ?? "?controller=carta&action=index&cat=Entrantes";

        if (!$idProducto || $cantidad < 1) {
            // Redirigir a la carta si algo falla
            header("Location: $returnUrl");
            exit;
        }

        // Inicializar carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Sumar cantidad si ya está
        if (isset($_SESSION['carrito'][$idProducto])) {
            $_SESSION['carrito'][$idProducto] += $cantidad;
        } else {
            $_SESSION['carrito'][$idProducto] = $cantidad;
        }

        // 🔹 Redirigir a la URL pasada desde el formulario
        header("Location: $returnUrl");
        exit;
    }


    // Subir cantidad
    public function subir()
    {
        $idProducto = $_POST['producto_id'] ?? null;
        if ($idProducto && isset($_SESSION['carrito'][$idProducto])) {
            $_SESSION['carrito'][$idProducto]++;
        }
        header("Location: ?controller=carrito&action=index");
        exit;
    }


    // Bajar cantidad
    public function bajar()
    {
        $idProducto = $_POST['producto_id'] ?? null;
        if ($idProducto && isset($_SESSION['carrito'][$idProducto])) {
            if ($_SESSION['carrito'][$idProducto] > 1) {
                $_SESSION['carrito'][$idProducto]--;
            }
        }
        header("Location: ?controller=carrito&action=index");
        exit;
    }


    // Eliminar producto
    public function eliminar()
    {
        $idProducto = $_POST['producto_id'] ?? null;
        if ($idProducto && isset($_SESSION['carrito'][$idProducto])) {
            unset($_SESSION['carrito'][$idProducto]);
        }
        header("Location: ?controller=carrito&action=index");
        exit;
    }


}
