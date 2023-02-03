<?php

include('baseDatos.php');

//Esto es un buscador que tendrá la zona de administración y servirá para buscar usuarios dentro de la base de datos 
//mediante ajax permitirá que aparezcan los usuarios en tiempo real sin la necesidad de recargar la página

$search = $_POST['search'];
if(!empty($search)) {
  $query = "SELECT * FROM usuario WHERE correo LIKE '$search%'";
  $result = mysqli_query($connection, $query);
  
  if(!$result) {
    die('Query Error' . mysqli_error($connection));
  }
  
  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'correo' => $row['correo'],
      'user' => $row['user'],
      'pass' => $row['pass'],
      'rol_id' => $row['rol_id'],
      'id_usuario' => $row['id_usuario'],
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

?>
