<?php
class Contacto{
    private $icono_red;
    private $url_red;
    private $valor;
    private $nombre_red;

    public function getIcono_red(){
		return $this->icono_red;
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
}
?>