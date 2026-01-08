<?php

class PedidoController
{
    private PedidoDAO $pedidoDAO;
    private ProductoDAO $productoDAO;
    private DescuentoDAO $descuentoDAO;

    public function __construct()
    {
        $this->pedidoDAO = new PedidoDAO();
        $this->productoDAO = new ProductoDAO();
        $this->descuentoDAO = new DescuentoDAO();
    }

    /**
     * Página para elegir método de pago
     */
    public function index()
    {
        if (!isset($_SESSION['usuario'])) {
            header("Location: ?controller=usuario&action=login");
            exit;
        }

        if (empty($_SESSION['carrito'])) {
            header("Location: ?controller=carrito&action=index");
            exit;
        }
        $view = 'View/Pedido/Pago_online.php';
        include_once 'View/main.php';
    }

    /**
     * Pago en establecimiento (tarjeta o efectivo)
     */
    public function crear()
    {
        $tipoPago = $_POST['tipo_pago'] ?? null; // tarjeta | efectivo

        if (!$tipoPago) {
            header("Location: ?controller=pedido&action=index");
            exit;
        }

        $idPedido = $this->crearPedido('pendiente');

        header("Location: ?controller=pedido&action=confirmacion&id=$idPedido");
        exit;
    }

    public function procesarPago()
    {

        if (empty($_SESSION['carrito'])) {
            header("Location: ?controller=carrito&action=index");
            exit;
        }

        $metodo = $_POST['metodo_pago'] ?? null;

        if (!$metodo) {
            header("Location: ?controller=carrito&action=index");
            exit;
        }

        // 👉 PAGO ONLINE
        if ($metodo === 'tarjeta') {
            // solo mostramos el formulario de tarjeta fake
            header("Location: ?controller=pedido&action=pagoOnline");
            exit;
        }

        // 👉 PAGO EN ESTABLECIMIENTO (tarjeta o efectivo)
        $idPedido = $this->crearPedido('pendiente');

        header("Location: ?controller=pedido&action=confirmacion&id=$idPedido");
        exit;
    }


    /**
     * Vista del formulario de tarjeta fake
     */
    public function pagoOnline()
    {
        if (empty($_SESSION['carrito'])) {
            header("Location: ?controller=carrito&action=index");
            exit;
        }

        $carrito = $_SESSION['carrito'];
        $descuentos = $this->descuentoDAO->getDescuentos();

        $subtotal = 0;
        $descuentoTotal = 0;
        $total = 0;

        foreach ($carrito as $idProducto => $cantidad) {
            $producto = $this->productoDAO->getProductoById($idProducto);
            if (!$producto)
                continue;

            $precioOriginal = $producto->getPrecio();
            $precioFinal = $precioOriginal;

            if ($producto->getId_descuento() !== null) {
                foreach ($descuentos as $descuento) {
                    if ($descuento->getId_descuento() == $producto->getId_descuento()) {
                        if ($descuento->getTipo() === 'porcentaje') {
                            $precioFinal = $precioOriginal * (1 - $descuento->getValor() / 100);
                        } else {
                            $precioFinal = $precioOriginal - $descuento->getValor();
                        }
                        break;
                    }
                }
            }

            $subtotal += $precioOriginal * $cantidad;
            $descuentoTotal += ($precioOriginal - $precioFinal) * $cantidad;
            $total += $precioFinal * $cantidad;
        }
        $view = 'View/Pedido/Pago_online.php';
        include_once 'View/main.php';
    }

    /**
     * Procesa el pago online fake
     */
    public function procesarPagoOnline()
    {
        // No validamos nada, es fake
        $id_Pedido = $this->crearPedido('confirmado');

        header("Location: ?controller=pedido&action=confirmacion&id=$id_Pedido");
        exit;
    }

    /**
     * Página final de confirmación
     */
    public function confirmacion()
    {
        $idPedido = $_GET['id'] ?? null;

        

        $pedido = $this->pedidoDAO->getPedidoById($idPedido);
        $usuarioNombre = $_SESSION['nombre'] ?? 'Cliente';

        $view = 'View/Pedido/Confirmacion.php';
        include_once 'View/main.php';
    }


    /**
     * MÉTODO CLAVE
     * Crea pedido + líneas
     */
    private function crearPedido(string $estado): int
    {
        $idUsuario = $_SESSION['id_usuario'];
        $carrito = $_SESSION['carrito'];
        $descuentos = $this->descuentoDAO->getDescuentos();

        $total = 0;
        $lineas = [];

        foreach ($carrito as $idProducto => $cantidad) {

            $producto = $this->productoDAO->getProductoById($idProducto);
            if (!$producto)
                continue;

            $precioOriginal = $producto->getPrecio();
            $precioFinal = $precioOriginal;

            if ($producto->getId_descuento() !== null) {
                foreach ($descuentos as $descuento) {
                    if ($descuento->getId_descuento() == $producto->getId_descuento()) {
                        if ($descuento->getTipo() === 'porcentaje') {
                            $precioFinal = $precioOriginal * (1 - $descuento->getValor() / 100);
                        } else {
                            $precioFinal = $precioOriginal - $descuento->getValor();
                        }
                        break;
                    }
                }
            }

            $lineas[] = [
                'id_producto' => $idProducto,
                'cantidad' => $cantidad,
                'precio_unitario' => $precioFinal,
                'total' => $precioFinal * $cantidad
            ];

            $total += $precioFinal * $cantidad;
        }

        // Crear pedido
        $idPedido = $this->pedidoDAO->insert([
            'fecha' => date('Y-m-d'),
            'total' => $total,
            'estado' => $estado,
            'tipo_entrega' => 'establecimiento',
            'id_usuario' => $idUsuario
        ]);

        // Crear líneas
        foreach ($lineas as $linea) {
            $this->pedidoDAO->insertLineaPedido($idPedido, $linea);
        }

        // Vaciar carrito
        unset($_SESSION['carrito']);

        header("Location: ?controller=pedido&action=confirmacion&id=$idPedido");
        exit;
    }
}
