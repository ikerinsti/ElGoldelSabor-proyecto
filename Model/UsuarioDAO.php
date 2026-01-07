<?php
include_once 'Usuario.php';
include_once 'Database/Database.php';

class UsuarioDAO
{
    public static function getUsuarios()
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM usuario");
        $stmt->execute();
        $results = $stmt->get_result();

        $usuarios = [];
        while ($row = $results->fetch_object('Usuario')) {
            $usuarios[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $usuarios;
    }

    public static function getUsuariosByCorreo($correo)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM usuario where email = ? LIMIT 1");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');
        $stmt->close();
        $conn->close();
        return $usuario;
    }
    public static function getUsuariosByID($id_usuario)
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM usuario where id_usuario = ? LIMIT 1");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_object('Usuario');
        $stmt->close();
        $conn->close();
        return $usuario;
    }

    // Crear usuario nuevo
    public function crearUsuario($nombre, $email, $password, $direccion)
    {
        $conn = database::connect();
        $sql = "INSERT INTO usuario (nombre, email, contraseña, direccion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $email, $password, $direccion);
        return $stmt->execute();
    }

    public function editarUsuario($id_usuario, $nombre, $email, $direccion)
    {
        $conn = database::connect();
        $sql = "UPDATE usuario SET nombre = ?, email = ?, direccion = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $direccion, $id_usuario);
        return $stmt->execute();
    }
}
