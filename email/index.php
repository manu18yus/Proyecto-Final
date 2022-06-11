<?php
session_start();
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\EXCEPTION;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';


$mail = new PHPMailer(true);
$token = bin2hex(random_bytes(12));

try{

    $id = $_SESSION['id'];
    $email = $_SESSION['email'];

    $cnx = mysqli_connect("localhost", "root", "root", "blog");
    $sql = "UPDATE usuarios SET token='$token' WHERE id = $id";
    $rta = mysqli_query($cnx, $sql);
    
    mysqli_close($cnx);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'manu12yus@hotmail.com';
    $mail->Password = 'Bakugan12';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($email);
    $mail->addAddress('manu12yus@hotmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Prueba de venta';
    $mail->Body = 'Tu codigo de verificacion es: ' . $token .' ';
    
    $mail->send();

    echo 'Correo enviado';
    header('location: ../token.php');
} catch(Exception $e){
    echo 'Mensaje ' . $mail->ErrorInfo;
}

?>
