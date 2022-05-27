
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
                  
                    <button type="submit" class="btn btn-primary btn-block text-center" >Iniciar Sesión</button>
                </form>
            </div>
            </div>
        </div>
        <br>
    </form>
  </div>
  <?php
    include_once 'database.php';
    
    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // Si no hay sesión destruimos la sesión 
        session_destroy(); 
    }
    //Con esto lo que haremos será que una vez se identifica no pueda salir de esa pagina a menos que cierre la sesión 
    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
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
        }
    }

    //lo que hacemos con esto es que si el usuario y contraseña encajan con alguno de nuestra base de datos entonces accederá a su respectiva pagina
    
    if(isset($_POST['usuario']) && isset($_POST['contrasenia'])){
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];

        $db = new Database();
        $query = $db->connect()->prepare('SELECT *FROM usuarios WHERE usuario = :usuario AND contrasenia = :contrasenia');
        $query->execute(['usuario' => $usuario, 'contrasenia' => $contrasenia]);

        $row = $query->fetch(PDO::FETCH_NUM);
        
        if($row == true){
            $rol = $row[3];
            
            $_SESSION['rol'] = $rol;
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
            }
        }else{
            // no existe el usuario
            echo "Nombre de usuario o contraseña incorrecto";
        }
        

    }

?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>