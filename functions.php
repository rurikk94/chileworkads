<?php

global $site_config;
require_once('config.php');  //están las variables del sitio ($site_config)
require_once('constantes.php');  //están las variables del sitio ($site_config)

require_once($site_config['SITE']['base'] . '/class/Db.php');
require_once($site_config['SITE']['base'] . '/class/User.php');


function is_login(){
    comenzar_sesion();
    if(!isset($_SESSION['user'])){
        header("location:".__URL__."login.php");
        die();
     }

     /* if(!login($_SESSION['user']->getCorreo(),$_SESSION['user']->getContrasena())){
        header("location:".__URL__."login.php");
        die();
     } */
}
function comenzar_sesion(){
    if(!is_session_started())
        session_start();
}
function login($user,$pass){
    if(!is_null($user)&&!is_null($user)&&is_string($user)&&is_string($pass))
    {
        $user = new User($user,$pass);
        if(!is_null($user->getId()))
        {
            if(password_verify($pass, $user->getContrasena()))
            {
                comenzar_sesion();
                $_SESSION["user"]=$user;
                return $user;
            }
        }

        else
            return false;
    }
    return NULL;
}
function logout(){
    comenzar_sesion();

    if(session_destroy()) {
        header("Location: ".__URL__."login.php");
   }
}
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
function is_admin(){
    is_login();
}
function enviar_email($account=null,$message=null){
    if(is_null($account) OR is_null($message))
        return FALSE;
    require_once("./vendor/phpmailer/PHPMailerAutoload.php");
    /*Lo primero es añadir al script la clase phpmailer desde la ubicación en que esté*/
    //require '../class.phpmailer.php';

    //Crear una instancia de PHPMailer
    $mail = new PHPMailer();
    //Definir que vamos a usar SMTP
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