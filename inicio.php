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
                <a class="navbar-brand" href="inicio.php">
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
                                <i class="inicio">INICIO</i> 
                            </li>
                        </ol>
                    </div>
                </div>

                <?php
                  //Se hacen las cuentas que se mostraran en la pantalla principal
                  //Count para las licitaciones que están disponibles
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=0");
                  $data=mysqli_fetch_array($res_count);
                  $count_sub = $data['total'];//En esta variable se guardan el total

                  //Count para licitaciones en mi cesta
                  $res_count=$bd->select("SELECT count(*) as total from cesta where id_usuario=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_cesta = $data['total'];//En esta variable se guardan el total

                  //Count para las licitaciones propias activas
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=0 and subastador=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_sub_act = $data['total'];//En esta variable se guardan el total

                  //Count para las licitaciones propias cerradas
                  $res_count=$bd->select("SELECT count(*) as total from subasta where estado=1 and subastador=".$_SESSION["id_usuario"]);
                  $data=mysqli_fetch_array($res_count);
                  $count_sub_cerr = $data['total'];//En esta variable se guardan el total
                ?>


<div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="panel">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-th-list fa-5x"></i>
              </div>
              <div class="col-xs-9 texto_centrado">
                <div class="huge"><?php echo $count_sub;//Aqui se imprime el total?></div>
                <div>LICITACIONES EN SUBASTA</div>
              </div>
            </div>
          </div>
          <a href="subastas.php">
          <div class="panel-footer">
            <span class="ver_detalles">Ver detalles</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
          </a>
        </div>
      </div>
                     
      <div class="col-lg-4 col-md-6">
        <div class="panel">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-lock fa-5x"></i>
              </div>
              <div class="col-xs-9 texto_centrado">
                <div class="huge"><?php echo $count_sub_cerr;//Aqui se imprime el total?></div>
                <div>LICITACIONES SUBASTADAS</div>
              </div>
            </div>
          </div>
          <a href="cuenta.php">
            <div class="panel-footer">
              <span class="ver_detalles">Ver detalles</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6">
        <div class="panel">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-shopping-cart fa-5x"></i>
              </div>
              <div class="col-xs-9 texto_centrado">
                <div class="huge"><?php echo $count_cesta;//Aqui se imprime el total?></div>
                <div>CESTA</div>
              </div>
            </div>
          </div>
          <a href="cesta.php">
          <div class="panel-footer">
            <span class="ver_detalles">Ver detalles</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
          </a>
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
