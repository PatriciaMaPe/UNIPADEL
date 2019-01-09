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
	private $numInscritos;

	public function __construct($fecha=NULL,  $disponibilidad=NULL,
												$horarioIdPista=NULL, $hora=NULL,$numInscritos=NULL) {
	
		$this->fecha = $fecha;
		$this->disponibilidad = $disponibilidad;
		$this->horarioIdPista = $horarioIdPista;
		$this->hora = $hora;
		$this->numInscritos = $numInscritos;
		
	
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
	

public function getNumInscritos() {
		return $this->numInscritos;
	}
	public function setNumInscritos($numInscritos) {
		$this->numInscritos = $numInscritos;
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