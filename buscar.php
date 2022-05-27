<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manuel Arqués Yus</title>
</head>
<body>

<!-- Con este php lo que haremos será buscar a los usuarios con un nombre y apellido determinados y 
enseñarlos al administrador en forma de tabla -->
    <?php
    $buscar = $_POST['buscar'];
    ?>

    <div>
        <form action="buscar.php" method="post">
            <input type="text" name="buscar">
            <input type="submit" value="Buscar">
            <a href="nuevo.php">Nuevo</a>
        </form>
    </div>

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
                <td>DNI</td>
                <td>Opciones</td>
            </tr>
            <?php
                $cnx = mysqli_connect("localhost", "root", "root", "blog");
                $sql = "SELECT id, usuario, contrasenia, rol_id, nombre, apellido, contrasenia2, dni FROM usuarios WHERE nombre LIKE '$buscar' '%' OR apellido LIKE '$buscar' '%' ";
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
        </table>
    </div>
</body>
</html>
