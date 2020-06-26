<?php
include_once("Db.php");
include_once("Validar.php");
include_once("Comuna.php");
/**
 * City
 */
class Ciudad extends Hijo
{
    private $id_ciudad;
    private $id_comuna;
    private $nombre_ciudad;

    public $nombre_region;

    //get y set
    public function toArray(){
        $array=[
            "id_ciudad"=>$this->getId(),
            "id_comuna"=>$this->getComuna_id(),
            "nombre_ciudad"=>$this->getNombre_ciudad()
        ];
        return $array;
    }
        public function getId(){
            return $this->id_ciudad;
        }

        public function setId_ciudad($id_ciudad){
            $this->id_ciudad = $id_ciudad;
        }

        public function getComuna_id(){
            return $this->id_comuna;
        }

        public function setComuna_id($comuna_id){
            $this->id_comuna = $comuna_id;
        }

        public function getNombre_ciudad(){
            return $this->nombre_ciudad;
        }

        public function setNombre_ciudad($nombre_ciudad){
            $this->nombre_ciudad = $nombre_ciudad;
        }
    //

    public function getCiudad($id_ciudad){
        $conn = new Db();
        $c = $conn->seleccionarObject("SELECT * FROM ciudad WHERE id_ciudad=".$conn->validar($id_ciudad)." AND borrado IS NULL","Ciudad");
        if (sizeof($c)==1){
            $this->setId_ciudad($c[0]->getId_ciudad());
            $this->setNombre_ciudad($c[0]->getNombre_ciudad());
            $this->setComuna_id($c[0]->getComuna_id());
        }
    }
    public function insertar(){
        $conn = new Db();
        $this->setNombre_ciudad($conn->validar($this->getNombre_ciudad()));
        $this->setComuna_id($conn->validar($this->getComuna_id()));
        $add = $conn->insertar("INSERT INTO ciudad (id_comuna,nombre_ciudad)
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
            , id_comuna = ".$this->getComuna_id()."
         WHERE id_ciudad =".$this->getId_ciudad());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId_ciudad($conn->validar($this->getId_ciudad()));
        return $conn->update("UPDATE ciudad SET borrado = now() WHERE id_ciudad=".$this->getId_ciudad());
    }

}