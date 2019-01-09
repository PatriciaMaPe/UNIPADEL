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
		return $this->horarioIdPista;
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
	

}