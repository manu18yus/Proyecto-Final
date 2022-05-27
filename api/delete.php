<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once('../config/database.php');
    include_once('../class/Productos.php');

    //Mediante el id eliminaremos un producto de la base de datos

    $database = new Database();
    $db = $database->getConnection();

    $item = new Producto($db);
    $item->id = $_POST['id'];
    

    if ($item->deleteProduct()) {
        echo json_encode("Producto eliminado");
    } else {
        echo json_encode("El producto no se ha podido eliminar");
    }



?>