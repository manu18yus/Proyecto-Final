<?php

//Php en el que le pasamos todos los campos de la tabla usuarios de nuestra base de datos para poder editar los campos que queramos
$id = $_POST['id'];
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];
$rol_id = $_POST['rol_id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$contrasenia2 = $_POST['contrasenia2'];
$dni = $_POST['dni'];

$cnx = mysqli_connect("localhost", "root", "root", "blog");
$sql = "UPDATE usuarios SET usuario='$usuario', contrasenia='$contrasenia', rol_id='$rol_id', nombre='$nombre', apellido='$apellido', contrasenia2='$contrasenia2', dni='$dni' WHERE id like $id";
$rta = mysqli_query($cnx, $sql);

if(!$rta){
    echo "No se ha podido actualizar los datos";
}else {
    header("Location: admin.php");
}


?>