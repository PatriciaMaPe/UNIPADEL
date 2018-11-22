<?php

require_once(__DIR__."/../core/ValidationException.php");
/**

* @author Victor
*/
class establecerPistas {

	private $idPista;
	private $fecha;
	private $disponibilidad;
	private $horarioIdPista;
	private $hora;

	public function __construct($idPista=NULL,  $fecha=NULL,  $disponibilidad=NULL,
															$horarioIdPista=NULL, $hora=NULL) {
		$this->idPista = $idPista;
		$this->fecha = $fecha;
		$this->disponibilidad = $disponibilidad;
		$this->horarioPista = $horarioIdPista;
		$this->hora = $hora;
	
	}
	
	public function getIdPista() {
		return $this->idPista;
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
	
	public function setPista($pista) {
		$this->idPista = $pista;
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
	
}