<?php
session_start();
include_once 'Model/UsuarioDAO.php';

class LoginController
{

    public function index()
    {
        $view = 'View/Session/Login.php';
        include 'View/main.php';
    }
    public function registro()
    {
        $view = 'View/Session/Register.php';
        include 'View/main.php';
    }


    // Procesa el formulario de login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = $_POST['email'];
            $password = $_POST['contraseña'];

            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->getUsuariosByCorreo($correo);
            
            if ($usuario != null && password_verify($password, $usuario->getContraseña())) {
                session_start();
                $_SESSION['id_usuario'] = $usuario->getId_usuario();
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['rol'] = $usuario->getRol();
                header('Location: ?controller=Home&action=index');
            } else {
                $view = 'View/Session/Login.php?';
                include 'View/main.php';
            }
        }
    }

    // Cerrar sesión
    public function logout()
    {
        session_destroy();
        header("Location: http://localhost/ElGoldelSabor/");
        exit;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['Nombre'];
            $email = $_POST['Email'];
            $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
            $direccion = $_POST['Direccion'];

            $usuarioDAO = new UsuarioDAO();
            $usuarioExistente = UsuarioDAO::getUsuariosByCorreo($email);

            if ($usuarioExistente == null) {
                $usuarioDAO->crearUsuario($nombre, $email, $password, $direccion);
                header('Location: index.php/?controller=Login&action=index');
            } else {
                $view = 'View/Session/Register.php';
                include 'View/main.php';
            }
        }
    }
}
