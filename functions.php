<?php

global $site_config;
require_once('config.php');  //están las variables del sitio ($site_config)
require_once('constantes.php');  //están las variables del sitio ($site_config)


function is_login(){
    comenzar_sesion();
    if(!isset($_SESSION['user'])){
        header("location:".__URL__."login.php");
        die();
     }

     if(!login($_SESSION['user']->getTxtAcc(),$_SESSION['user']->getPass())){
        header("location:".__URL__."login.php");
        die();
     }
}
function comenzar_sesion(){
    if(!is_session_started())
        session_start();
}
function login($user,$pass){
    if(!is_null($user)&&!is_null($user)&&is_string($user)&&is_string($pass))
    {
        $user = new User($user,$pass);
        if(!is_null($user->getCodAcc()))
        {
            comenzar_sesion();
            $_SESSION["user"]=$user;
            return $user;
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