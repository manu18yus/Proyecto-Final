<?php

//método que sirve para borrar usuarios mediante el id 

    include('baseDatos.php');

    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $query = "DELETE FROM usuarios WHERE id = $id";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            die('Query fallido');
        }
        echo "Tarea eliminada";
    }

?>