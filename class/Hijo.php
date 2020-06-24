<?php
class Hijo{
    public $p;
    public function setPadre($e){
        $this->p = $e;
    }
    /**
     * agrega el padre a la propiedad $p de la clase Hijo,
     * segun elemento encontrado en los datos enviado
     */
    public function sP($array,$id_r){
        foreach ($array as $e) {
            if($e->getId()==$id_r){
                $this->setPadre($e);
                return $e;
            }
        }
    }
}
?>