<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manuel Arqués Yus</title>
</head>
<body>
<?php
$id=$_GET['id'];
$usuario=$_GET['usuario'];
$contrasenia=$_GET['contrasenia'];
$rol_id=$_GET['rol_id'];
$nombre=$_GET['nombre'];
$apellido=$_GET['apellido'];
$contrasenia2=$_GET['contrasenia2'];
$dni=$_GET['dni'];
?>

<!-- Cuando se pulse en editar sobre un usuario aparecera un pequeño formulario con los datos rellenos de ese usuario
y se deberá de borrar y cambiar lo que queramos  -->
    <div>
        <form action="sp_editar.php" method="post">
            <table border="1">
                <tr>
                    <td>Ingresar Datos:</td>
                    <td><input type="text" name="id" style="visibility:hidden" value="<?=$id?>"></td>
                </tr>
                <tr>
                    <td>Usuario:</td>
                    <td><input type="text" name="usuario" value="<?=$usuario?>"></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="text" name="contrasenia" value="<?=$contrasenia?>"></td>
                </tr>
                <tr>
                    <td>Rol:</td>
                    <td><input type="text" name="rol_id" value="<?=$rol_id?>"></td>
                </tr>
                <tr>
                    <td>Nombre:</td>
                    <td><input type="text" name="nombre" value="<?=$nombre?>"></td>
                </tr>
                <tr>
                    <td>Apellido:</td>
                    <td><input type="text" name="apellido" value="<?=$apellido?>"></td>
                </tr>
                <tr>
                    <td>Contraseña 2:</td>
                    <td><input type="text" name="contrasenia2" value="<?=$contrasenia2?>"></td>
                </tr>
                <tr>
                    <td>DNI:</td>
                    <td><input type="text" name="dni" value="<?=$dni?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Actualizar"></td>
                    <td><a href="admin.php">Cancelar</a></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>