<?php
include_once 'Model/UsuarioDAO.php';
include_once 'Model/PedidoDAO.php';
include_once 'Model/ProductoDAO.php';

class UserController
{
    private $usuarioDAO;
    private $pedidoDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
        $this->pedidoDAO = new PedidoDAO();
        $this->productoDAO = new ProductoDAO();
    }

    public function perfil()
    {

        $id_usuario = $_SESSION['id_usuario'];

        // Si se envía el formulario, llamar al método editarUsuario
        if (isset($_POST['guardar_datos'])) {
            $this->editarUsuario($id_usuario, $_POST['nombre'], $_POST['email'], $_POST['direccion']);
        }

        // Obtener datos del usuario y pedidos
        $usuario = $this->usuarioDAO->getUsuariosByID($id_usuario);
        $pedidos = $this->pedidoDAO->getPedidosByUsuario($id_usuario);
        $pedidos_detalles = [];
        foreach ($pedidos as $pedido) {
            $lineas = $this->pedidoDAO->getDetallesPedido($pedido->getId_pedido());
            $pedidos_detalles[$pedido->getId_pedido()] = [];

            foreach ($lineas as $linea) {
                // Obtener el nombre del producto
                $producto = $this->productoDAO->getProductoById($linea['id_producto']);
                $pedidos_detalles[$pedido->getId_pedido()][] = [
                    'cantidad' => $linea['cantidad'],
                    'producto' => $producto ? $producto->getNombre() : 'Producto desconocido'
                ];
            }
        }
        $view = 'View/Usuarios/User.php';
        include 'View/Main.php';
    }

    // Método que llama al DAO para actualizar usuario
    private function editarUsuario($id_usuario, $nombre, $email, $direccion)
    {
        $this->usuarioDAO->editarUsuario($id_usuario, $nombre, $email, $direccion);

        // Redireccionar para evitar resubmission y errores de header
        header("Location: ?controller=user&action=perfil");
        exit;
    }
}
?>