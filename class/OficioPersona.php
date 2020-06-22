<?php
class OficioPersona{
    private $id;
    private $persona_id;
    private $experiencia;
    private $detalle;

    private $oficio_id;
    private $oficio_nombre;
    private $oficio_icon;
    private $categoria;

//get y set
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPersona_id(){
        return $this->persona_id;
    }

    public function setPersona_id($persona_id){
        $this->persona_id = $persona_id;
    }

    public function getExperiencia(){
        return $this->experiencia;
    }

    public function setExperiencia($experiencia){
        $this->experiencia = $experiencia;
    }

    public function getDetalle(){
        return $this->detalle;
    }

    public function setDetalle($detalle){
        $this->detalle = $detalle;
    }

    public function getOficio_id(){
        return $this->oficio_id;
    }

    public function setOficio_id($oficio_id){
        $this->oficio_id = $oficio_id;
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
}
?>