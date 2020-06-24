<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * Region
 */
class Region
{
    private $id_region;
    private $nombre_region;

    public function getId(){
        return $this->id_region;
    }
    public function getNombreRegion(){
        return $this->nombre_region;
    }
    public function setId($id){
        $this->id_region = $id;
    }
    public function setNombreRegion($nombre){
        $validar = new Validar();
        $nombre = $validar->getValidados($nombre);
        $this->nombre_region = $nombre;
    }
    public function getRegion($id_region){
        $conn = new Db();
        $r = $conn->seleccionarObject("SELECT * FROM region WHERE id_region=".$conn->validar($id_region)." AND borrado IS NULL","Region");
        if (sizeof($r)==1){
            $this->setIdRegion($r[0]->getIdRegion());
            $this->setNombreRegion($r[0]->getNombreRegion());
        }
    }
    public function insertar(){
        $conn = new Db();
        $this->setNombreRegion($conn->validar($this->getNombreRegion()));
        $add = $conn->insertar("INSERT INTO region (nombre_region) VALUES ('".$this->getNombreRegion()."')");
        if($add)
            $this->setId($add);
        return $add;
    }
    public function actualizar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        $this->setNombreRegion($conn->validar($this->getNombreRegion()));
        return $conn->update("UPDATE region SET nombre_region = '".$this->getNombreRegion()."' WHERE id_region =".$this->getId());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE region SET borrado = now() WHERE id_region =".$this->getId());
    }
}