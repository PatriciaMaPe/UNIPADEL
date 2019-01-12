<?php

require_once(__DIR__."/../core/ValidationException.php");
/**
* @author Victor
*/

class RealizarReserva {
	
	private $idReserva;
	private $fecha;
	private $horaInicio;
	private $horaFin;
	private $PistaidPista;
	private $disponibilidad;
	private $UsuarioRegistradousuario;
	private $finInscripcion;



	public function __construct($idReserva=NULL,$fecha=NULL,$horaInicio=NULL,
								$horaFin=NULL,	
								$PistaidPista=NULL,$disponibilidad=NULL,
								$UsuarioRegistradousuario=NULL,$finInscripcion=NULL) {
	
		$this->idReserva = $idReserva;
		$this->fecha = $fecha;
		$this->horaInicio = $horaInicio;
		$this->horaFin = $horaFin;
		$this->PistaidPista = $PistaidPista;
		$this->disponibilidad = $disponibilidad;
		$this->UsuarioRegistradousuario = $UsuarioRegistradousuario;
		$this->finInscripcion = $finInscripcion;

	}
	public function getIdReserva() {
		return $this->idReserva;
	}

	public function getFecha() {
		return $this->fecha;
	}
	public function getHoraInicio() {
		return $this->horaInicio;
	}
	public function getHoraFin() {
		return $this->horaFin;
	}
	public function getPistaidPista() {
		return $this->PistaidPista;
	}
		public function getFinInscripcion() {
		return $this->finInscripcion;
	}
	
	public function getDisponibilidad() {
		return $this->disponibilidad;
	}
	public function getUsuarioRegistradousuario() {
		return $this->UsuarioRegistradousuario;
	}
	public function setFinInscripcion($finInscripcion) {
		$this->finInscripcion = $finInscripcion;
	}
	public function setIdReserva($idReserva) {
		$this->idReserva = $idReserva;
	}
	public function setNumInscritos($numInscritos) {
		$this->numInscritos = $numInscritos;
	}

	public function setFecha($fech) {
		$this->fecha = $fech;
	}
	public function setHoraInicio($horaInicio) {
		$this->horaInicio = $horaInicio;
	}
	public function setHoraFin($horaFin) {
		$this->horaFin = $horaFin;
	}
	public function setPistaIdPista($PistaidPista) {
		$this->PistaidPista = $PistaidPista;
	}
	public function setDisponibilidad($disp) {
		$this->disponibilidad = $disp;
	}
	public function setUsuarioRegistradousuario($UsuarioRegistradousuario) {
		$this->UsuarioRegistradousuario = $UsuarioRegistradousuario;
	}
	
	
	
	
}