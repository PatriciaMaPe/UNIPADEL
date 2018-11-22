<?php

require_once(__DIR__."/../core/ValidationException.php");
/**
* @author Victor
*/

class GestionarReservas {

	
	private $fecha;
	private $disponibilidad;
	private $horarioIdPista;
	private $hora;

	public function __construct($fecha=NULL,  $disponibilidad=NULL,
												$horarioIdPista=NULL, $hora=NULL) {
	
		$this->fecha = $fecha;
		$this->disponibilidad = $disponibilidad;
		$this->horarioIdPista = $horarioIdPista;
		$this->hora = $hora;
	
	}

	public function getFecha() {
		return $this->fecha;
	}
	
	public function getDisponibilidad() {
		return $this->disponibilidad;
	}
	
	public function getHorarioIdPista() {
		return $this->horarioPista;
	}
	public function getHora() {
		return $this->hora;
	}
	

	public function setFecha($fech) {
		$this->fecha = $fech;
	}
	public function setDisponibilidad($disp) {
		$this->disponibilidad = $disp;
	}
	public function setHorarioIdPista($horarioPist) {
		$this->horarioPista = $horarioPist;
	}
	public function setHora($hora) {
		$this->hora = $hora;
	}
	
	public function checkIsValidForCreate() {
		$errors = array();
		if (strlen(trim($this->title)) == 0 ) {
			$errors["title"] = "title is mandatory";
		}
		if (strlen(trim($this->content)) == 0 ) {
			$errors["content"] = "content is mandatory";
		}
		if ($this->author == NULL ) {
			$errors["author"] = "author is mandatory";
		}
		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "post is not valid");
		}
	}

	public function checkIsValidForUpdate() {
		$errors = array();
		if (!isset($this->id)) {
			$errors["id"] = "id is mandatory";
		}
		try{
			$this->checkIsValidForCreate();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "post is not valid");
		}
	}
}