<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/establecerPistas.php");
require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/Reserva.php");

/**
*
*
* @author Patricia
*/
class ReservaMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function findReservaById($idReserva) {

		$stmt = $this->db->prepare("SELECT * FROM Reserva WHERE idReserva=?");
		$stmt->execute(array($idReserva));
		$reserva_db = $stmt->fetch(PDO::FETCH_ASSOC);
		return $reserva_db;
	}
	/*public function cancelarReserva(RealizarReserva $reserva) {
		$stmt = $this->db->prepare("DELETE FROM Reserva WHERE PistaidPista=? AND horaInicio=? AND fecha=?");
		$stmt->execute(array($reserva->getPistaidPista(),$reserva->getHoraInicio(),$reserva->getFecha()));

	}*/







}
