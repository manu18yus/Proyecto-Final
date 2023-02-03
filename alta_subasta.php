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

    if(isset($_POST["agregar"])){

      //Variables que se guardaran en la tabla producto
      $nombre = $_POST["nombre"];
      $descripcion = $_POST["descripcion"];
      $categoria = $_POST["categoria"];
      $foto = $_FILES["foto"]["name"];//nombre de la imagen del producto
      $ruta = $_FILES["foto"]["tmp_name"];//ruta de la imagen del producto

      //Variables que se guardaran en la tabla subasta
      $p_minimo = $_POST["minimo"];
      $p_maximo = $_POST["maximo"];
      $fecha_hora_actual = date("Y-m-d H:i:s");
      $fecha_fin = $_POST["fecha_fin"];//Esto no se insertara en la tabla
      $hora_fin = $_POST["hora_fin"];//Esto no se insertara en la tabla
      $fecha_hora_fin = "$fecha_fin $hora_fin:00";
      $estado = 0;//1 = vendida && 0 = disponible
      $subastador = $_SESSION["id_usuario"];


      //Si no se introduce ninguna foto, por defecto seleccionamos una foto llamada default
      //Si todods los campos que se han introducido son los que se esperaban se subirá la licitación si no saltará una alerta diciendo que no se pudo subir
      if($foto == null){

        $res = $bd->query("INSERT into producto(nombre, descripcion, imagen, id_categoria)
                            values('$nombre','$descripcion','default.jpg',$categoria);");

        if($res==true){
          echo "<script>alert('Licitación agregada correctamente');</script>";
          $id_producto = $bd->insert_id();

          $res2 = $bd->query("INSERT into subasta(min, max, tiempo_ini, tiempo_fin, estado, subastador, id_producto)
                              values($p_minimo,$p_maximo,'$fecha_hora_actual','$fecha_hora_fin',$estado,$subastador,$id_producto);");
          if($res2==true){
            echo "<script>alert('Puja agregada correctamente');</script>";
          }else{
            echo "<script>alert('No se pudo agregar la puja');</script>";
          }
        }else{
          echo "<script>alert('No se pudo agregar la licitación ni la subasta');</script>";
        }

      }else{

        $dest = "imagenes/productos/";
        copy($ruta,$dest.''.$foto);

        $res = $bd->query("INSERT into producto(nombre, descripcion, imagen, id_categoria)
                            values('$nombre','$descripcion','$foto',$categoria);");

        if($res==true){
          echo "<script>alert('Licitación agregada correctamente');</script>";
          $id_producto = $bd->insert_id();

          $res2 = $bd->query("INSERT into subasta(min, max, tiempo_ini, tiempo_fin, estado, subastador, id_producto)
                              values($p_minimo,$p_maximo,'$fecha_hora_actual','$fecha_hora_fin',$estado,$subastador,$id_producto);");

          if($res2==true){
            echo "<script>alert('Puja agregada correctamente');</script>";
          }else{
            echo "<script>alert('No se pudo agregar la puja');</script>";
          }
        }else{
          echo "<script>alert('No se pudo agregar la licitación ni la puja');</script>";
        }
      }

    }

  ?>

    <div id="wrapper">
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
                        <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="cesta.php">Cesta</a></li>
                        <li class="nav-item"><a class="nav-link" href="cuenta.php">Cuenta</a></li>
                        <li class="nav-item"><a class="nav-link" href="alta_categoria.php">Añadir Categoria</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
            <?php
              include ("header.php");
            ?>
          </nav>
       
          <div class="row" id="contenedor">
           <div class= "col-6">
              <h1 class="nombre_pagina">Pujas Arqués</h1>
              <p class="nombre">Manuel Arqués Yus</p>
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
                                <i class="inicio">AÑADIR LICITACIÓN</i> 
                            </li>
                        </ol>
                    </div>
                </div>

                      <div class="row">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                          <div class="col-lg-6">
                                <h3 class="lista_blanca">Detalles de la licitación</h3>

                                  <div class="form-group">
                                      <label class="lista_blanca">Nombre</label>
                                      <input type="text" name="nombre" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label class="lista_blanca">Descripcion</label>
                                      <textarea name="descripcion" class="form-control" required></textarea>
                                  </div>

                                  <div class="form-group">
                                      <label class="lista_blanca">Categoria</label>
                                      <select class="form-control" name="categoria">
                                          <?php
                                            $res = $bd->select("SELECT * from categoria");
                                            if($res->num_rows > 0){
                                              while($row = $res->fetch_assoc()){
                                                echo "<option value='".$row["id_categoria"]."'>".$row["categoria"]."</option>";
                                              }
                                            }else{
                                              echo "<option value='s/c'>Agrega una desde navegación</option>";
                                            }
                                          ?>
                                      </select>
                                      <p class="text-info">Si no esta la categoria que busca puede agregarla desde la zona de navegación</p>
                                  </div>

                                  <div class="form-group">
                                      <label class="lista_blanca">Foto</label>
                                      <input type="file" name="foto">
                                  </div>
                        <br>
                        </div>
                        <div class="col-lg-6">
                              <h3 class="lista_blanca">Otros detalles</h3>

                                  <div class="form-group">
                                      <label class="lista_blanca">Precio minimo</label>
                                      <input type="number" name="minimo" class="form-control">
                                  </div>

                                  <div class="form-group">
                                      <label class="lista_blanca">Precio maximo</label>
                                      <input type="number" name="maximo" class="form-control"  required>
                                  </div>

                                  <div class="form-group">
                                      <label class="lista_blanca">Fecha de cierre</label>
                                      <input type="date" name="fecha_fin" class="form-control" required>
                                  </div>

                                  <div class="form-group">
                                      <label class="lista_blanca">Hora de cierre</label>
                                      <input type="time" name="hora_fin" class="form-control" required>
                                  </div>

                                  <br>

                                  <button name="agregar" type="submit" class="btn btn-success">Subastar</button>
                                  <button type="reset" class="btn btn-danger">Cancelar</button>
                          </div>
                        </form>
                      </div>
                  <br>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
