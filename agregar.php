<?php

//Mediante el metodo post introduciremos los datos de forma grafica a la base de datos mediante insert into

    include('baseDatos.php');

    if(isset($_POST['nombre'])){
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $rol_id = $_POST['rol_id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido2'];
        $contrasenia = $_POST['contrasenia2'];
        $dni = $_POST['dni'];

            $query = "INSERT into usuarios(usuario, contrasenia, rol_id, nombre, apellido, contrasenia2, dni) VALUES ('$usuario', '$contrasenia', '$rol_id', '$nombre','$apellido', '$contrasenia2', '$dni')";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die('Query fallido');
            }
            echo 'Tarea agregada satisfactoriamente';
    }

?>