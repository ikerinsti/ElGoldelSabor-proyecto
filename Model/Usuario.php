<?php 
    class Usuario{
        private $id_usuario;
        private $nombre;
        private $email;
        private $password;
        private $rol;
        private $direccion;

        public function getId_usuario() {
            return $this->id_usuario;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getPassword() {
            return $this->password;
        }
        public function getRol() {
            return $this->rol;
        }
        public function getDireccion() {
            return $this->direccion;
        }
    }
?>