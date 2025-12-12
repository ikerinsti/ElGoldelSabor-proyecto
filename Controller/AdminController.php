<?php 
    include_once 'Model/UsuarioDAO.php';

    class AdminController {
        public function dashboard() {
            $view = 'View/Usuarios/Admin.php';
            include 'View/Main.php';
        }
    }
?>