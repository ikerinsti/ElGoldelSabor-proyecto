<?php
include_once 'Pedido.php';
include_once 'Database/Database.php';

class PedidoDAO
{

    public function insert(array $data): int
    {
        $conn = database::connect();

        $stmt = $conn->prepare("
            INSERT INTO pedido (fecha, total, estado, tipo_entrega, id_usuario)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sdssi",
            $data['fecha'],
            $data['total'],
            $data['estado'],
            $data['tipo_entrega'],
            $data['id_usuario']
        );

        $stmt->execute();

        $idPedido = $conn->insert_id;

        $stmt->close();
        $conn->close();

        return $idPedido;
    }

    public function insertLineaPedido(int $idPedido, array $linea): void
    {
        $conn = database::connect();


        $stmt = $conn->prepare("
            INSERT INTO linea_pedido 
            (id_pedido, id_producto, cantidad, precio_unitario, total)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "iiidd", 
            $idPedido,
            $linea['id_producto'],
            $linea['cantidad'],
            $linea['precio_unitario'],
            $linea['total']
        );

        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    public function getPedidoById($idPedido)
    {
        $conn = database::connect();

        $stmt = $conn->prepare("SELECT * FROM pedido WHERE id_pedido = ?");

        $stmt->bind_param("i", $idPedido);
        $stmt->execute();

        $result = $stmt->get_result();
        $pedido = $result->fetch_object('Pedido');

        $stmt->close();
        $conn->close();

        return $pedido;
    }

    public static function getPedidosByUsuario($id_usuario)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM pedido WHERE id_usuario = ? ORDER BY fecha DESC");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $results = $stmt->get_result();

        $pedidos = [];
        while ($row = $results->fetch_object('Pedido')) {
            $pedidos[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $pedidos;
    }

    public static function getDetallesPedido($id_pedido)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM linea_pedido WHERE id_pedido = ?");
        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();
        $results = $stmt->get_result();

        $detalles = [];
        while ($row = $results->fetch_assoc()) {
            $detalles[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $detalles;
    }
}
?>