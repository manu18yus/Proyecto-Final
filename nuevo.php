<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manuel Arqués Yus</title>
</head>
<body>
    <div>
        <!-- Pequeño formulario vacio para que administrador ingrese un nuevo usuario -->
        <form action="sp_insertar.php" method="post">
            <table border="1">
                <tr>
                    <td>Ingresar Datos:</td>
                </tr>
                <tr>
                    <td>Nombres:</td>
                    <td><input type="text" name="nombre"></td>
                </tr>
                <tr>
                    <td>Apellidos:</td>
                    <td><input type="text" name="apellido"></td>
                </tr>
                <tr>
                    <td>Usuarios:</td>
                    <td><input type="text" name="usuario"></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="text" name="contrasenia"></td>
                </tr>
                <tr>
                    <td>Contraseña2:</td>
                    <td><input type="text" name="contrasenia2"></td>
                </tr>
                <tr>
                    <td>Dni:</td>
                    <td><input type="text" name="dni"></td>
                </tr>
                <tr>
                    <td>Rol:</td>
                    <td><input type="text" name="rol_id"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Guardar"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>