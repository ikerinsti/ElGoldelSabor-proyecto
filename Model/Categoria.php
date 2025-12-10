<?php 
class Categoria {
    private $id_categoria;
    private $nombre;
    private $descripcion;
    private $categoria_padre;

    public function getId_categoria(){
        return $this->id_categoria;
    }
    public function getnombre(){
        return $this->nombre;
    }
    public function getdescripcion(){
        return $this->descripcion;
    }
    public function getCategoriaPadre(){
        return $this->categoria_padre;
    }
}
?>
