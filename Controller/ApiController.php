<?php
    include_once 'Model/UsuarioDAO.php';
    include_once 'Model/CategoriaDAO.php';
    
    class ApiController {

        public function getCategorias() {
        header('Content-type: application/json; charset-utf-8');

        $listaCategorias = CategoriaDAO::getCategorias();
        $data = [];

        foreach ($listaCategorias as $categoria) {
            $data[] = $categoria->toArray();
        }

        echo json_encode($data);
        }



        public function getUsuarios() {
        header('Content-type: application/json; charset-utf-8');

        $usuarios = UsuarioDAO::getUsuarios();
        $data = [];

        foreach ($usuarios as $usuario) {
            $data[] = $usuario->toArray();
        }

        echo json_encode($data);
        }
    }
?>