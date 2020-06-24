<?php
include_once("Db.php");
include_once("Validar.php");
include_once("Ciudad.php");
/**
 * Poblacion
 */
class Poblacion extends Ciudad
{
    private $id_poblacion;
    private $ciudad_id;
    private $nombre_poblacion;
    public $nombre_ciudad;

    //set y get
        public function getId(){
            return $this->id_poblacion;
        }

        public function setId_poblacion($id_poblacion){
            $this->id_poblacion = $id_poblacion;
        }

        public function getCiudad_id(){
            return $this->ciudad_id;
        }

        public function setCiudad_id($ciudad_id){
            $this->ciudad_id = $ciudad_id;
        }

        public function getNombre_poblacion(){
            return $this->nombre_poblacion;
        }

        public function setNombre_poblacion($nombre_poblacion){
            $this->nombre_poblacion = $nombre_poblacion;
        }
        public function getCiudad_nombre(){
            return $this->nombre_ciudad;
        }
    //
    public function insertar(){
        $conn = new Db();
        $this->setNombre_poblacion($conn->validar($this->getNombre_poblacion()));
        $this->setCiudad_id($conn->validar($this->getCiudad_id()));
        $add = $conn->insertar("INSERT INTO poblacion (ciudad_id,nombre_poblacion)
        VALUES (".$this->getCiudad_id().",'".$this->getNombre_poblacion()."')");
        if($add)
            $this->setId_poblacion($add);
        return $add;
    }
    public function actualizar(){
        $conn = new Db();
        $this->setId_poblacion($conn->validar($this->getId_poblacion()));
        $this->setNombre_poblacion($conn->validar($this->getNombre_poblacion()));
        $this->setCiudad_id($conn->validar($this->getCiudad_id()));
        return $conn->update("UPDATE poblacion
        SET nombre_poblacion = '".$this->getNombre_poblacion()."'
            , ciudad_id = '".$this->getCiudad_id()."'
         WHERE id_poblacion =".$this->getId_poblacion());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId_poblacion($conn->validar($this->getId_poblacion()));
        return $conn->update("UPDATE poblacion SET borrado = now() WHERE id_poblacion=".$this->getId_poblacion());
    }
}