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

  <!--NAVBAR-->
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

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ml-auto">
           <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
           <li class="nav-item"><a class="nav-link" href="index.php">Principal</a></li>
           <li class="nav-item"><a class="nav-link" href="registro.php">Registro</a></li>
           <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
           <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
         </ul>
       </div>
     </div>
   </nav>


   <div class="container ">
    <br><br>
      <form id="formulario" class="formulario" method="post" action="#">
        <div class="">
        <div class="">
            <div class="card">
            <div class="card-body bg-dark">
                <form id="formulario">
                    <input type="hidden" id="taskId">

                    <div class="formulario__conjunto" id="grupo__contrasenia">
                      <label>Token de usuario</label>
                      <div class="formulario__conjunto-input">
                        <input type="text" class="form-control" name="token" id="token" placeholder="Escriba el token">>
                      </div>
                    </div>
                  
                    <button type="submit" class="btn btn-warning btn-block text-center" >Guardar</button>
                </form>
            </div>
            </div>
        </div>
        <br>
    </form>
  </div>

  <?php

  session_start();
  include ("config/database.php");

  if(isset($_POST['token'])){
        $token = $_POST['token'];
        $db = new Database();

        $cnx = mysqli_connect("localhost", "root", "root", "blog");
        $sql = "SELECT * FROM usuarios WHERE token = '$token'";
      
        $result = $cnx  -> query($sql);
        $row = $result -> fetch_array(MYSQLI_NUM);
        
        mysqli_close($cnx);
        if($row == true){
            $rol = $row[3];

            switch($rol){
                //rol de administrador
                case 1:
                    header('location: admin.php');
                break;
                //rol de usuario anonimo
                case 2:
                header('location: colab.php');
                break;
                //rol de usuario 
                case 3:
                  header('location: index.php');
                  break;

                default:
                echo " sin rol";
            }
        } else{
          // no existe el usuario
          echo "Token introducido incorrecto";
      }
    } 
        
?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>