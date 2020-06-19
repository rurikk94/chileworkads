<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * Account
 */
class User
{
    private $cod_acc;
    private $cod_user;
    private $txt_acc;   //nombre_user
    private $pass;
    private $cod_off;   //activo?
    private $status;    //estado?

    private $cod_rol;   //Rol  anonimo/adminSistema/ejecutivo/profCertificado/...
    private $cod_usertype;   //UserType paciente/profesional/asistente/institucion/servicio

    function __construct($userName,$password)
    {
        $validar = new Validar();
        $userName = $validar->getValidados($userName);
        $password = $validar->getValidados($password);
        $conn = new Db();
        $query = "SELECT * FROM Account WHERE txt_acc = :txt_acc AND pass = :pass";
        $user = $conn->seleccionar($query, ["txt_acc" => $userName,"pass" => $password]);
        if(sizeof($user)>0)
        {
            $this->cod_acc = $user["cod_acc"];
            $this->cod_user = $user["cod_user"];
            $this->txt_acc = $user["txt_acc"];
            $this->pass = $user["pass"];
            $this->status = $user["status"];
            $this->user_type = $user["user_type"];

            //$this->cod_rol = $user["user_type"];
        }
        return null;
    }

    public function is_admin()
    {
        $admin_cod_rol = 2;
        if ($this->user_type == $admin_cod_rol)
            return true;
        return false;
    }
    public function getCodAcc(){
        return $this->cod_acc;
    }
    public function getTxtAcc(){
        return $this->txt_acc;
    }
    public function getPass(){
        return $this->pass;
    }
}
