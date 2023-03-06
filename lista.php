<?php

//Seleccionamos todos los usuarios de la base de datos y se muestrán en la zona de administración en una tabla 

    include('baseDatos.php');

    //Con esta consulta sql lo que haremos será pasarle al usuario los valores del id, correo, user, pass y rol
    //pero el rol se lo pasaremos de la tabla roles mediante un inner join
    $query = "SELECT usuario.id_usuario, usuario.correo, usuario.user, usuario.pass, roles.rol
    FROM usuario
    INNER JOIN roles ON usuario.rol_id = roles.id
    ";
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
            'rol' => $row['rol'],
            'id_usuario' => $row['id_usuario']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring
?>