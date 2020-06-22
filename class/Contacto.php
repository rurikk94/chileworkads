<?php
class Contacto{
    private $id;
    private $id_persona;
    private $red_id;
    private $icono_red;
    private $url_red;
    private $valor;
    private $nombre_red;

    public function getIcono_red(){
		return $this->icono_red;
	}
    public function setId($id){
		$this->id=$id;
	}
    public function getId(){
		return $this->id;
	}

	public function setIcono_red($icono_red){
		$this->icono_red = $icono_red;
	}

	public function getUrl_red(){
		return $this->url_red;
	}

	public function setUrl_red($url_red){
		$this->url_red = $url_red;
	}

	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function getNombre_red(){
		return $this->nombre_red;
	}

	public function setNombre_red($nombre_red){
		$this->nombre_red = $nombre_red;
	}
	public function setId_persona($persona){
		$this->id_persona = $persona;
	}
	public function getId_persona(){
		return $this->id_persona;
	}
	public function setRed_id($red){
		$this->red_id = $red;
	}
	public function getRed_id(){
		return $this->red_id;
	}
	public function insertar(){
		$conn = new Db();
		try {
			$this->setId_persona($conn->validar($this->getId_persona()));
			$this->setRed_id($conn->validar($this->getRed_id()));
			$this->setValor($conn->validar($this->getValor()));

			$add = $conn->insertar("INSERT INTO persona_contacto (persona_id,red_id,valor)
			VALUES (".$this->getId_persona().",".$this->getRed_id().",'".$this->getValor()."')");
			if($add)
				$this->setId($add);
			return $add;
		} catch (\Throwable $th) {
			return false;
		}
	}
    public function eliminar(){
        $conn = new Db();
        $this->setId($conn->validar($this->getId()));
        return $conn->update("DELETE FROM persona_contacto WHERE id=".$this->getId());
    }
}
?>