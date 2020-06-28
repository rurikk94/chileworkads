<?php
class Resena{
private $id;
private $trabajador_id;
private $quien_resena_id;
private $texto;
private $fecha;
private $evaluacion;
private $enable;
private $imagenes;

    private function __construct(
        int $trabajador_id = null,
        int $quien_resena_id = null,
        string $texto = null,
        int $evaluacion = null,
        string $imagenes = null
    )
    {

        if(!is_null($trabajador_id))
        $this->setTrabajador_id($trabajador_id);
        if(!is_null($quien_resena_id))
        $this->setQuien_resena_id($quien_resena_id);
        if(!is_null($texto))
        $this->setTexto($texto);
        if(!is_null($evaluacion))
        $this->setEvaluacion($evaluacion);
        if(!is_null($imagenes))
        $this->setImagenes($imagenes);
    }

    public function __toString(): string
    {
        return $this->texto;
    }

    public static function fromArray(array $array): self
    {
        return new self(
            $array["trabajador_id"],
            $array["quien_resena_id"],
            $array["texto"],
            $array["evaluacion"],
            $array["imagenes"]
        );
    }

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

    public function getImagenes(){
        return $this->imagenes;
    }

    public function setImagenes($imagenes){
        $this->imagenes = $imagenes;
    }

    public function toArray(){
        $array=[
            $array["id"] = $this->getId(),
            $array["trabajador_id"] = $this->getTrabajador_id(),
            $array["quien_resena_id"] = $this->getQuien_resena_id(),
            $array["texto"] = $this->getTexto(),
            $array["fecha"] = $this->getFecha(),
            $array["evaluacion"] = $this->getEvaluacion(),
            $array["enable"] = $this->getEnable(),
            $array["imagenes"] = $this->getImagenes()
        ];
        return $array;
    }
    public function insertar(){
        $conn = new Db();
        $query =
        "INSERT INTO `resena` (`trabajador_id`, `quien_resena_id`, `texto`, `evaluacion`,`imagenes`)
        VALUES (?, ?, ?, ?,?)";
        $result = $conn->execSQL($query,
        ["iisis",
            $this->getTrabajador_id(),
            $this->getQuien_resena_id(),
            $this->getTexto(),
            $this->getEvaluacion(),
            $this->getImagenes()
        ],true);
        return $result;
        /* $query =
        "INSERT INTO `resena` (`trabajador_id`, `quien_resena_id`, `texto`, `evaluacion`,`evaluacion`)
        VALUES (
            $this->getTrabajador_id(),
        $this->getQuien_resena_id(),
        `$this->getTexto()`,
        $this->getEvaluacion(),
        `$this->getImagenes()`)";
        return $conn->insertar($query); */
    }
    public function delete(){
        $conn = new Db();
        $query =
        "UPDATE `resena` SET `enable`='".$this->getEnable()."' "
        ."WHERE `id` = ".$this->getId();
        return $conn->update($query);
        //return $result;

    }
}
?>