<?php
  include ("conexion/Conexion.php");
  $bd = new Conexion();
  session_start();
  
  if(!isset($_SESSION["id_usuario"])){
    header("Location: login.php");
  }
  if(!$_GET["id"]){
    header("Location: subastas.php");
  }

  //Si no redirecciona guardamos la variable get en una variable
  $id_sub = $_GET["id"];
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
      if (isset($_POST["ofertar"])) {
        //Si el usuario quiere ofertar por una licitación
        $oferta = $_POST["oferta"];
        $id_user_1 = $_POST["id_user"];
        $id_sub_1 = $_POST["id_sub"];
        $max = $_POST["max"];
        $fecha_hora_actual = date("Y-m-d H:i:s");

//Esto es en caso de que el usuario compre una licitación
          if($oferta == $max){
            $res_1 = $bd->query("INSERT into oferta(oferta, estado, fecha, id_subasta, comprador) values($oferta, 1, '$fecha_hora_actual',$id_sub_1, $id_user_1);");
            if($res_1 == false){
              echo "<script>window.onload = () => {
                  alert('No se ha podido ofertar');
                }</script>";
            }else{
              $res_2 = $bd->query("INSERT into cesta(id_usuario, id_subasta) values($id_user_1,$id_sub_1);");
              if($res_2 == false){
                echo "<script>window.onload = () => {
                  alert('No se pudo agregar la licitación a la cesta');
                }</script>";
              }else{
                $res_2_1 = $bd->query("UPDATE subasta set estado=1, comprador=$id_user_1 where id_subasta=$id_sub_1;");
                if($res_2_1 == false){
                  echo "<script>window.onload = () => {
                    alert('No se pudo actualizar la subasta');
                  }</script>";
                }else{
                  echo "<script>window.onload = () => {
                    alert('¡VENDIDO!');
                  }</script>";
                }
              }
            }
