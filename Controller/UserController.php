<?php 
    include_once 'Model/UsuarioDAO.php';

    class UserController {
        public function perfil() {
            $view = 'View/Usuarios/User.php';
            include 'View/Main.php';
        }
    }
?>