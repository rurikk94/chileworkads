<?php

global $site_config;
require_once('config.php');  //están las variables del sitio ($site_config)
require_once('constantes.php');  //están las variables del sitio ($site_config)

require_once($site_config['SITE']['base'] . '/class/Db.php');
require_once($site_config['SITE']['base'] . '/class/User.php');


function is_login($r=true){
    comenzar_sesion();
    if(!isset($_SESSION['user'])){  //si no existen datos de sesion
        if($r)  //si activada redirigir
            {
                header("location:".__URL__."login.php");    //redirige
                die();
            }else{
                return false;   //retorna false
            }
     }
     //si existen datos de sesion
     if(revisarEnable($_SESSION["user"]->getCorreo())!=2){  //revisa enable del user, si no es 2 (activo)
            logout(true);  //deslogea con redireccion
        }else{  //si user enable = 2
            return true;
        }
    return true;
}
function revisarEnable($correo)
{
    $user = new User($correo);
    return $user->getEnable();
}
function revisarAdmin($correo)
{
    $user = new User($correo);
    return $user->is_admin();
}
function comenzar_sesion(){
    if(!is_session_started())
        session_start();
}
function login($user,$pass){
    if(!is_null($user)&&!is_null($user)&&is_string($user)&&is_string($pass))
    {
        $user = new User($user);
            if(is_null($user->getId()))
                return false;
            if(!password_verify($pass, $user->getContrasena()))
                return 0;
            if($user->getEnable()!='2')
                return 1;
            comenzar_sesion();
            $_SESSION["user"]=$user;
            return $user;
    }
    return NULL;
}
function logout($r=true){
    comenzar_sesion();

    if(session_destroy()) {
        if($r)
            {header("Location: ".__URL__."login.php");die();}
        else
            return true;
   }
    return false;
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
function is_admin($r=true){
    if(is_login(false)){
        if(!revisarAdmin($_SESSION["user"]->getCorreo())){
            if($r)
                header("Location: ".__URL__."index.php");die();
            return false;
        }
        return true;}
        if($r)
            header("Location: ".__URL__."index.php");die();
        return false;

}
function enviar_email($account=null,$message=null){
    if(is_null($account) OR is_null($message))
        return NULL;
    require("./sendemail.php");
    return send_email($account,$message);
}
function modal($modal=null)
{
    if ($modal && isset($modal["cuerpo"]) && isset($modal["titulo"]))
        require("./modal.php");
}