//Esto es en caso de que el usuario puje por una licitación
          }else{
            $res_1 = $bd->query("INSERT into oferta(oferta, estado, fecha, id_subasta, comprador) values($oferta, 0, '$fecha_hora_actual',$id_sub_1, $id_user_1);");
            if($res_1 == false){
              echo "<script>window.onload = () => {
                alert('No se ha podido ofertar');
              }</script>";
            }else{
              $res_2_1 = $bd->query("UPDATE subasta set comprador=$id_user_1 where id_subasta=$id_sub_1;");
              if($res_2_1 == false){
                echo "<script>window.onload = () => {
                  alert('No se pudo actualizar la puja');
                }</script>";
              }else{
                echo "<script>window.onload = () => {
                  alert('Oferta realizada con exito');
                }</script>";
              }
            }
          }
      }elseif(isset($_POST["comprar"])){
        //Si el usuario quiere comprar el producto pagando el maximo de la puja
        $oferta = $_POST["max"];
        $id_user_1 = $_POST["id_user"];
        $id_sub_1 = $_POST["id_sub"];
        $max = $_POST["max"];
        $fecha_hora_actual = date("Y-m-d h:i:s");

          $res_1 = $bd->query("INSERT into oferta(oferta, estado, fecha, id_subasta, comprador) values($oferta, 1, '$fecha_hora_actual',$id_sub_1, $id_user_1);");
          if($res_1 == false){
            echo "<script>window.onload = () => {
              alert('No se ha podido ofertar');
            }</script>";
          }else{
            $res_2 = $bd->query("INSERT into cesta(id_usuario, id_subasta) values($id_user_1,$id_sub_1);");
            if($res_2 == false){
              echo "<script>window.onload = () => {
                alert('No se pudo agregar la licitación a la cesta');
              }</script>";
            }else{
              $res_2_1 = $bd->query("UPDATE subasta set estado=1, comprador=$id_user_1 where id_subasta=$id_sub_1;");
              if($res_2_1 == false){
                echo "<script>window.onload = () => {
                  alert('No se pudo actualizar la subasta');
                }</script>";
              }else{
                echo "<script>window.onload = () => {
                  alert('¡VENDIDO!');
                }</script>";
              }
            }
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
                      <i class="inicio">LICITACIÓN</i> 
                    </li>
                  </ol>
                </div>
              </div>

                <!-- Listado de pujas -->
                <div class="row">
                  <?php
                      //Inicia consulta de pujas
                      $res = $bd->select("SELECT * from subasta where id_subasta=$id_sub");
                      if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                          $min = $row["min"];
                          $max = $row["max"];
                          $ini = $row["tiempo_ini"];
                          $fin = $row["tiempo_fin"];
                          $estado = $row["estado"];
                          $comprador = $row["comprador"];
                          $subastador = $row["subastador"];
                          $id_producto = $row["id_producto"];

                          $datetime_actual = date("Y-m-d H:i:s");
                          $datetime1 = date_create($datetime_actual);
                          $datetime2 = date_create($fin);
                          $interval = $datetime1->diff($datetime2);

                          //Inicia consulta de las licitaciones en las pujas
                          $res2 = $bd->select("SELECT * from producto where id_producto=$id_producto");
                          if($res2->num_rows > 0){
                            while($row2 = $res2->fetch_assoc()){
                              $nombre_p = $row2["nombre"];
                              $imagen_p = $row2["imagen"];
                              $descripcion_p = $row2["descripcion"];
                              $id_categoria = $row2["id_categoria"];

                              //Inicia consulta de categoria de la licitación
                              $result = $bd->select("SELECT * from categoria where id_categoria=$id_categoria");
                              $categoria_arr = mysqli_fetch_array($result);
                              $categoria = $categoria_arr["categoria"];

                              $res_count=$bd->select("SELECT count(*) as total from oferta where id_subasta=$id_sub");
                              $data=mysqli_fetch_array($res_count);
                              $count_ofert = $data['total'];

                              $res3 = $bd->select("SELECT * from oferta where id_subasta=$id_sub order by id_oferta desc limit 1");
                              if($res3->num_rows > 0){
                                while($row3 = $res3->fetch_assoc()){
                                  $id_oferta = $row3["id_oferta"];
                                  $oferta = $row3["oferta"];
                                  $ofertante_comp = $row3["comprador"];

                                  /*Aqui se mostraran las licitaciones que tienen una oferta ya*/
                                  ?>

                      <!--Con esto lo que hacemos es separar el contenido en dos esta es la parte de la imagen-->            
                      <div class="col-sm-6 col-md-6">
                        <div class="card">
                          <?php
                          // Aquí se mostrará la imagen de la licitación en grande
                          echo "<img class='card-img-top' src='imagenes/productos/$imagen_p' alt='$nombre_p' style='max-height: 450px; width: 100%;'>";
                          ?>
                        </div>
                      </div>
                    <!--Se muestra las licitaciones que tienen actualmente una oferta en forma de tarjeta ocupando la otra mitad de la página-->
                      <div class="col-sm-6 col-md-6 text-center">
                        <div class="card">
                          <div class="card-body">
                            <?php
                              if($estado == 1 && $ofertante_comp != null){
                                echo "<h1 class='text-danger'>VENDIDO | SOLD</h1>";
                              }
                            ?>
                            <h2 class="lista_negra"><?php echo $nombre_p; ?></h2>
                            <h4 class="lista_negra"><?php echo $descripcion_p; ?></h4>
                            <p class="lista_negra text-right"><i class="fa fa-tag"></i> <?php echo $categoria; ?></p>
                            <hr>

                            <p>Producto publicado el <?php echo "<b>$ini</b>"; ?></p>
                            <p><?php //print $interval->format('%R %a días %H horas %I minutos'); ?></p>

                            <p id="tiempo"></p>
                            <input type="hidden" id="limite" value="<?php echo $fin; ?>">

                            <p><?php echo "<b>Ofertantes:</b> $count_ofert";?></p>
                            <p><?php echo "<b>Oferta minima:</b> €$min.00"; ?></p>
                            <p><?php echo "<b>Oferta maxima:</b> €$max.00"; ?></p>
                            <h4>Oferta actual: <b class="text-danger"><?php echo "€$oferta.00"; ?></b></h4>

                            <form class="form-inline" action="" method="post">

                              <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_usuario']; ?>">
                              <input type="hidden" name="id_sub" value="<?php echo $id_sub; ?>">
                              <input type="hidden" name="max" value="<?php echo $max; ?>">
                              <input type="hidden" name="fin" value="<?php echo $fin; ?>">

                              <?php
                                if($estado == 1 || $_SESSION["id_usuario"] == $ofertante_comp || $_SESSION["id_usuario"] == $subastador){
                              ?>
                              <div class="form-group">
                                <input type="number" disabled name="oferta" max="<?php echo $max;?>" min="<?php echo $oferta+1;?>" class="form-control" value="<?php echo $oferta+1;?>">
                              </div>

                              <button id="boton_subasta" type="submit" disabled class="btn btn-warning" name="ofertar">Mejorar oferta</button>
                              <button id="boton_subasta" type="submit" disabled class="btn btn-dark" name="comprar">Comprar ahora</button>

                              <?php
                                }elseif($estado == 0){
                              ?>
                              <div class="form-group">
                                <input type="number" name="oferta" max="<?php echo $max;?>" min="<?php echo $oferta+1;?>" class="form-control" value="<?php echo $oferta+1;?>">
                              </div>

                              <button id="boton_subasta" type="submit" class="btn btn-warning" name="ofertar">Mejorar oferta</button>
                              <button id="boton_subasta" type="submit" class="btn btn-dark" name="comprar">Comprar ahora</button>

                              <?php
                                }
                              ?>
                            </form>
                          </div>
                        </div>
                      </div>

                                  <?php
                                  /*Fin de las licitaciones que tienen una oferta ya*/
                                  }
                                  }else{

                                  /*Aqui se mostraran las licitaciones que aun no tienen oferta*/
                                    ?>

                                      <div class="col-sm-6 col-md-6">
                                        <div class="card">
                                          <?php
                                          // Aquí se mostrará la imagen de la licitación en grande
                                          echo "<img class='card-img-top' src='imagenes/productos/$imagen_p' alt='$nombre_p' style='max-height: 450px; width: 100%;'>";
                                          ?>
                                        </div>
                                      </div>

                                      <!--A continuación se muestra la otra mitad de la página en forma de tarjeta las licitaciones que no tienen todavía ninguna oferta-->
                                      <div class="col-sm-6 col-md-6">
                                        <div class="card">
                                          <div class="card-body text-center">
                                            <h2 class="card-title lista_negra"><?php echo $nombre_p; ?></h2>
                                            <h4 class="card-text lista_negra"><?php echo $descripcion_p; ?></h4>
                                            <p class="lista_negra text-right"><i class="fa fa-tag"></i> <?php echo $categoria; ?></p>
                                            <hr>
                                            <p class="card-text">Producto publicado el <?php echo "<b>$ini</b>"; ?></p>
                                            <p class="card-text"><?php //print $interval->format('%R %a días %H horas %I minutos'); ?></p>
                                            <p id="tiempo"></p>
                                            <input type="hidden" id="limite" value="<?php echo $fin; ?>">
                                            <p><?php echo "<b>Oferta mínima:</b> €$min.00"; ?></p>
                                            <p><?php echo "<b>Oferta máxima:</b> €$max.00"; ?></p>
                                            <h4>Oferta actual: <b class="text-danger"><?php echo "€0.00"; ?></b></h4>
                                            <form class="form-inline" action="" method="post">
                                              <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_usuario']; ?>">
                                              <input type="hidden" name="id_sub" value="<?php echo $id_sub; ?>">
                                              <input type="hidden" name="max" value="<?php echo $max; ?>">
                                              <input type="hidden" name="fin" value="<?php echo $fin; ?>">
                                              <?php
                                                if($_SESSION["id_usuario"] == $subastador){
                                              ?>
                                              <div class="form-group">
                                                <input type="number" disabled name="oferta" class="form-control" max="<?php echo $max;?>" min="<?php echo $min;?>" value="<?php echo $min;?>">
                                              </div>
                                              <button id="boton_subasta" type="submit" disabled class="btn btn-warning" name="ofertar">Ofertar ahora</button>
                                              <button id="boton_subasta" type="submit" disabled class="btn btn-dark" name="comprar">Comprar ahora</button>
                                              <?php
                                                }else{
                                              ?>
                                              <div class="form-group">
                                                <input type="number" name="oferta" class="form-control" max="<?php echo $max;?>" min="<?php echo $min;?>" value="<?php echo $min;?>">
                                              </div>
                                              <button id="boton_subasta" type="submit" class="btn btn-warning" name="ofertar">Ofertar ahora</button>
                                              <button id="boton_subasta" type="submit" class="btn btn-dark" name="comprar">Comprar ahora</button>
                                              <?php
                                                }
                                              ?>
                                            </form>
                                          </div>
                                        </div>
                                      </div>

                                <?php
                              }
                            }
                          }else{
                            echo "<h4>Hubo un error al recuperar el producto</h4>";
                          }
                        }
                      }else{
                        echo "<h3>Por el momento no existen licitaciones</h3>";
                      }
                  ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      //Usamos ajax para mostrar al usuario en tiempo real el tiempo que le queda a la licitación
      setInterval("tiempo()",1000);
      function tiempo(){
        $.post("ajax/tiempo_regresivo.php",{tiempo_limite:$("#limite").val()}, function(data){
            $("#tiempo").html(data);
        });
      }
    </script>
</body>
</html>
