 <!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="formulario.css">
</head>
<body>
-->
  <!--NAVBAR-->
   <!--
   <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
     <div class="container-fluid">
       <a class="navbar-brand" href="#">
         <img src="imagenes/logo.png" alt="" width="200">
       </a>

       <button class="navbar-toggler"
       type="button" 
       data-toggle="collapse"
       data-target="#navbarSupportedContent"
       aria-controls="navbarSupportedContent"
       aria-expanded="false"
       aria-label="Toogle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
   </nav>

    <div align="center">
        <br><br><h3>Introduzca datos del administrador para continuar:</h3> 
    </div>

   <div class="container ">
    <br><br>
      <form id="formulario" class="formulario" method="post" action="#">
        <div class="">
        <div class="">
            <div class="card">
            <div class="card-body bg-dark">
                <form id="formulario">
                    <input type="hidden" id="taskId">

                    <div class="formulario__conjunto" id="grupo__usuario">
                        <label>Usuario</label><br>
                    <div class="form-conjunto-input">
                        <input type="text" name="usuario" id="usuario" placeholder="Escriba el usuario" class="form-control">
                    </div>
                    </div>

                    <div class="formulario__conjunto" id="grupo__contrasenia">
                      <label>Contraseña</label>
                      <div class="formulario__conjunto-input">
                        <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Escriba la contraseña">>
                      </div>
                    </div>
                  
                    <button type="submit" class="btn btn-warning btn-block text-center" >Iniciar Sesión</button>
                </form>
            </div>
            </div>
        </div>
        <br>
    </form>
  </div>
-->
<?php

$cnx = mysqli_connect("localhost", "root", "root", "blog");
$sql = "SELECT COUNT(*) FROM usuarios";

$result = $cnx  -> query($sql);
$row = $result -> fetch_array(MYSQLI_NUM);

  echo $row [0];
  $numeroUserDb = 7;
    if($numeroUserDb == $row[0]){
      header('location: registroAdmin.php');
    }else{
      header('location: login.php');
    }
  
?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>