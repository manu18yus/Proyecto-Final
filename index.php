<?php

//Si en la base de datos hay 4 usuarios se le redirigirá al registro admin para la primera instalación de la pagina
//donde se introducirá en la base de datos el usuario administrador.

$cnx = mysqli_connect("localhost", "root", "root", "subastas");
$sql = "SELECT COUNT(*) FROM usuario";

$result = $cnx  -> query($sql);
$row = $result -> fetch_array(MYSQLI_NUM);

  echo $row [0];
  $numeroUserDb = 4;
    if($numeroUserDb == $row[0]){
      header('location: registroAdmin.php');
    }else{
      header('location: login.php');
    }
?>
