<?php

//Cuando el rol es igual a uno entonces entramos a admin

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: login.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: login.php');
        }
    }


?>
<?php
	session_start(); //empezamos la sesión
	include("config/database.php"); //incluimos la configuración de la base de datos
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manuel Arqués Yus</title>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
</head>
<body>

<!-- Esta es la zona para crear nuevos productos donde el administrador meterá el producto que quiera -->
<div align="center">
	<h3>Administración de la página</h3>
    </div>
        <h4>Crear nuevo productos</h4>
        <hr>
		<ul id="lista_crear">
			<li>
				<div><img src="imagenes/1.jpg" width="80px"></div>
                <div>Codigo: <input name="codigo" value="" id="create_codigo"/></div>
				<div>Producto: <input type="text" value="" id="create_titulo"/></div>
                <div>Descripición: <input type="text" value="" size="100" id="create_descripcion"/></div>
				<div>Precio : <input type="text" value="" size="6" id="create_precio"> &euro;</div>
				<br>
                <button id="create">Registrar nuevo producto</button>		
			</li>	
		</ul>
    </div>

<!-- Se mostrará un listado de forma dinamica de los productos que hay en la base de datos -->
	</div>
        <h4>Listado de productos</h4>
        <hr>
		<ul id="lista_editar">

		</ul>
        
    </div>


<!-- Esto es un buscador de usuarios -->
    <div>
        <form action="buscar.php" method="post">
            <input type="text" name="buscar">
            <input type="submit" value="Buscar">
            <a href="nuevo.php">Nuevo</a>
        </form>
    </div>


<!-- Aqui mostraremos un listado de los usuarios que hay en la base de datos -->    
    <div>
        <table border="1">
            <tr>
                <td>Id</td>
                <td>Usuario</td>
                <td>Contraseña</td>
                <td>Rol</td>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Contraseña 2</td>
                <td>Dni</td>
                <td>Opciones</td>
            </tr>
            <?php
                $cnx = mysqli_connect("localhost", "root", "root", "blog");
                $sql = "SELECT id, usuario, contrasenia, rol_id, nombre, apellido, contrasenia2, dni FROM usuarios";
                $rta = mysqli_query($cnx, $sql); 
                while($mostrar = mysqli_fetch_row($rta)){
                ?>
                  <tr>
                      <td><?php echo $mostrar['0'] ?></td>
                      <td><?php echo $mostrar['1'] ?></td>
                      <td><?php echo $mostrar['2'] ?></td>
                      <td><?php echo $mostrar['3'] ?></td>  
                      <td><?php echo $mostrar['4'] ?></td>  
                      <td><?php echo $mostrar['5'] ?></td> 
                      <td><?php echo $mostrar['6'] ?></td>
                      <td><?php echo $mostrar['7'] ?></td>  
                      <td>
                          <a href="editar.php?
                          id=<?php echo $mostrar['0'] ?> &
                          usuario=<?php echo $mostrar['1'] ?> &
                          contrasenia=<?php echo $mostrar['2'] ?> &
                          rol_id=<?php echo $mostrar['3'] ?> &
                          nombre=<?php echo $mostrar['4'] ?> &
                          apellido=<?php echo $mostrar['5'] ?> &
                          contrasenia2=<?php echo $mostrar['6'] ?> &
                          dni=<?php echo $mostrar['7'] ?> 
                          ">Editar</a>
                          <a href="sp_eliminar.php? id=<?php echo $mostrar['0'] ?>">Eliminar</a>
                      </td>   
                  </tr>  
                  <?php
                   }
                  ?>
	        <script src="js/javaAdmin.js"></script>
        </table>
    </div>
</body>
</html>