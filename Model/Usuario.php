<?php 
    class Usuario{
        private $id_usuario;
        private $nombre;
        private $email;
        private $contraseña;
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
        public function getContraseña() {
            return $this->contraseña;
        }
        public function getRol() {
            return $this->rol;
        }
        public function getDireccion() {
            return $this->direccion;
        }
        public function toArray() {
            return [

                'id_usuario' => $this->id_usuario,
                'nombre' => $this->nombre,
                'email' => $this->email,
                'rol' => $this->rol,
                'direccion' => $this->direccion
            ];
        }
    }
?>