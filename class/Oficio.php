<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * Oficio
 */
class Oficio
{
    private $id;
    private $oficio_nombre;
    private $oficio_icon;
    private $categoria;
    private $enable;
    private $cant;

    //get y set
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getOficio_nombre(){
            return $this->oficio_nombre;
        }

        public function setOficio_nombre($oficio_nombre){
            $this->oficio_nombre = $oficio_nombre;
        }

        public function getOficio_icon(){
            return $this->oficio_icon;
        }

        public function setOficio_icon($oficio_icon){
            $this->oficio_icon = $oficio_icon;
        }

        public function getCategoria(){
            return $this->categoria;
        }

        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        public function getEnable(){
            return $this->enable;
        }

        public function setEnable($enable){
            $this->enable = $enable;
        }
        public function getCant(){
            return $this->cant;
        }
    //
    function insertar(){
        $conn = new Db();
        $this->setOficio_nombre($conn->validar($this->getOficio_nombre()));
        $this->setOficio_icon($conn->validar($this->getOficio_icon()));
        $this->setCategoria($conn->validar($this->getCategoria()));
        $add = $conn->insertar("INSERT INTO oficio
        (oficio_nombre,oficio_icon,categoria)
        VALUES ('".$this->getOficio_nombre()."'
        ,'".$this->getOficio_icon()."'
        ,'".$this->getCategoria()."')");
        if($add)
            $this->setId($add);
        return $add;
    }
    public function actualizar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        $this->setOficio_nombre($conn->validar($this->getOficio_nombre()));
        $this->setOficio_icon($conn->validar($this->getOficio_icon()));
        $this->setCategoria($conn->validar($this->getCategoria()));
        return $conn->update("UPDATE oficio
        SET oficio_nombre = '".$this->getOficio_nombre()."'
        , oficio_icon = '".$this->getOficio_icon()."'
        , categoria = '".$this->getCategoria()."'
         WHERE id=".$this->getId());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE oficio SET enable = '0' WHERE id=".$this->getId());
    }

}