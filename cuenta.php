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
                        <li class="nav-item"><a class="nav-link" href="alta_subasta.php">Añadir Licitación</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
            <?php
              include ("header.php");
            ?>
          </nav>
       

        <div id="page-wrapper">
            <div class="container-fluid">

              <div class="row" id="contenedor">
                <div class= "col-6">
                  <h1 class="nombre_pagina">Pujas Arqués</h1>
                  <p class="nombre">Manuel Arqués Yus</p>
                </div>
              <div class="col-6">
                <img class="logo" src="imagenes/logo.png" alt="" width="200">
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <ol class="breadcrumb">
                  <li>
                    <i class="inicio">CUENTA</i> 
                  </li>
                </ol>
              </div>
            </div>

                <!-- Listado de subastas -->
                <div class="row">
                  <div class="col-lg-6">

                    <div class="table-responsive">
                      <h2 class="lista_blanca">Licitaciones activas</h2>
                      <hr>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="lista_blanca">Imagen</th>
                                    <th class="lista_blanca">Nombre</th>
                                    <th class="lista_blanca">Categoria</th>
                                    <th class="lista_blanca">Pagado</th>
                                </tr>
                            </thead>
                            <tbody>

                  <?php
                          //Inicia consulta de la puja
                          $iduser = $_SESSION['id_usuario'];
                          $res = $bd->select("SELECT * from subasta where subastador=$iduser and estado=0 order by id_subasta desc");
                          if($res->num_rows > 0){
                            while($row = $res->fetch_assoc()){
                              $sub = $row["id_subasta"];
                              $min = $row["min"];
                              $max = $row["max"];
                              $ini = $row["tiempo_ini"];
                              $fin = $row["tiempo_fin"];
                              $id_producto = $row["id_producto"];

                              //Inicia consulta de las licitaciones de las pujas
                              $res2 = $bd->select("SELECT * from producto where id_producto=$id_producto");
                              if($res2->num_rows > 0){
                                while($row2 = $res2->fetch_assoc()){
                                  $nombre_p = $row2["nombre"];
                                  $imagen_p = $row2["imagen"];
                                  $catego_p = $row2["id_categoria"];

                                  //Inicia consulta de categoria de la licitación
                                  $result = $bd->select("SELECT * from categoria where id_categoria=$catego_p");
                                  $categoria_arr = mysqli_fetch_array($result);
                                  $categoria = $categoria_arr["categoria"];

                                  //Inicia consulta de categoria de la licitación
                                  $result1 = $bd->select("SELECT * from oferta where id_subasta=$sub order by id_oferta desc limit 1");
                                  $oferta = mysqli_fetch_array($result1);
                                  $of_final = $oferta["oferta"];

                                  ?>
                                      <tr>
                                          <td width="180px">
                                            <center>
                                              <a href="<?php echo "subasta.php?id=$sub"; ?>">
                                                <img src="<?php echo "imagenes/productos/$imagen_p";?>" style="height: 80px;">
                                              </a>
                                            </center>
                                          </td>
                                          <td><?php echo "<b class='text-success'>$nombre_p</b>";?></td>
                                          <td><?php echo $categoria;?></td>
                                          <td><?php echo "<b class='text-danger'>$$of_final.00</b>";?></td>
                                      </tr>
                                  <?php
                                }
                              }
                            }
                          }
                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Inicia licitaciones mias que ya fueron vendidas -->
                  <div class="col-lg-6">
                    <div class="table-responsive">
                      <h2 class="lista_blanca">Licitaciones cerradas</h2>
                      <hr>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="lista_blanca">Imagen</th>
                                    <th class="lista_blanca">Nombre</th>
                                    <th class="lista_blanca">Categoria</th>
                                    <th class="lista_blanca">Pagado</th>
                                </tr>
                            </thead>
                            <tbody>
                  <?php

                          //Inicia consulta de las pujas
                          $iduser = $_SESSION['id_usuario'];
                          $res = $bd->select("SELECT * from subasta where subastador=$iduser and estado=1 order by id_subasta desc");
                          if($res->num_rows > 0){
                            while($row = $res->fetch_assoc()){
                              $sub = $row["id_subasta"];
                              $min = $row["min"];
                              $max = $row["max"];
                              $ini = $row["tiempo_ini"];
                              $fin = $row["tiempo_fin"];
                              $id_producto = $row["id_producto"];

                              //Inicia consulta de las licitaciones de la puja
                              $res2 = $bd->select("SELECT * from producto where id_producto=$id_producto");
                              if($res2->num_rows > 0){
                                while($row2 = $res2->fetch_assoc()){
                                  $nombre_p = $row2["nombre"];
                                  $imagen_p = $row2["imagen"];
                                  $catego_p = $row2["id_categoria"];

                                  //Inicia consulta de categoria de las licitaciones
                                  $result = $bd->select("SELECT * from categoria where id_categoria=$catego_p");
                                  $categoria_arr = mysqli_fetch_array($result);
                                  $categoria = $categoria_arr["categoria"];

                                  //Inicia consulta de categoria de la licitación
                                  $result1 = $bd->select("SELECT * from oferta where id_subasta=$sub order by id_oferta desc limit 1");
                                  $oferta = mysqli_fetch_array($result1);
                                  $of_final = $oferta["oferta"];

                                  ?>
                                      <tr>
                                          <td width="180px">
                                            <center>
                                              <a href="<?php echo "subasta.php?id=$sub"; ?>">
                                                <img src="<?php echo "imagenes/productos/$imagen_p";?>" style="height: 80px;">
                                              </a>
                                            </center>
                                          </td>
                                          <td><?php echo "<b class='text-success'>$nombre_p</b>";?></td>
                                          <td><?php echo $categoria;?></td>
                                          <td><?php echo "<b class='text-danger'>$$of_final.00</b>";?></td>
                                      </tr>
                                  <?php
                                }
                              }
                            }
                          }
                      //Termina consulta de las pujas
                  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
