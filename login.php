<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();

  if(isset($_SESSION["id_usuario"])){
    header("Location: inicio.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
</head>

<body>

<?php

//Seleccionamos el usuario y la contraseña si son iguales se mirá el rol del usuario en caso de que el rol sea uno se le redirigirá a la zona de administración
//En cambio si el rol del usuario es 2 o 3 accederá a la zona de inicio.

$user = $_POST['user'];
$pass = $_POST['pass'];

$conexion=mysqli_connect("localhost", "root", "root", "subastas");

$consulta="SELECT * from usuario where user='$user' and pass='$pass';";
$resultado=mysqli_query($conexion, $consulta);

$filas=mysqli_fetch_array($resultado);

$result = $bd->select($consulta);


if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    $id_us = $row["id_usuario"];
  }

  $_SESSION['id_usuario'] = $id_us;

  if($filas['rol_id']==1){
    header('location: admin.php');
  }else if($filas['rol_id']==2){
    $_SESSION['id_usuario'];
    header('location: inicio.php');
  }else if($filas['rol_id']==3){
    header('location: inicio.php');
  }
  mysqli_free_result($resultado);
  mysqli_close($conexion);

}

?>

    <div class="contenedor">
        <div class="tarjeta_login">
            <div class="tarjeta_login_logo">
                <img src="imagenes/logo.png" alt="logo">
            </div>
            <div class="tarjeta_login_header">
                <h1>Inicio de Sesión</h1>
            </div>
            <form class="formulario" method="post">
                <div class="formulario__objeto">
                    <span class="formulario_objeto_icono material-symbols-rounded">person</span>
                    <input name="user" type="text" placeholder="Introduzca el usuario" required autofocus>
                </div>
                <div class="formulario__objeto">
                    <span class="formulario_objeto_icono material-symbols-rounded">lock</span>
                    <input name="pass" type="password" placeholder="Introduzca la contraseña" required>
                </div>
                <button type="submit" name="entrar" value="Entrar">INICIAR SESIÓN</button>
            </form>
            <div class="tarjeta_login_footer">
                ¿No tienes una cuenta? <a href="registro.php">Registrarse</a>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
