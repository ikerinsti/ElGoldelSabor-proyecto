<?php
    include_once 'Usuario.php';

    class UsuarioDAO{
        public static function getUsuariosByCorreo($correo){
            $conn = database::connect();
            $stmt = $conn->prepare("SELECT * FROM usuario where correo = ?");
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_object('Usuario');
            $stmt->close();
            $conn->close();
            return $usuario;
        }
    }
?>