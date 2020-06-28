<?php
class Reporte{
    private $id;
    private $resena_id;
    private $perfil_resena;
    private $quien_reporta;
    private $quien_resena;
    private $fecha;
    private $revisado;
    private $motivo;
    //GET Y GET
        public function getMotivo(){
            return $this->motivo;
        }

        public function setMotivo($motivo){
            $this->motivo = $motivo;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getResena_id(){
            return $this->resena_id;
        }

        public function setResena_id($resena_id){
            $this->resena_id = $resena_id;
        }
        public function getQuien_resena(){
            return $this->quien_resena;
        }

        public function setQuien_resena($quien_resena){
            $this->quien_resena = $quien_resena;
        }

        public function getPerfil_resena(){
            return $this->perfil_resena;
        }

        public function setPerfil_resena($perfil_resena){
            $this->perfil_resena = $perfil_resena;
        }

        public function getQuien_reporta(){
            return $this->quien_reporta;
        }

        public function setQuien_reporta($quien_reporta){
            $this->quien_reporta = $quien_reporta;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function setFecha($fecha){
            $this->fecha = $fecha;
        }

        public function getRevisado(){
            return $this->revisado;
        }

        public function setRevisado($revisado){
            $this->revisado = $revisado;
        }
        public function actualizar(){
            $conn=new Db();
            return $conn->execSQL("UPDATE reporte SET revisado = ?
            WHERE id = ?;",["si",$this->getRevisado(),$this->getId()],TRUE);
        }
        public function insertar(){
            $conn=new Db();
            return $conn->execSQL("INSERT INTO reporte
            (resena_id,perfil_resena,quien_reporta,quien_resena,motivo)
            VALUES
            (?,?,?,?,?);",
            ["iiiis",
            $this->getResena_id(),
            $this->getPerfil_resena(),
            $this->getQuien_reporta(),
            $this->getQuien_resena(),
            $this->getMotivo()],
            TRUE);
        }
}

?>