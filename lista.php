<?php

//Seleccionamos todos los usuarios de la base de datos y se muestrán en la zona de administración en una tabla 

    include('baseDatos.php');

    $query = "SELECT * from usuario";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query fallida' . mysqli_error($connection));
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'correo' => $row['correo'],
            'user' => $row['user'],
            'pass' => $row['pass'],
            'rol_id' => $row['rol_id'],
            'id_usuario' => $row['id_usuario']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring
?>