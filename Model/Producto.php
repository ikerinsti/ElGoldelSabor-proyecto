<?php 
    class Producto {
        private $id_producto;
        private $nombre;
        private $descripcion;
        private $precio;
        private $id_descuento;
        private $id_categoria;

        public function getId_producto() {
            return $this->id_producto;
        }
        public function getNombre() {
            return $this->nombre;
        }
        public function getDescripcion() {
            return $this->descripcion;
        }
        public function getPrecio() {
            return $this->precio;
        }
        public function getId_descuento() {
            return $this->id_descuento;
        }
        public function getId_categoria() {
            return $this->id_categoria;
        }
    }
?>