<?php

//Con este php lo que haremos será modificar un usuario mediante el update de sql. En la zona de administración haremos click en un usuario 
//Al hacer click nos saldrán los datos y cuando mandemos el formulario con los valores cambiados se actualizarán en la base de datos

    include('baseDatos.php');

    $id_usuario = $_POST['id_usuario'];
    $correo = $_POST['correo'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $rol_id = $_POST['rol_id'];

    $query = "UPDATE usuario SET correo = '$correo', user = '$user', pass = '$pass', rol_id = '$rol_id' WHERE id_usuario = '$id_usuario'";

    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Query fallido');
    }
    echo "Cambio de usuario completado";
    
?> 