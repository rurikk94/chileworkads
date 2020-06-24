<?php

global $site_config;
require_once('config.php');  //están las variables del sitio ($site_config)
require_once('constantes.php');  //están las variables del sitio ($site_config)

require_once($site_config['SITE']['base'] . '/class/Db.php');
require_once($site_config['SITE']['base'] . '/class/User.php');
require_once($site_config['SITE']['base'] . '/class/Region.php');
require_once($site_config['SITE']['base'] . '/class/Comuna.php');
require_once($site_config['SITE']['base'] . '/class/Oficio.php');
require_once($site_config['SITE']['base'] . '/class/Upload.php');
require_once($site_config['SITE']['base'] . '/class/Red.php');
require_once($site_config['SITE']['base'] . '/class/Ciudad.php');
require_once($site_config['SITE']['base'] . '/class/Poblacion.php');
require_once($site_config['SITE']['base'] . '/class/Contacto.php');
require_once($site_config['SITE']['base'] . '/class/Favorito.php');
require_once($site_config['SITE']['base'] . '/class/OficioPersona.php');
require_once($site_config['SITE']['base'] . '/class/Hijo.php');


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
            return $_SESSION["user"]->getId();
        }
    return  $_SESSION["user"]->getId();
}
/**
 * retorna la url del sitio + el parametro enviado
 */
