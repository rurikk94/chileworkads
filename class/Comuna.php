<?php
include_once("Db.php");
include_once("Validar.php");
include_once("Hijo.php");
/**
 * Region
 */
class Comuna extends Hijo
{
    private $id_comuna;
    private $id_region;
    private $nombre_comuna;
    //private $nombre_region;
    //public $Region;

    public function getId(){
        return $this->id_comuna;
    }
    public function getRegionId(){
        return $this->id_region;
    }
    public function getNombreComuna(){
        return $this->nombre_comuna;
    }
    /* public function getRegionNombre(){
        return $this->nombre_region;
    } */
    public function getComuna($id_comuna){
        $conn = new Db();
        $c = $conn->seleccionarObject("SELECT * FROM comuna WHERE id_comuna=".$conn->validar($id_comuna)." AND borrado IS NULL","Comuna");
        if (sizeof($c)==1){
            $this->setId($c[0]->getId());
            $this->setNombreComuna($c[0]->getNombreComuna());
            $this->setRegionId($c[0]->getRegionId());
        }
    }
    public function setId($id){
        $this->id_comuna = $id;
    }
    public function setRegionId($id){
        $this->id_region = $id;
    }
    public function setNombreComuna($nombre){
        $validar = new Validar();
        $nombre = $validar->getValidados($nombre);
        $this->nombre_comuna = $nombre;
    }
    public function toArray(){
        $array=[
            "id_comuna"=>$this->getId(),
            "id_region"=>$this->getRegionId(),
            "nombre_comuna"=>$this->getNombreComuna()
        ];
        return $array;
    }
    public function insertar(){
        $conn = new Db();
        $this->setNombreComuna($conn->validar($this->getNombreComuna()));
        $add = $conn->insertar("INSERT INTO comuna (id_region,nombre_comuna)
        VALUES (".$this->getRegionId().",'".$this->getNombreComuna()."')");
        if($add)
            $this->setId($add);
        return $add;
    }
    public function actualizar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        $this->setNombreComuna($conn->validar($this->getNombreComuna()));
        $this->setRegionId($conn->validar($this->getRegionId()));
        return $conn->update("UPDATE comuna
        SET nombre_comuna = '".$this->getNombreComuna()."'
            , id_region = ".$this->getRegionId()."
         WHERE id_comuna =".$this->getId());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE comuna SET borrado = now() WHERE id_comuna=".$this->getId());
    }
}