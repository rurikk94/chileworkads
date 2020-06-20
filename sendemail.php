<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
function send_email($account=null,$message=null)
{
    if(is_null($account) OR is_null($message))
        return NULL;

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    $mail->IsSMTP();
    $mail->isHTML(true);
    //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
    // 0 = off (producción)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug  = 0;
    $mail->Host       = $account["host"];//'smtp.gmail.com'
    $mail->Port       = $account["port"];//587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true;
    $mail->CharSet = 'UTF-8';
    $mail->Username   = $account["username"];//"videojuegos01vina@gmail.com";
    $mail->Password   = $account["password"];//"videojuegos01";
    $mail->SetFrom($message["byEmail"], $message["byName"]);//'ChileWorkAds@gmail.com','ChileWorkAds'
    $mail->AddAddress($message["forEmail"],$message["forName"]);
    $mail->Subject = $message["Titulo"];//'ChileWorkAds Bienvenido!';
    $mail->Body = $message["Body"];//'Gracias por registrarse, su nombre es '.$nombre;
    if(!$mail->Send()) {
        //echo "Error: " . $mail->ErrorInfo;
        return FALSE;
    } else {
        //echo "Enviado!";
        return TRUE;
    }
}