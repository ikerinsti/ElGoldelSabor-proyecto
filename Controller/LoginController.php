<?php
    include_once 'Model/UsuarioDAO.php';

    class LoginController {
        public function index() {
            $view = 'View/Session/Login.php';
            include 'View/main.php';
        }
    }
?>