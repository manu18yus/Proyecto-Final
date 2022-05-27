<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

    include_once('../config/database.php');
    include_once('../class/Productos.php');

    $database = new Database();
    $db = $database->getConnection();

    $item = new Producto($db);

    //Le pasamos los datos que tenemos de nuestra base de datos y a partir de ellos los modificamos

    $item->id = $_POST['id'];
    $item->nombre = $_POST['nombre'];
    $item->precio = $_POST['precio'];
    $item->imagen = $_POST['imagen'];
    $item->descripcion = $_POST['descripcion'];
    $item->codigo = $_POST['codigo'];

    if ($item->updateProduct()) {
        echo "Producto actualizado";
    } else {
        echo "El producto no se ha podido actualizar";
    }


?>