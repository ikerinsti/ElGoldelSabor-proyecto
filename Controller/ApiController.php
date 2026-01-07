<?php
include_once 'Model/UsuarioDAO.php';
include_once 'Model/CategoriaDAO.php';

class ApiController
{



    /**************** USUARIOS *********************/

    public function getUsuarios()
    {
        header('Content-type: application/json; charset-utf-8');

        $usuarios = UsuarioDAO::getUsuarios();
        $data = [];

        foreach ($usuarios as $usuario) {
            $data[] = $usuario->toArray();
        }

        echo json_encode($data);
    }


    public function getUsuarioById()
    {
        header('Content-type: application/json; charset=utf-8');

        if (!isset($_GET['id'])) {
            echo json_encode(['error' => 'ID no proporcionado']);
            return;
        }

        $id = $_GET['id'];
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');

        $stmt->close();
        $conn->close();

        if ($usuario) {
            echo json_encode($usuario->toArray());
        } else {
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
    }

    public function editUsuario()
    {
        header('Content-type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        $nombre = $input['nombre'] ?? null;
        $email = $input['email'] ?? null;
        $rol = $input['rol'] ?? null;
        $direccion = $input['direccion'] ?? null;

        if (!$id || !$nombre || !$email || !$rol) {
            echo json_encode(['ok' => false, 'error' => 'Datos incompletos']);
            return;
        }

        include_once 'Model/UsuarioDAO.php';
        $conn = database::connect();

        $stmt = $conn->prepare("UPDATE usuario SET nombre = ?, email = ?, rol = ?, direccion = ? WHERE id_usuario = ?");
        $stmt->bind_param("ssssi", $nombre, $email, $rol, $direccion, $id);

        if ($stmt->execute()) {
            echo json_encode(['ok' => true]);
        } else {
            echo json_encode(['ok' => false, 'error' => 'Error al actualizar']);
        }

        $stmt->close();
        $conn->close();
    }




    /**************** PEDIDOS *********************/

    // LISTAR TODOS LOS PEDIDOS
    public function getPedidos()
    {
        header('Content-type: application/json; charset=utf-8');
        include_once 'Model/PedidoDAO.php';
        $conn = database::connect();

        $result = $conn->query("SELECT p.*, u.nombre
                                        FROM pedido p
                                        JOIN usuario u ON p.id_usuario = u.id_usuario
                                        ORDER BY p.id_pedido ASC");
        $pedidos = [];
        while ($row = $result->fetch_assoc()) {
            $pedidos[] = $row;
        }

        echo json_encode($pedidos);
        $conn->close();
    }

    // OBTENER UN PEDIDO POR ID
    public function getPedidoById()
    {
        header('Content-type: application/json; charset=utf-8');
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['error' => 'ID no proporcionado']);
            return;
        }

        include_once 'Model/PedidoDAO.php';
        $conn = database::connect();

        $stmt = $conn->prepare("SELECT * FROM pedido WHERE id_pedido = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pedido = $result->fetch_assoc();

        if ($pedido) {
            echo json_encode($pedido);
        } else {
            echo json_encode(['error' => 'Pedido no encontrado']);
        }

        $stmt->close();
        $conn->close();
    }

    // CREAR O ACTUALIZAR PEDIDO
    public function editPedido()
    {
        header('Content-type: application/json; charset=utf-8');

        $input = json_decode(file_get_contents('php://input'), true);

        $id = $input['id'] ?? null;
        $id_usuario = $input['id_usuario'] ?? null;
        $fecha = $input['fecha'] ?? date('Y-m-d');
        $estado = $input['estado'] ?? null;
        $total = $input['total'] ?? null;
        $direccion = $input['direccion_pedido'] ?? null;
        $tipo_entrega = $input['tipo_entrega'] ?? 'domicilio';

        if (!$id_usuario || !$estado || !$total) {
            echo json_encode(['ok' => false, 'error' => 'Datos incompletos']);
            return;
        }

        include_once 'Model/PedidoDAO.php';
        $conn = database::connect();

        if ($id) {
            // ACTUALIZAR
            $stmt = $conn->prepare(
                "UPDATE pedido 
             SET id_usuario=?, fecha=?, total=?, direccion_pedido=?, estado=?, tipo_entrega=? 
             WHERE id_pedido=?"
            );
            $stmt->bind_param(
                "isdsssi",
                $id_usuario,
                $fecha,
                $total,
                $direccion,
                $estado,
                $tipo_entrega,
                $id
            );
        } else {
            // CREAR
            $stmt = $conn->prepare(
                "INSERT INTO pedido (id_usuario, fecha, total, direccion_pedido, estado, tipo_entrega)
             VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param(
                "isdsss",
                $id_usuario,
                $fecha,
                $total,
                $direccion,
                $estado,
                $tipo_entrega
            );
        }

        if ($stmt->execute()) {
            echo json_encode(['ok' => true]);
        } else {
            echo json_encode(['ok' => false, 'error' => $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    }


    // ELIMINAR PEDIDO
    public function deletePedido()
    {
        header('Content-type: application/json; charset=utf-8');
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['ok' => false, 'error' => 'ID no proporcionado']);
            return;
        }

        include_once 'Model/PedidoDAO.php';
        $conn = database::connect();

        $stmt = $conn->prepare("DELETE FROM pedido WHERE id_pedido = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['ok' => true]);
        } else {
            echo json_encode(['ok' => false, 'error' => 'Error al eliminar pedido']);
        }

        $stmt->close();
        $conn->close();
    }




    /**************** PRODUCTOS *********************/
    // LISTAR TODOS LOS PRODUCTOS
    public function getProductos()
    {
        header('Content-type: application/json; charset=utf-8');
        include_once 'Model/ProductoDAO.php';
        $conn = database::connect();

        $result = $conn->query("SELECT p.*, c.nombre AS categoria
                            FROM producto p
                            JOIN categoria c ON p.id_categoria = c.id_categoria
                            ORDER BY p.nombre ASC");
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }

        echo json_encode($productos);
        $conn->close();
    }

    // OBTENER UN PRODUCTO POR ID
    public function getProductoById()
    {
        header('Content-type: application/json; charset=utf-8');
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['error' => 'ID no proporcionado']);
            return;
        }

        include_once 'Model/ProductoDAO.php';
        $conn = database::connect();

        $stmt = $conn->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();

        if ($producto) {
            echo json_encode($producto);
        } else {
            echo json_encode(['error' => 'Producto no encontrado']);
        }

        $stmt->close();
        $conn->close();
    }

    // CREAR O ACTUALIZAR PRODUCTO
    public function editProducto()
    {
        header('Content-type: application/json; charset=utf-8');
        $input = json_decode(file_get_contents('php://input'), true);

        $id = $input['id'] ?? null;
        $nombre = $input['nombre'] ?? null;
        $descripcion = $input['descripcion'] ?? null;
        $img_producto = $input['img_producto'] ?? null;
        $precio = $input['precio'] ?? null;
        $id_descuento = $input['id_descuento'] ?? null;
        $id_categoria = $input['id_categoria'] ?? null;

        if (!$nombre || !$descripcion || !$img_producto || !$precio || !$id_categoria) {
            echo json_encode(['ok' => false, 'error' => 'Datos incompletos']);
            return;
        }

        include_once 'Model/ProductoDAO.php';
        $conn = database::connect();

        if ($id) {
            // ACTUALIZAR
            $stmt = $conn->prepare(
                "UPDATE producto 
             SET nombre=?, descripcion=?, img_producto=?, precio=?, id_descuento=?, id_categoria=? 
             WHERE id_producto=?"
            );
            $stmt->bind_param(
                "sssdiis",
                $nombre,
                $descripcion,
                $img_producto,
                $precio,
                $id_descuento,
                $id_categoria,
                $id
            );
        } else {
            // CREAR
            $stmt = $conn->prepare(
                "INSERT INTO producto (nombre, descripcion, img_producto, precio, id_descuento, id_categoria)
             VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param(
                "sssdis",
                $nombre,
                $descripcion,
                $img_producto,
                $precio,
                $id_descuento,
                $id_categoria
            );
        }

        if ($stmt->execute()) {
            echo json_encode(['ok' => true, 'id' => $id ?? $conn->insert_id]);
        } else {
            echo json_encode(['ok' => false, 'error' => $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    }

    // ELIMINAR PRODUCTO
    public function deleteProducto()
    {
        header('Content-type: application/json; charset=utf-8');
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo json_encode(['ok' => false, 'error' => 'ID no proporcionado']);
            return;
        }

        include_once 'Model/ProductoDAO.php';
        $conn = database::connect();

        $stmt = $conn->prepare("DELETE FROM producto WHERE id_producto = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['ok' => true]);
        } else {
            echo json_encode(['ok' => false, 'error' => 'Error al eliminar producto']);
        }

        $stmt->close();
        $conn->close();
    }


}
