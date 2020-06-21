<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * City
 */
class Ciudad
{
    private $id_ciudad;
    private $comuna_id;
    private $nombre_ciudad;
    private $nombre_comuna;
    private $nombre_region;

    //get y set
        public function getId_ciudad(){
            return $this->id_ciudad;
        }

        public function setId_ciudad($id_ciudad){
            $this->id_ciudad = $id_ciudad;
        }

        public function getComuna_id(){
            return $this->comuna_id;
        }

        public function setComuna_id($comuna_id){
            $this->comuna_id = $comuna_id;
        }

        public function getNombre_ciudad(){
            return $this->nombre_ciudad;
        }

        public function setNombre_ciudad($nombre_ciudad){
            $this->nombre_ciudad = $nombre_ciudad;
        }
        public function getComuna_nombre(){
            return $this->nombre_comuna;
        }
        public function getRegion_nombre(){
            return $this->nombre_region;
        }
    //

    public function insertar(){
        $conn = new Db();
        $this->setNombre_ciudad($conn->validar($this->getNombre_ciudad()));
        $this->setComuna_id($conn->validar($this->getComuna_id()));
        $add = $conn->insertar("INSERT INTO ciudad (comuna_id,nombre_ciudad)
        VALUES (".$this->getComuna_id().",'".$this->getNombre_ciudad()."')");
        if($add)
            $this->setId_ciudad($add);
        return $add;
    }
    public function actualizar(){
        $conn = new Db();
        $this->setId_ciudad($conn->validar($this->getId_ciudad()));
        $this->setNombre_ciudad($conn->validar($this->getNombre_ciudad()));
        $this->setComuna_id($conn->validar($this->getComuna_id()));
        return $conn->update("UPDATE ciudad
        SET nombre_ciudad = '".$this->getNombre_ciudad()."'
            , comuna_id = ".$this->getComuna_id()."
         WHERE id_ciudad =".$this->getId_ciudad());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId_ciudad($conn->validar($this->getId_ciudad()));
        return $conn->update("UPDATE ciudad SET borrado = now() WHERE id_ciudad=".$this->getId_ciudad());
    }

}