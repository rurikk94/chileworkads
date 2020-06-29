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
    private $bio;
    private $file_cv;

    private $admin;
    private $tipo_user;
    private $enable;
    private $genero;
    private $id_poblacion;

    public $count;
    public $avg;

    public $id_ciudad;
    public $id_comuna;
    public $id_region;

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
            $this->bio = $user["bio"];
            $this->file_cv = $user["file_cv"];
            $this->id = $user["id"];
            $this->nombres = $user["nombres"];
            $this->correo = $user["correo"];
            $this->contrasena = $user["contrasena"];
            $this->tipo_user = $user["tipo_user"];
            $this->enable = $user["enable"];
            $this->admin = $user["admin"];

        }
        return null;
    }

    public function is_admin()
    {
        if ($this->admin)
            return true;
        return false;
    }
    public function setId($id){
        $this->id =$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setCV($file_cv){
        $this->file_cv =$file_cv;
    }
    public function getCV(){
        return $this->file_cv;
    }
    public function setBio($bio){
        $this->bio =$bio;
    }
    public function getBio(){
        return $this->bio;
    }
    public function getNombres(){
        return $this->nombres;
    }
    public function setNombres($nombres){
        $this->nombres = $nombres;
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
    public function setRut($rut){
        $this->rut = $rut;
    }
    public function getFoto_file(){
        return $this->foto_file;
    }
    public function setAdmin($admin){
        return $this->admin = $admin;
    }
    public function getAdmin(){
        return $this->admin;
    }
    public function setFoto_file($foto){
        $this->foto_file = $foto;
    }
    public function getGenero(){
        return $this->genero;
    }
    public function setGenero($genero){
        $this->genero = $genero;
    }
    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }
    public function getApellidos(){
        return $this->apellidos;
    }
    public function getFecha_nacimiento(){
        /* if(is_null($this->fecha_nacimiento))
            return ''; */
        return $this->fecha_nacimiento;
    }
    public function setFecha_nacimiento($fecha_nacimiento){
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function setCorreo($correo){
        $this->correo = $correo;
    }
    public function getId_poblacion(){
        return $this->id_poblacion;
    }
    public function setId_poblacion($id_poblacion){
        $this->id_poblacion = $id_poblacion;
    }
    public function actualizarFoto(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        $this->setFoto_file($conn->validar($this->getFoto_file()));
        return $conn->update("UPDATE persona SET foto_file ='".$this->getFoto_file()."'
         WHERE id=".$this->getId());
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
    public function cambiarAdmin($tipo){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        $this->setTipoUser($conn->validar($tipo));
        return $conn->update("UPDATE persona SET admin = '".$this->getTipoUser()."' WHERE id=".$this->getId());
    }
    public function actualizarCV(){
        $conn = new Db();
        $this->setCV($this->getCV());
        $this->setId($conn->validar($this->getId()));
        if(!is_null($this->getCV()))
            return $conn->update("UPDATE persona SET file_cv = '".$this->getCV()."' WHERE id=".$this->getId());
        else
            return $conn->update("UPDATE persona SET file_cv = NULL WHERE id=".$this->getId());
    }
    public function getCalificacion(){
        $conn = new Db();
        $query = "SELECT AVG(evaluacion) nota FROM resena WHERE trabajador_id = ".$this->getId()." AND enable = '1'";
        $evaluacion = $conn->seleccionar($query)[0]["nota"];
        return $evaluacion;
    }
    public function actualizar(){
        $conn = new Db();
        //execSQL("INSERT INTO table(id, name) VALUES (?,?)", array('ss', $id, $name), true);
        $result = $conn->execSQL("UPDATE persona SET
            bio = ?,
            rut = ?,
            nombres = ?,
            genero = ?,
            apellidos = ?,
            fecha_nacimiento = ?,
            tipo_user = ?,
            id_poblacion = ?
            WHERE id = ?",
            [
                "ssssssiii",
                $this->getBio(),
                $this->getRut(),
                $this->getNombres(),
                $this->getGenero(),
                $this->getApellidos(),
                $this->getFecha_nacimiento(),
                $this->getTipoUser(),
                $this->getId_poblacion(),
                $this->getId()
            ],
            True);
            return $result;

        /* return $conn->update("UPDATE persona SET
            rut = '".$this->getRut()."' ,
            nombres = '".$this->getNombres()."' ,
            genero = '".$this->getGenero()."' ,
            apellidos = '".$this->getApellidos()."' ,
            fecha_nacimiento = '".$conn->validar($this->getFecha_nacimiento())."' ,
            tipo_user = '".$this->getTipoUser()."' ,
            id_poblacion = '".$this->getId_poblacion()."'
            WHERE id=".$this->getId()); */

    }
}
