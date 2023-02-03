<?php

//Con esto lo que haremos será borrar un usuario en la zona de administrador basandonos en su id

    include('baseDatos.php');

    if(isset($_POST['id_usuario'])){

        $id_usuario = $_POST['id_usuario'];

        $query = "DELETE FROM usuario WHERE id_usuario = $id_usuario";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            die('Query fallido');
        }
        echo "Tarea eliminada";
    }

?>