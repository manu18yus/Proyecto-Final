<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
</head>

<body>
    <div class="contenedor">
        <div class="tarjeta_login">
            <div class="tarjeta_login_logo">
                <img src="imagenes/logo.png" alt="logo">
            </div>
            <div class="tarjeta_login_header">
                <h1>Token del Usuario</h1>
            </div>
            <form class="formulario" method="post">
                <div class="formulario__objeto">
                    <span class="formulario_objeto_icono material-symbols-rounded">lock</span>
                    <input name="token" type="text" placeholder="Introduzca el Token" required>
                </div>
                <button type="submit" name="entrar" value="Entrar">Crear Usuario</button>
            </form>
        </div>
    </div>

<?php

// Conexion 
$conn = new mysqli("localhost", "root", "root", "subastas");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['token'])){
    $token = $_POST['token'];

    $sql = "SELECT token FROM usuario WHERE token = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si encuentra el token en la base de datos
        header("Location: login.php");
    } else {
        echo "<script>alert('El token que has introducido no es valido');</script>";
    }
}

$conn->close();
?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
