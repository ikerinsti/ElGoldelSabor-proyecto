<?php 
    class Pedido{
        private $id_pedido;
        private $fecha;
        private $total;
        private $direccion_pedido;
        private $estado;
        private $tipo_entrega;
        private $id_usuario;
        private $id_descuento;

        public function getId_pedido(){
            return $this->id_pedido;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function getTotal(){
            return $this->total;
        }
        public function getDireccion_pedido(){
            return $this->direccion_pedido;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function getTipo_entrega(){
            return $this->tipo_entrega;
        }
        public function getId_usuario(){
            return $this->id_usuario;
        }
        public function getId_descuento(){
            return $this->id_descuento;
        }
    }
?>