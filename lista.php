<?php

//Con este php lo que haremos será listar los usuarios 
    include('baseDatos.php');

    $query = "SELECT * from registro";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query fallida' . mysqli_error($connection));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'usuario' => $row['usuario'],
            'dni' => $row['dni'],
            'id' => $row['id']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring
?>