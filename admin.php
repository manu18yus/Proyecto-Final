
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final - Manuel Arqués Yus</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="imagenes/logo.png" alt="" width="150">
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

                <div class="navegacion collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        </a>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
    </nav>

    <div class="row" id="contenedor">
        <div class= "col-6">
            <h1 class="nombre_pagina">Pujas Arqués</h1>
            <p class="nombre">Manuel Arqúes Yus</p>
        </div>
        <div class="col-6">
            <img class="logo" src="imagenes/logo.png" alt="" width="200">
        </div>
        </div>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="inicio">PANEL DE ADMINISTRACIÓN DE USUARIOS</i> 
                            </li>
                        </ol>
                    </div>
                </div>


            <form class="form-inline my-2 my-lg-0">
                <div class="boton">
                    <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="buscador" aria-label="Search">
                    <button id="buscador" class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
                </div>
            </form>
 
  
            <div class="container">
        <br><br>
          <form id="formulario" class="formulario">
            <div class="">
            <div class="">
                <div class="card">
                <div class="card-body">
                    <form id="formulario">
                        <input type="hidden" id="taskId">

                        <div class="formulario__conjunto"  id="grupo__correo">
                            <label class="texto_blanco">Correo</label><br>
                            <div class="formulario__conjunto-input">
                            <input name="correo" id="correo" class="form-control" type="text" placeholder="Introduzca un correo" required autofocus>
                        </div>
                            <img class="bien" src="imagenes/check.png">
                            <img class="mal" src="imagenes/cerrar.png">
                            <p class="formulario__input-error">Introduzca un correo válido</p>
                        </div>

                        <div class="formulario__conjunto" id="grupo__user">
                            <label class="texto_blanco">Usuario</label><br>
                            <div class="formulario__conjunto-input">
                            <input name="user" id="user" class="form-control" type="text" placeholder="Introduzca un usuario" required >
                        </div>
                            <img class="bien" src="imagenes/check.png">
                            <img class="mal" src="imagenes/cerrar.png">
                            <p class="formulario__input-error">Introduzca al menos 4 caracteres</p>
                        </div>

                        <div class="formulario__conjunto" id="grupo__pass">
                            <label class="texto_blanco">Contraseña</label><br>
                            <div class="formulario__conjunto-input">
                            <input  name="pass" id="pass" class="form-control" type="password" placeholder="Introduzca una contraseña" required>
                        </div>
                            <img class="bien" src="imagenes/check.png">
                            <img class="mal" src="imagenes/cerrar.png">
                            <p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
                        </div>

                        <div class="formulario__conjunto" id="grupo__rol_id">
                            <label class="texto_blanco">Rol</label><br>
                            <div class="formulario__conjunto-input">
                            <input  name="rol_id" id="rol_id" class="form-control" type="text" placeholder="Rol" required>
                        </div>
                            <img class="bien" src="imagenes/check.png">
                            <img class="mal" src="imagenes/cerrar.png">
                            <p class="formulario__input-error">1 para admin, 2 para usuario, 3 para anónimo</p>
                        </div>

                        <br>
                        <button type="submit"  id="boton" class="btn btn-block text-center">Guardar</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="">
                <div class="task-result" id="task-result">
                <div class="card-body">
                    <ul id="container"></ul>
                </div>
                </div>
                
                <table class="table table-bordered table-sm">
                    <br>
                <thead>
                    <tr>
                    <td class="texto_blanco">Id</td>
                    <td class="texto_blanco">Usuario</td>
                    <td class="texto_blanco">Correo</td>
                    <td class="texto_blanco">Contraseña</td>
                    <td class="texto_blanco">Rol</td>
                    <td class="texto_blanco">Opciones</td>
                    </tr>
                </thead>
                <tbody id="tasks"></tbody>
                </table>
            </div>
            </div>
        </form>
      </div>
     
            </div>
        </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/formulario.js"></script>
    <script type="text/javascript" src="ajax/admin.js"></script>
</body>
</html>