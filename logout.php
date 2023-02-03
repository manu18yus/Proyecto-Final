<?php
//Cerramos la sesión del usuario

    session_start();
    session_destroy();
    header("Location: login.php");
?>
