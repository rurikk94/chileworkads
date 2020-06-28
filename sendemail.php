<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require_once('./config.php');
function send_email($message=null)
{
    global $email_config;
    if(is_null($email_config) OR is_null($message))
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
    $mail->Host       = $email_config["host"];//'smtp.gmail.com'
    $mail->Port       = $email_config["port"];//587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth   = true;
    $mail->CharSet = 'UTF-8';
    $mail->Username   = $email_config["username"];//"videojuegos01vina@gmail.com";
    $mail->Password   = $email_config["password"];//"videojuegos01";
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