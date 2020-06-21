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
    private $apellidos;
    private $fecha_nacimiento;
    private $correo;
    private $contrasena;
    private $rut;
    private $foto_file;

    private $tipo_user;
    private $enable;
    private $genero;
    private $id_poblacion;

    function create($correo)
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
    public function setId($id){
        $this->id =$id;
    }
    public function getId(){
        return $this->id;
    }
    public function getNombres(){
        return $this->nombres;
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
    public function getTipoUser(){
        return $this->tipo_user;
    }
    public function setTipoUser($tipo){
        $this->tipo_user = $tipo;
    }
    public function getRut(){
        return $this->rut;
    }
    public function getFoto_file(){
        return $this->foto_file;
    }
    public function getGenero(){
        return $this->genero;
    }
    public function getApellidos(){
        return $this->apellidos;
    }
    public function getFecha_nacimiento(){
        return $this->fecha_nacimiento;
    }
    public function getId_poblacion(){
        return $this->id_poblacion;
    }
    public function habilitar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE persona SET enable ='1' WHERE id=".$this->getId());
    }
    public function deshabilitar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE persona SET enable ='0' WHERE id=".$this->getId());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE persona SET borrado = now() WHERE id=".$this->getId());
    }
    public function cambiarTipoUser($tipo){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        $this->setTipoUser($conn->validar($tipo));
        return $conn->update("UPDATE persona SET tipo_user = '".$this->getTipoUser()."' WHERE id=".$this->getId());
    }
}
