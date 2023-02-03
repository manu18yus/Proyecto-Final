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
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
</head>

<body>

    <?php
    
//Aqui pasaremos los siguientes valores en caso de que se introduzcan en la base de datos redireccionamos al usuario al email donde se mandará un email 
//al correo que el usuario haya puesto en este registo y mediante el uso de sesiones le pasamos el id y el correo.

      if(isset($_POST["registro"])){
        
        $correo = $_POST["correo"];
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $rol_id = $_POST["rol_id"];

        $query = "INSERT into usuario(correo, user, pass, rol_id) values('$correo','$user','$pass', '$rol_id');";

        $result = $bd->query($query);
        $id_usuario = $bd->insert_id();

        if($result == true){
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['correo'] = $correo;
            header('location: email/index.php');
        }else{
            echo "<script>alert('No se ha podido registrar el usuario pruebe de nuevo con otros datos');</script>";
        }
      }
    ?>

<div class="contenedor">
        <form id="formulario" class="formulario" method="post">
            <div class="tarjeta_login">
                <div class="tarjeta_login_logo">
                    <img src="imagenes/logo.png" alt="logo">
                </div>
                <div class="tarjeta_login_header">
                    <h1>Registro de Usuario</h1>
                </div>
                <form id="formualario">

                  <div class="formulario__conjunto"  id="grupo__correo">
                        <div class="formulario__conjunto-input">
                        <span class="formulario_objeto_icono material-symbols-rounded">email</span>
                            <input name="correo" id="correo" class="form-control" type="text" placeholder="Introduzca un correo" required autofocus>
                        </div>
                        <img class="bien" src="imagenes/check.png">
                        <img class="mal" src="imagenes/cerrar.png">
                        <p class="formulario__input-error">Introduzca un correo válido</p>
                    </div>

                    <div class="formulario__conjunto" id="grupo__user">
                        <div class="formulario__conjunto-input">
                        <span class="formulario_objeto_icono material-symbols-rounded">person</span>
                            <input name="user" id="user" class="form-control" type="text" placeholder="Introduzca un usuario" required >
                        </div>
                        <img class="bien" src="imagenes/check.png">
                        <img class="mal" src="imagenes/cerrar.png">
                        <p class="formulario__input-error">Introduzca al menos 4 caracteres</p>
                    </div>

                    <div class="formulario__conjunto" id="grupo__pass">
                        <div class="formulario__conjunto-input">
                        <span class="formulario_objeto_icono material-symbols-rounded">lock</span>
                            <input  name="pass" id="pass" class="form-control" type="password" placeholder="Introduzca una contraseña" required>
                        </div>
                        <img class="bien" src="imagenes/check.png">
                        <img class="mal" src="imagenes/cerrar.png">
                        <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                    </div>

                    <div class="formulario__conjunto" id="grupo__rol">
                        <div class="formulario__conjunto-input">
                            <input  name="rol_id" id="rol_id" class="form-control" type="hidden" placeholder="Usuario" value="2" readonly>
                        </div>
                        <img class="bien" src="imagenes/check.png">
                        <img class="mal" src="imagenes/cerrar.png">
                        <p class="formulario__input-error">2 para usuario</p>
                    </div>

                    <button class="boton_registro" type="submit" name="registro" value="Registrarme">CREAR USUARIO</button>
                    
                </form>
                <div class="tarjeta_login_footer">
                    ¿Tienes ya una cuenta? <a href="login.php">Iniciar Sesión</a>
                </div>
            </div>
        </form>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/formulario.js"></script>
</body>
</html>
