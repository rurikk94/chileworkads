<?php
class Resena{
private $id;
private $trabajador_id;
private $quien_resena_id;
private $texto;
private $fecha;
private $evaluacion;
private $enable;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTrabajador_id(){
        return $this->trabajador_id;
    }

    public function setTrabajador_id($trabajador_id){
        $this->trabajador_id = $trabajador_id;
    }

    public function getQuien_resena_id(){
        return $this->quien_resena_id;
    }

    public function setQuien_resena_id($quien_resena_id){
        $this->quien_resena_id = $quien_resena_id;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function setTexto($texto){
        $this->texto = $texto;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getEvaluacion(){
        return $this->evaluacion;
    }

    public function setEvaluacion($evaluacion){
        $this->evaluacion = $evaluacion;
    }

    public function getEnable(){
        return $this->enable;
    }

    public function setEnable($enable){
        $this->enable = $enable;
    }

    public function toArray(){
        $array=[
            $array["id"] = $this->getId(),
            $array["trabajador_id"] = $this->getTrabajador_id(),
            $array["quien_resena_id"] = $this->getQuien_resena_id(),
            $array["texto"] = $this->getTexto(),
            $array["fecha"] = $this->getFecha(),
            $array["evaluacion"] = $this->getEvaluacion(),
            $array["enable"] = $this->getEnable()
        ];
        return $array;
    }
    public function insertar(){
        $conn = new Db();
        $query =
        "INSERT INTO `resena` (`trabajador_id`, `quien_resena_id`, `texto`, `evaluacion`)
        VALUES (?, ?, ?, ?)";
        $result = $conn->execSQL($query,
        ["iisi",
            $this->getTrabajador_id(),
            $this->getQuien_resena_id(),
            $this->getTexto(),
            $this->getEvaluacion()
        ],true);
        return $result;
    }
}
?>