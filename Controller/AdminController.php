<?php 
    include_once __DIR__ . '/../Model/UsuarioDAO.php';

    class AdminController {
        public function dashboard() {
            $view = 'View/Usuarios/Admin.php';
            include 'View/Main.php';
        }
    }
?>