<?php
//seleccionaremos todos los datos de la tabla y los mostraremos
    include('baseDatos.php');
    $id = $_POST['id'];

    $query = "SELECT * FROM registro WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query fallido');
    }
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'nombre' => $row['nombre'], 
            'apellido' => $row['apellido'], 
            'usuario' => $row['usuario'], 
            'dni' => $row['dni'],
            'id' => $row['id'] 
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>
