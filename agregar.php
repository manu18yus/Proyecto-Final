<?php
//Lo que haremos con esto es meter un usuario en la base de datos mediante sql pasandole los siguientes parametros
    include('baseDatos.php');

    if(isset($_POST['correo'])){
        $correo = $_POST['correo'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $rol_id = $_POST['rol_id'];

//Cuando se le llame a este php hará un insert donde se le pasan los parametros de correo, user, pass y rol y los inserta
//en la base de datos para crear un nuevo usuario

            $query = "INSERT into usuario(correo, user, pass, rol_id) VALUES ('$correo', '$user', '$pass', '$rol_id')";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die('Query fallido');
            }
            echo 'Tarea agregada satisfactoriamente';
    }

?>