<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once('../config/database.php');
    include_once('../class/Productos.php');


    // lectura unica de los datos de la base de datos
    
    $database = new Database();
    $db = $database->getConnection();

    $item = new Producto($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die(); 
    $item->getSingleProduct();

    if ($item->nombre != null) {
        // Creación del aray
        $prd_arr = array(
            "id" => $id,
            "nombre" => $nombre,
            "precio" => $precio,
            "imagen" => $imagen,
            "descripcion" => $descripcion,
            "codigo" => $codigo
        );
        http_response_code(200);
        echo json_encode($prd_arr);
    } else {
        http_response_code(404);
        echo json_encode("Synth not found");
    }


?>