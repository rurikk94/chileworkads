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

    function __construct($correo,$password)
    {
        $validar = new Validar();
        $correo = $validar->getValidados($correo);
        $password = $validar->getValidados($password);
        $conn = new Db();
        $query = "SELECT * FROM persona WHERE correo = '$correo'";// AND pass = '$password'";
        $user = $conn->seleccionar($query, [$correo,$password]);
        if(sizeof($user)>0)
        {
            $user = $user[0];
            $this->id = $user["id"];
            $this->nombres = $user["nombres"];
            $this->correo = $user["correo"];
            $this->contrasena = $user["contrasena"];
            $this->tipo_user = $user["tipo_user"];

        }
        return null;
    }

    public function is_admin()
    {
        $admin_tipo_user = 2;
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
}
