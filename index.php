<?php
    session_start();
    include ("config/database.php");
?>
<?php

session_start();

if(!isset($_SESSION['rol'])){
    header('location: login.php');
}else{
    if($_SESSION['rol'] != 3){
        header('location: login.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manuel Arqués Yus</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
</head>
<body>

  <!-- NAVBAR -->
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
         <a class="navbar-brand" href="carrito.php" title="ver carrito de compras">
          <img src="imagenes/carrito.png" alt="" width="30" >
          </a>
           <li class="nav-item"><a class="nav-link" href="index.php">Principal</a></li>
           <li class="nav-item"><a class="nav-link" href="registro.php">Registro</a></li>
           <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
           <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
         </ul>
       </div>
     </div>
   </nav>

  <!-- CARRUSEL DE IMAGENES -->

  <div class="carousel slide" id="mainSlider" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="imagenes/zapas dior.jpg" alt="" class="d-block w-100 ">
      </div>
      <div class="carousel-item">
        <img src="imagenes/yeezy 700.jpg" alt="" class="d-block w-100 ">
      </div>
      <div class="carousel-item">
        <img src="imagenes/jordan travis scott.jpg" alt="" class="d-block w-100 ">
      </div>
    </div>
  </div>


<!-- Se muestra el main de una forma dinamica de los productos que hay almacenados en la base de datos-->
<main>
  <div class="container-fluid ">
      <ul class="products-wrp" id="products-wrp">

      </ul>
  </div>
 
</main>


<!-- Footer-->
<footer class="text-center text-lg-start bg-light text-muted p-1">
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>ZapasArqués</h6>
          <p>
           El objetivo de la tienda es la venta de zapatillas raras o exclusivas
          </p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Productos Estrellas
          </h6>
          <p>
            <a href="#!" class="text-reset">Angular</a>
          </p>
          <p>
            <a href="#!" class="text-reset">React</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Vue</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Laravel</a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Accesos Rapidos
          </h6>
          <p>
            <a href="index.php" class="text-reset">Principal</a>
          </p>
          <p>
            <a href="registro.php" class="text-reset">Registro</a>
          </p>
          <p>
            <a href="login.php" class="text-reset">Iniciar Sesión</a>
          </p>
          <p>
            <a href="contacto.php" class="text-reset">Contacto</a>
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Contacto
          </h6>
          <p><i class="fas fa-home me-3"></i> Calle Gurugú Nº2, Melilla</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            zapasarques@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> +34 611464520</p>
        </div>
      </div>
    </div>
  </section>
</footer>
 

  <script type="text/javascript" src="js/javaIndex.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
