<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/establecerPistas.php");
require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/RealizarReserva.php");

/**
*
*
* @author Victor
*/
class RealizarReservaMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function insertarReserva(RealizarReserva $reserva) {
		$stmt = $this->db->prepare("INSERT INTO Reserva (fecha,PistaidPista,horaInicio,horaFin,disponibilidad) VALUES (?,?,?,?,?)");
		$stmt->execute(array($reserva->getFecha(),$reserva->getPistaidPista(),$reserva->getHoraInicio(),$reserva->getHoraFin(),$reserva->getDisponibilidad()));
		return $this->db->lastInsertId();
	}
	public function cancelarReserva(RealizarReserva $reserva) {
		$stmt = $this->db->prepare("DELETE FROM Reserva WHERE PistaidPista=? AND horaInicio=? AND fecha=?");
		$stmt->execute(array($reserva->getPistaidPista(),$reserva->getHoraInicio(),$reserva->getFecha()));

	}



}
