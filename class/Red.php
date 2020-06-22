<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * Region
 */
class Red
{
    private $id;
    private $nombre_red;
    private $url_red;
    private $icono_red;
    private $enable;
    //get y set
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNombre_red(){
            return $this->nombre_red;
        }

        public function setNombre_red($nombre_red){
            $validar = new Validar();
            $this->nombre_red = $validar->getValidados($nombre_red);
        }

        public function getUrl_red(){
            return $this->url_red;
        }

        public function setUrl_red($url_red){
            $validar = new Validar();
            $this->url_red = $validar->getValidados($url_red);
        }

        public function getIcono_red(){
            return $this->icono_red;
        }

        public function setIcono_red($icono_red){
            $validar = new Validar();
            $this->icono_red = $validar->getValidados($icono_red);
        }

        public function getEnable(){
            return $this->enable;
        }

        public function setEnable($enable){
            $this->enable = $enable;
        }
        public function toArray(){
            $array=[
                "id"=> $this->getId(),
                "nombre_red"=> $this->getNombre_red(),
                "url_red"=> $this->getUrl_red(),
                "icono_red"=> $this->getIcono_red()
            ];
            return $array;
        }

    public function insertar(){
        $conn = new Db();
        $this->setNombre_red($conn->validar($this->getNombre_red()));
        $this->setUrl_red($conn->validar($this->getUrl_red()));
        $this->setIcono_red($conn->validar($this->getIcono_red()));
        $add = $conn->insertar("INSERT INTO tipo_contacto
        (nombre_red,url_red,icono_red)
        VALUES (
            '".$this->getNombre_red()."'
        ,'".$this->getUrl_red()."'
        ,'".$this->getIcono_red()."')");
        if($add)
            $this->setId($add);
        return $add;
    }
    public function actualizar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        $this->setNombre_red($conn->validar($this->getNombre_red()));
        $this->setUrl_red($conn->validar($this->getUrl_red()));
        $this->setIcono_red($conn->validar($this->getIcono_red()));
        return $conn->update("UPDATE tipo_contacto
        SET nombre_red = '".$this->getNombre_red()."'
            , url_red = '".$this->getUrl_red()."'
            , icono_red = '".$this->getIcono_red()."'
         WHERE id =".$this->getId());
    }
    public function eliminar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("UPDATE tipo_contacto SET borrado = now() WHERE id=".$this->getId());
    }
}