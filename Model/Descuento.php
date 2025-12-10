<?php 
    class Descuento{
        private $id_descuento;
        private $codigo;
        private $nombre;
        private $descripcion;
        private $img_oferta;
        private $tipo;
        private $valor;
        private $ambito;

        public function getId_descuento(){
            return $this->id_descuento;
        }
        public function getCodigo(){
            return $this->codigo;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function getImg_oferta(){
            return $this->img_oferta;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function getValor(){
            return $this->valor;
        }
        public function getAmbito(){
            return $this->ambito;
        }
    }
?>