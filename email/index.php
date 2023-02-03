<?php
session_start();
?>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$token = bin2hex(random_bytes(12));

try {

    $id_usuario = $_SESSION['id_usuario'];
    $correo = $_SESSION['correo'];

    $cnx = mysqli_connect("localhost", "root", "root", "subastas");
    $sql = "UPDATE usuario SET token='$token' WHERE id_usuario = $id_usuario";
    if ($cnx->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $cnx->error;
    }
    $rta = mysqli_query($cnx, $sql);
    
    mysqli_close($cnx);

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'pujasarques@hotmail.com';                     //SMTP username
    $mail->Password   = 'Proyectopujas';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('pujasarques@hotmail.com');
    $mail->addAddress($correo);                                 //se envia un correo al correo que el usuario haya puesto en el registro de usuario

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = utf8_decode('Codigo de verificación PujasArqués');
    $mail->Body    = 'Tu codigo de verificacion es: ' . $token .' ';

    $mail->send();

    echo 'Correo enviado';
    header('location: ../token.php');
} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}

?>