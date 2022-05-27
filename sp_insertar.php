<?php
//Con esto lo que haremos será introducir usuarios a la base de datos introduciendo los datos
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];
$rol_id = $_POST['rol_id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$contrasenia2 = $_POST['contrasenia2'];
$dni = $_POST['dni'];

$cnx = mysqli_connect("localhost", "root", "root", "blog");
$sql = "INSERT INTO usuarios (usuario, contrasenia, rol_id, nombre, apellido, contrasenia2, dni) VALUES ('$usuario','$contrasenia', '$rol_id', '$nombre', '$apellido', '$contrasenia2', '$dni')";
$rta = mysqli_query($cnx, $sql);

if(!$rta){
    echo "No se ha podido insertar los valores";
}else {
    header("Location: admin.php");
}


?>