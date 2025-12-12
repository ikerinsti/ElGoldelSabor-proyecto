<?php
include_once 'Usuario.php';

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

    // Crear usuario nuevo
    public function crearUsuario($nombre, $email, $password, $direccion)
    {
        $conn = database::connect();
        $sql = "INSERT INTO usuario (nombre, email, contraseña, direccion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $email, $password, $direccion);
        return $stmt->execute();
    }
}
