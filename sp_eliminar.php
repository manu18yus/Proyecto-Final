<?php

//Este php elimina de la tabla usuario mediante el id el usuario que sea
$id = $_GET['id'];

$cnx = mysqli_connect("localhost", "root", "root", "blog");
$sql = "DELETE FROM usuarios WHERE id like $id";
$rta = mysqli_query($cnx, $sql);

if(!$rta){
    echo "No se ha podido eliminar los datos";
}else {
    header("Location: admin.php");
}


?>