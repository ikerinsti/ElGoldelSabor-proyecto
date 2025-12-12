<?php
include_once 'Database/Database.php';
include_once 'categoria.php';

class CategoriaDAO{

   public static function getCategorias()
    {
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM categoria");
        $stmt->execute();

        $results = $stmt->get_result();
        $listaCategorias = [];

        while ($categoria = $results->fetch_object('Categoria')) {
            $listaCategorias[] = $categoria;
        }

        $stmt->close();
        $conn->close();
        return $listaCategorias;
    }
    public static function getCategoriasPadre(){
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM categoria WHERE categoria_padre = ?");
        $stmt->bind_param("i", null);
        $stmt->execute();
        $results = $stmt->get_result();
        $categorias = [];
        while ($row = $results->fetch_object('Categoria')) {
            $categorias[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $categorias;
    }
    public static function getIdCategoriaActiva($categoriaActiva){
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT id_categoria FROM categoria WHERE nombre = ?");
        $stmt->bind_param("s", $categoriaActiva);
        $stmt->execute();
        $results = $stmt->get_result();
        $categorias = [];
        while ($row = $results->fetch_object('Categoria')) {
            $categorias[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $categorias;
    }
    public static function getCategoriasDelPadre($id_padre){
        $conn = database::connect();
        $stmt = $conn->prepare("SELECT * FROM categoria WHERE categoria_padre = ? ORDER BY nombre ASC");
        $stmt->bind_param("i", $id_padre);
        $stmt->execute();

        $results = $stmt->get_result();
        $categorias = [];
        while ($row = $results->fetch_object('Categoria')) {
            $categorias[] = $row;
        }

        $stmt->close();
        $conn->close();
        return $categorias;
    }
}
?>