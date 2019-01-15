<?php

require_once(__DIR__."/../core/ValidationException.php");
/**
* @author Patricia
*/

class PosiblesReservasEnfrentamiento {

	private $idEnfrentamiento;
	private $idReserva;
	private $fecha;
	private $horaInicio;
	private $horaFin;
	private $PistaidPista;
	private $disponibilidad;
	private $usuario;


	public function __construct($idEnfrentamiento=NULL,$idReserva=NULL,$fecha=NULL,$horaInicio=NULL,
								$horaFin=NULL,
								$PistaidPista=NULL,$disponibilidad=NULL, UsuarioRegistrado $usuario=NULL) {

		$this->idEnfrentamiento = $idEnfrentamiento;
		$this->idReserva = $idReserva;
		$this->fecha = $fecha;
		$this->horaInicio = $horaInicio;
		$this->horaFin = $horaFin;
		$this->PistaidPista = $PistaidPista;
		$this->disponibilidad = $disponibilidad;
		$this->usuario = $usuario;

	}

	public function getIdEnfrentamiento() {
		return $this->idEnfrentamiento;
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

	public function getDisponibilidad() {
		return $this->disponibilidad;
	}

	public function getUsuario() {
		return $this->usuario;
	}

	public function setIdEnfrentamiento($idEnfrentamiento) {
		$this->idEnfrentamiento = $idEnfrentamiento;
	}

	public function setIdReserva($idReserva) {
		$this->idReserva = $idReserva;
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

	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}






}
