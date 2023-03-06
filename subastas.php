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
        <div id="page-wrapper">
            <div class="container-fluid">

            <div class="row" id="contenedor">
                <div class= "col-6">
                  <h1 class="nombre_pagina">Pujas Arqués</h1>
                  <p class="nombre">Manuel Arqués Yus</p>
                </div>
                <div class="col-6">
                  <img id="logo_medio" class="logo" src="imagenes/logo.png" alt="" width="200">
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <ol class="breadcrumb">
                    <li>
                      <i class="inicio">LICITACIONES EN SUBASTA</i> 
                    </li>
                  </ol>
                </div>
              </div>
              <!--Aqui se mostrara una zona en la que el usuario podrá ver las licitaciones que están disponibles para imprimir-->
              <div id="impresion" class="row">
                <div class="col-lg-12">
                  <ol id="boton_pdf" class="breadcrumb">
                    <li class="text-center">
                      <i class="inicio">LICITACIONES PARA IMPRESIÓN</i>
                      <button id="boton_medio" class="btn mx-auto" onclick="window.location.href='pdf/index.php'">
                        <span class="ver_detalles">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      </button>
                    </li>
                  </ol>
                </div>
              </div>

                <!-- Listado de licitaciones -->
                <div class="row">
                  <?php
                      //Inicia consulta de puja
                      $res = $bd->select("SELECT * from subasta where estado=0 order by id_subasta desc");
                      if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                          $id_subasta = $row["id_subasta"];
                          $min = $row["min"];
                          $max = $row["max"];
                          $ini = $row["tiempo_ini"];
                          $fin = $row["tiempo_fin"];
                          $comprador = $row["comprador"];
                          $id_producto = $row["id_producto"];

                          $datetime_actual = date("Y-m-d H:i:s");
                          $datetime1 = date_create($datetime_actual);
                          $datetime2 = date_create($fin);
                          $interval = $datetime1->diff($datetime2);

                          //Inicia consulta de licitaciones de las pujas
                          $res2 = $bd->select("SELECT * from producto where id_producto=$id_producto");
                          if($res2->num_rows > 0){
                            while($row2 = $res2->fetch_assoc()){
                              $nombre_p = $row2["nombre"];
                              $imagen_p = $row2["imagen"];

                              $res3 = $bd->select("SELECT * from oferta where id_subasta=$id_subasta order by id_oferta desc limit 1");
                              if($res3->num_rows > 0){
                                while($row3 = $res3->fetch_assoc()){
                                  $id_oferta = $row3["id_oferta"];
                                  $oferta = $row3["oferta"];

                                  /*Aqui las licitaciones que tienen una oferta ya*/
                                  ?>
                                    <div class="col-sm-6 col-md-4"  id="contenedor_tarjeta">
                                      <div class="card">
                                        <?php echo "<img src='imagenes/productos/$imagen_p' class='card-img-top' alt='$nombre_p' style='max-height: 25rem;'>";?>
                                        <div class="card-body">
                                          <h5 class="card-title"><?php echo $nombre_p; ?></h5>
                                          <p class="card-text"><?php print $interval->format('%a días %H horas %I minutos'); ?></p>
                                          <p class="card-text"><?php echo "€$min.00 - €$max.00"; ?></p>
                                          <h6 class="card-subtitle mb-2 text-danger">Oferta actual: <?php echo "€$oferta.00"; ?></h6>
                                          <?php echo "<a href='subasta.php?id=$id_subasta' class='btn btn-block' id='boton_medio' role='button'>Mejorar oferta</a>";?>
                                        </div>
                                      </div>
                                    </div>
                                  
                                  <?php
                                  /*Fin de las licitaciones que tienen una oferta */

                                }
                              }else{
                              
                                /*Aqui se mostraran las licitaciones que aun no tienen oferta*/
                                ?>
                                  <div class="col-sm-6 col-md-4" id="contenedor_tarjeta">
                                    <div class="card">
                                      <?php echo "<img src='imagenes/productos/$imagen_p' class='card-img-top' alt='$nombre_p' style='max-height: 25rem;'>";?>
                                      <div class="card-body">
                                        <h5 class="card-title"><?php echo $nombre_p; ?></h5>
                                        <p class="card-text"><?php print $interval->format('%a días %H horas %I minutos'); ?></p>
                                        <p class="card-text"><?php echo "€$min.00 - €$max.00"; ?></p>
                                        <h6 class="card-subtitle mb-2 text-danger">Oferta actual: <b><?php echo "€0.00"; ?></b></h6>
                                        <?php echo "<a href='subasta.php?id=$id_subasta' id='boton' class='btn btn-block' role='button'>Primero en ofertar</a>";?>
                                      </div>
                                    </div>
                                  </div>
                                <?php
                                /*Fin de las licitaciones que no tienen oferta*/
                              }
                            }
                          }else{
                            echo "<h4>Hubo un error al recuperar el producto</h4>";
                          }
                        }
                      }else{
                        echo "<h3 class='lista_blanca'>Por el momento no existen licitaciones</h3>";
                      }
                  ?>

                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