function site_url($input=null){
    $string = "";
    switch (gettype($input)) {
        case 'string':
            $string = $input;
            break;
        case 'array':
            $string = implode("/", $input);
            break;
        default:
            break;
    }
    return __URL__ . $string;
}
function revisarEnable($correo)
{
    $user = new User();
    $user->create($correo);
    return $user->getEnable();
}
function revisarAdmin($correo)
{
    $user = new User();
    $user->create($correo);
    return $user->is_admin();
}
function comenzar_sesion(){
    if(!is_session_started())
        session_start();
}
function login($user,$pass){
    if(!is_null($user)&&!is_null($user)&&is_string($user)&&is_string($pass))
    {
        $u = new User();
        $u->create($user);
            if(is_null($u->getId()))
                return false;
            if(!password_verify($pass, $u->getContrasena()))
                return 0;
            if($u->getEnable()!='2')
                return 1;
            comenzar_sesion();
            $_SESSION["user"]=$u;
            return $u;
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
                {header("Location: ".__URL__."index.php");die();}
            return false;
        }
        return true;
    }
    if($r)
        {header("Location: ".__URL__."index.php");die();}
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
function regiones($filtro=[]){
    $conn = new Db();
    $query="SELECT *
        FROM region
        WHERE borrado IS NULL";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    {   $flag=1;
        $query.=" AND id_region = ". $conn->validar($filtro["id"]);
    }
    return $conn->seleccionarObject($query,"Region");
}
function comunas($filtro=[]){
    $conn = new Db();
    $query="SELECT id_comuna, id_region, nombre_comuna
        FROM comuna c
        WHERE c.borrado IS NULL";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    {
        $query.=" AND id_comuna = ". $conn->validar($filtro["id"]);
    }
    $query.=" ORDER BY nombre_comuna ASC";
    return $conn->seleccionarObject($query,"Comuna");
}
function oficios($filtro=[]){
    $conn = new Db();
    $query="SELECT id, oficio_nombre, oficio_icon, enable, categoria, cant FROM oficio o
    LEFT JOIN (
    SELECT oficio_id,COUNT(oficio_id) cant FROM persona_oficio
    GROUP BY oficio_id) c
    ON c.oficio_id = o.id
    WHERE ENABLE = '1'";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    {
        $query.=" AND id = ". $conn->validar($filtro["id"]);
    }
    if(isset($filtro["nombre"]) && !is_null($filtro["nombre"]))
    {
        $query.=" AND oficio_nombre = ". $conn->validar($filtro["nombre"]);
    }
    $query.=" ORDER BY oficio_nombre ASC";
    return $conn->seleccionarObject($query,"Oficio");
}
function redesSociales($filtro=[]){
    $conn = new Db();
    $query="SELECT * FROM tipo_contacto
    WHERE ENABLE = '1' AND BORRADO IS NULL";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    {
        $query.=" AND id = ". $conn->validar($filtro["id"]);
    }
    if(isset($filtro["nombre"]) && !is_null($filtro["nombre"]))
    {
        $query.=" AND nombre_red = ". $conn->validar($filtro["nombre"]);
    }
    $query.=" ORDER BY nombre_red ASC";
    return $conn->seleccionarObject($query,"Red");
}
function ciudades($filtro=[]){
    $conn = new Db();   $flag = 0;
    $query="SELECT
    ci.id_ciudad, ci.id_comuna,ci.nombre_ciudad, CONCAT('Region ', LOWER(r.nombre_region)) nombre_region
    FROM ciudad ci
    INNER JOIN comuna co on co.id_comuna = ci.id_comuna
    INNER JOIN region r on r.id_region = co.id_region";
    if (sizeof($filtro)>0)
        $query.=" WHERE ";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    { $flag=1;
        $query.=" id_ciudad = ". $conn->validar($filtro["id"]);
    }
    if(isset($filtro["nombre"]) && !is_null($filtro["nombre"]))
    {   if($flag==1)  $query.=" AND ";
        $query.=" AND nombre_ciudad = ". $conn->validar($filtro["nombre"]);
    }
    $query.=" ORDER BY nombre_ciudad ASC";
    return $conn->seleccionarObject($query,"Ciudad");
}
function poblaciones($filtro=[]){
    $conn = new Db();   $flag = 0;
    $query="SELECT * FROM poblacion po
    INNER JOIN ciudad ci on ci.id_ciudad = po.ciudad_id ";
    if (sizeof($filtro)>0)
        $query.=" WHERE ";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    { $flag=1;
        $query.=" po.id_poblacion = ". $conn->validar($filtro["id"]);
    }
    if(isset($filtro["nombre"]) && !is_null($filtro["nombre"]))
    {   if($flag==1)  $query.=" AND ";
        $query.=" po.nombre_poblacion = ". $conn->validar($filtro["nombre"]);
    }
    if(isset($filtro["ciudad_id"]) && !is_null($filtro["ciudad_id"]))
    {   if($flag==1)  $query.=" AND ";
        $query.=" po.ciudad_id = ". $conn->validar($filtro["ciudad_id"]);
    }
    $query.=" ORDER BY po.nombre_poblacion ASC";
    return $conn->seleccionarObject($query,"Poblacion");
}
function usuarios($filtro=[]){
    $conn = new Db();
    $query="SELECT * FROM persona p
    WHERE p.BORRADO IS NULL";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    {
        $query.=" AND p.id = ". $conn->validar($filtro["id"]);
    }
    if(isset($filtro["nombre"]) && !is_null($filtro["nombre"]))
    {
        $query.=" AND p.nombres = ". $conn->validar($filtro["nombre"]);
    }
    if(isset($filtro["tipo"]) && !is_null($filtro["tipo"]))
    {
        $query.=" AND p.tipo_user = ". $conn->validar($filtro["tipo"]);
    }
    $query.=" ORDER BY p.nombres ASC";
    return $conn->seleccionarObject($query,"User");
}
function tipoUsuario($id)
{
    switch ($id) {
        case 1:
            return 'Usuario Normal';
            break;
        case 2:
            return 'Usuario Trabajador';
            break;
        case 3:
            return 'Admin';
            break;
    }
}
function contactoUsuario($filtro=[]){
    if(!isset($filtro["persona"]) OR is_null($filtro["persona"]))
        return NULL;

    $conn = new Db();
    $query="SELECT pc.id,icono_red,url_red,valor,nombre_red,pc.red_id FROM persona_contacto pc
    INNER JOIN tipo_contacto tc ON tc.id = pc.red_id
    WHERE tc.enable = 1 AND tc.borrado IS NULL AND pc.persona_id = ".$filtro["persona"];
    return $conn->seleccionarObject($query,"Contacto");
}
function favoritos($filtro=[]){
    if(!isset($filtro["user"]) OR is_null($filtro["user"]))
        return NULL;

    $conn = new Db();
    $query="SELECT * FROM favorito f
        INNER JOIN persona p on p.id = f.id_favorito
        WHERE id_persona = ".$filtro["user"];
    if (isset($filtro["persona"]) && !is_null($filtro["persona"]))
        $query.=" AND id_favorito =".$filtro["persona"];
    return $conn->seleccionarObject($query,"Favorito");
}
function oficioPersona($filtro=[]){
    $conn = new Db();
    $query="SELECT po.id,po.persona_id,po.experiencia,po.detalle ,
    o.id oficio_id, o.oficio_nombre ,o.oficio_icon,o.categoria
    FROM persona_oficio po
    INNER JOIN oficio o
    ON o.id = po.oficio_id
    WHERE o.enable = '1'";
    if(isset($filtro["id"]) && !is_null($filtro["id"]))
    {
        $query.=" AND po.id = ". $conn->validar($filtro["id"]);
    }
    if(isset($filtro["persona"]) && !is_null($filtro["persona"]))
    {
        $query.=" AND po.persona_id = ". $conn->validar($filtro["persona"]);
    }
    if(isset($filtro["nombre"]) && !is_null($filtro["nombre"]))
    {
        $query.=" AND o.oficio_nombre = ". $conn->validar($filtro["nombre"]);
    }
    $query.=" ORDER BY o.oficio_nombre ASC";
    return $conn->seleccionarObject($query,"OficioPersona");
}