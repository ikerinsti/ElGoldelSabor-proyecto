<?php
include_once 'Model/UsuarioDAO.php';
include_once 'Model/CategoriaDAO.php';

class ApiController
{

    public function getCategorias()
    {
        header('Content-type: application/json; charset-utf-8');

        $listaCategorias = CategoriaDAO::getCategorias();
        $data = [];

        foreach ($listaCategorias as $categoria) {
            $data[] = $categoria->toArray();
        }

        echo json_encode($data);
    }



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

    // Comprobar que se recibieron los datos
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $email = $_POST['email'] ?? null;
    $rol = $_POST['rol'] ?? null;
    $direccion = $_POST['direccion'] ?? null;

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

}
