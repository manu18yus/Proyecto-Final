<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();

  if(!isset($_SESSION["id_usuario"])){
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final - Manuel Arqués Yus</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

  <?php
  
  //mediante sql hacemos una inserción de una nueva categoria y descripción en la base de datos

    if(isset($_POST["agregar"])){

      $categoria = $_POST["categoria"];
      $descripcion = $_POST["descripcion"];
      $res = $bd->query("INSERT into categoria(categoria, descripcion) values('$categoria','$descripcion');");

      if($res==true){
        echo "<script>window.onload = () => {
          alert('Categoria agregada correctamente');
        }</script>";
      }else{
        echo "<script>window.onload = () => {
          alert('No se pudo agregar categoria');
        }</script>";
      }
    }
  ?>

<!--Aqui se muestra el menu de navegación-->
    <div id="wrapper">
        <nav class="navbar navbar-expand-sm navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img id="logo_inicio" src="imagenes/logo.png" alt="logotipo" width="150">
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
                        <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="cesta.php">Cesta</a></li>
                        <li class="nav-item"><a class="nav-link" href="cuenta.php">Cuenta</a></li>
                        <li class="nav-item"><a class="nav-link" href="alta_subasta.php">Añadir Licitación</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
            <?php
              include ("header.php");
            ?>
        </nav>

        <!--Aqui se encuentrá la información de la pagina -->
        <div class="row" id="contenedor">
        <div class= "col-6">
            <h1 class="nombre_pagina">Pujas Arqués</h1>
            <p class="nombre">Manuel Arqués Yus</p>
        </div>
        <div class="col-6">
            <img id="logo_medio" class="logo" src="imagenes/logo.png" alt="" width="200">
        </div>
        </div>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="inicio">AÑADIR CATEGORIA</i> 
                            </li>
                        </ol>
                    </div>
                </div>
<!--Aqui se muestra un pequeño formulario donde estan los campos de nombre y descripción para que el usuario creé una nueva categoria-->
                <div class="row" id="agregar_licitacion">
                  <div class="col-lg-6">
                    <form  role="form" action="" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="lista_blanca">Nombre
                          <input id="input_agregar" type="text" name="categoria" class="form-control" required>
                        </label>
                      </div>

                      <div class="form-group">
                        <label class="lista_blanca">Descripcion
                          <textarea id="input_agregar" name="descripcion" class="form-control" required></textarea>
                        </label>
                      </div><br>
                                
                      <button name="agregar" type="submit" id="boton_medio" class="btn">Agregar</button>
                      <button type="reset" class="btn btn-danger">Cancelar</button>
                                  
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
