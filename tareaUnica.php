<?php
//Seleccionamos el id de la tabla usuario y le pasamos los valores de la misma

    include('baseDatos.php');
    $id_usuario = $_POST['id_usuario'];

    $query = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query fallido');
    }
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'correo' => $row['correo'], 
            'user' => $row['user'], 
            'pass' => $row['pass'], 
            'rol_id' => $row['rol_id'],
            'id_usuario' => $row['id_usuario'] 
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>
