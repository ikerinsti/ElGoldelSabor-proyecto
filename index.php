<?php
    include_once 'Controller/ProductoController.php';
    
    if(isset($_GET['controller'])){
        $nombre_controller = $_GET['controller'] . 'Controller';
        if (class_exists($nombre_controller)){
            $controller = new $nombre_controller();
            $action = $_GET['action'];
            if(isset($action) && method_exists($controller, $action)){
                $controller -> $action();
            }else{
                header("location: 404.php");
            }
        }
    }else{

    }


    //http://localhost/ElGoldelSabor/?controller=Producto&action=show
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once 'View/nav.php';
    ?>
    <?php
        require_once 'View/footer.php';
    ?>
</body>
</html>