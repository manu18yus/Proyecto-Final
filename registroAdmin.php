<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro del Administrador</title>
    <link rel="stylesheet" href="formulario.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
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
   
          
        </div>
      </nav>
   
  <!-- Formulario en el que introduciremos los datos para que despues lo validemos mediante js y lo mandemos a la base de datos mediante php  -->
      <div class="container ">
        <br><br>
          <form id="formulario" class="formulario">
            <div class="">
            <div class="">
                <div class="card">
                <div class="card-body bg-dark">
                    <form id="formulario">
                        <input type="hidden" id="taskId">

                        <div class="formulario__conjunto" id="grupo__nombre">
                            <label>Nombre</label><br>
                            <div class="formulario__conjunto-input">
                                <input type="text" name="nombre" id="nombre" placeholder="Escriba el nombre" class="form-control">
                                <img class="bien" src="check.png">
                                <img class="mal" src="cerrar.png">
                            </div>
                            <br>
                            <p class="formulario__input-error">Introduzca solo letras</p>
                        </div>

                        <div class="formulario__conjunto" id="grupo__apellido">
                            <label>Apellido</label><br>
                        <div class="formulario__conjunto-input">
                            <input type="text" name="apellido" id="apellido" placeholder="Escriba el apellido" class="form-control">
                            <img class="bien" src="check.png">
                            <img class="mal" src="cerrar.png">
                        </div>
                        <br>
                        <p class="formulario__input-error">Introduzca solo letras</p>
                        </div>

                        <div class="formulario__conjunto" id="grupo__usuario">
                            <label>Usuario</label><br>
                        <div class="form-conjunto-input">
                            <input type="text" name="usuario" id="usuario" placeholder="Escriba el usuario" class="form-control">
                            <img class="bien" src="check.png">
                            <img class="mal" src="cerrar.png">
                        </div>
                        <br>
                        <p class="formulario__input-error">Introduzca al menos 4 caracteres</p>
                        </div>


                        <!-- Grupo: Contrase??a -->
                        <div class="formulario__conjunto" id="grupo__contrasenia">
                          <label>Contrase??a</label>
                          <div class="formulario__conjunto-input">
                            <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Escriba la contrase??a">
                            <img class="bien" src="check.png">
                            <img class="mal" src="cerrar.png">
                          </div>
                          <br>
                          <p class="formulario__input-error">La contrase??a tiene que ser de 4 a 12 d??gitos.</p>
                        </div>

                        <!-- Grupo: Contrase??a 2 -->
                        <div class="formulario__conjunto" id="grupo__contrasenia2">
                          <label>Repetir Contrase??a</label>
                          <div class="formulario__grupo-input">
                            <input type="password" class="form-control" name="contrasenia2" id="contrasenia2" placeholder="Vuelva a introducir la contrase??a"> 
                            <img class="bien" src="check.png">
                            <img class="mal" src="cerrar.png">
                          </div>
                          <br>
                          <p class="formulario__input-error">Ambas contrase??as deben ser iguales.</p>
                        </div>

                        <div class="formulario__conjunto" id="grupo__dni">
                            <label>DNI</label><br>
                        <div class="form-conjunto-input">
                            <input type="text" name="dni" id="dni" placeholder="Escriba el dni" class="form-control">
                            <img class="bien" src="check.png">
                            <img class="mal" src="cerrar.png">
                        </div>
                        <br>
                        <p class="formulario__input-error">El Dni intorucido no es correcto, introduzca la letra en mayusculas</p>
                        </div>

                        <div class="formulario__conjunto" id="grupo__rol">
                          <label>Id</label><br>
                      <div class="form-conjunto-input">
                          <input type="text" name="rol_id" id="rol_id" placeholder="Administrador" class="form-control" value="1" readonly>
                          <img class="bien" src="check.png">
                          <img class="mal" src="cerrar.png">
                      </div>
                      <br>
                      <p class="formulario__input-error">2 para usuario anonimo y 3 para usuario com??n</p>
                      </div>

                      <div class="formulario__conjunto" id="grupo__email">
                          <label>Email</label><br>
                      <div class="form-conjunto-input">
                          <input type="text" name="email" id="email" placeholder="Escriba el hotmail" class="form-control">
                          <img class="bien" src="check.png">
                          <img class="mal" src="cerrar.png">
                      </div>
                      <br>
                      <p class="formulario__input-error">Introduzca un correo v??lido</p>
                      </div>

                        <br>
                        <button type="submit" class="btn btn-warning btn-block text-center">Guardar</button>
                    </form>
                </div>
                </div>
            </div>
            <br>
        </form>
      </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="formulario.js"></script>
</body>
</html>