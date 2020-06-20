<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * Account
 */
class User
{
    private $id;
    private $nombres;
    private $correo;
    private $contrasena;

    private $tipo_user;
    private $enable;

    function __construct($correo)
    {
        $validar = new Validar();
        $correo = $validar->getValidados($correo);
        $conn = new Db();
        $query = "SELECT * FROM persona WHERE correo = '$correo'";// AND pass = '$password'";
        $user = $conn->seleccionar($query);
        if(!is_null($user) && sizeof($user)>0)
        {
            $user = $user[0];
            $this->id = $user["id"];
            $this->nombres = $user["nombres"];
            $this->correo = $user["correo"];
            $this->contrasena = $user["contrasena"];
            $this->tipo_user = $user["tipo_user"];
            $this->enable = $user["enable"];

        }
        return null;
    }

    public function is_admin()
    {
        $admin_tipo_user = 3;
        if ($this->tipo_user == $admin_tipo_user)
            return true;
        return false;
    }
    public function getId(){
        return $this->id;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function getContrasena(){
        return $this->contrasena;
    }
    public function getEnable(){
        return $this->enable;
    }
}
