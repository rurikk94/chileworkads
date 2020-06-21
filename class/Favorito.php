<?php
include_once("Db.php");
include_once("Validar.php");
/**
 * Favorito
 */
class Favorito
{
    private $id_persona;
	private $id_favorito;

	private $nombres;
	private $foto_file;

    public function getId_persona(){
		return $this->id_persona;
	}

	public function setId_persona($id_persona){
		$this->id_persona = $id_persona;
	}

	public function getId_favorito(){
		return $this->id_favorito;
	}
	public function getFoto(){
		return $this->foto_file;
	}
	public function getNombres(){
		return $this->nombres;
	}

	public function setId_favorito($id_favorito){
		$this->id_favorito = $id_favorito;
	}
	public function insertar(){
        $conn = new Db();
        $this->setId_persona($conn->validar($this->getId_persona()));
        $this->setId_favorito($conn->validar($this->getId_favorito()));
        $add = $conn->insertar("INSERT INTO favorito (id_persona,id_favorito)
        VALUES (".$this->getId_persona().",".$this->getId_favorito().")");
        return $add;

	}
	public function eliminar(){
        $conn = new Db();
        $this->setId_persona($conn->validar($this->getId_persona()));
        $this->setId_favorito($conn->validar($this->getId_favorito()));
		return $conn->update("DELETE FROM favorito WHERE id_persona =".$this->getId_persona()
			." AND id_favorito = ".$this->getId_favorito());
	}
}