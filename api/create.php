<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once('../config/database.php');
    include_once('../class/Productos.php');


    //Con esto lo que haremos será pasarle los valores de los productos para poder introducirlos en la base de datos


    $database = new Database();
    $db = $database->getConnection();

    $item = new Producto($db);

    $item->nombre = $_POST['nombre'];
    $item->precio = $_POST['precio'];
    $item->imagen = $_POST['imagen'];
    $item->descripcion = $_POST['descripcion'];
    $item->codigo = $_POST['codigo'];

    if ($item->createProduct()) {
        echo json_encode("Producto creado");
    } else {
        echo json_encode("No se ha podido crear el producto");
    }
    


?>