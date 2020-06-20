<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * Region
 */
class Comuna
{
    private $id_comuna;
    private $region_id;
    private $nombre_comuna;
    private $nombre_region;

    public function getId(){
        return $this->id_comuna;
    }
    public function getRegionId(){
        return $this->region_id;
    }
    public function getNombreComuna(){
        return $this->nombre_comuna;
    }
    public function getRegionNombre(){
        return $this->nombre_region;
    }
    public function setId($id){
        $this->id_comuna = $id;
    }
    public function setRegionId($id){
        $this->region_id = $id;
    }
    public function setNombreComuna($nombre){
        $validar = new Validar();
        $nombre = $validar->getValidados($nombre);
        $this->nombre_comuna = $nombre;
    }
    public function insertar(){
        $conn = new Db();
        $this->setNombreComuna($conn->validar($this->getNombreComuna()));
        $add = $conn->insertar("INSERT INTO comuna (region_id,nombre_comuna)
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
            , region_id = ".$this->getRegionId()."
         WHERE id_comuna =".$this->getId());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE comuna SET borrado = now() WHERE id_comuna=".$this->getId());
    }
}