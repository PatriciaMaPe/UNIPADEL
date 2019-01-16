<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/establecerPistas.php");
require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/PosiblesReservasEnfrentamiento.php");

/**
*
*
* @author Victor
*/
class PosiblesReservasEnfrentamientoMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function insertarPosiblesReservas($reservas, $currentuser, $idEnfrentamiento) {
		foreach ($reservas as $reserva) {
			$minutosAumentar=90;
			$segundos_horaInicio=strtotime(trim($reserva[2]));
			$segundos_minutoAumentar = $minutosAumentar*60;
			$horaFin=date("H:i",$segundos_horaInicio+$segundos_minutoAumentar);

			$stmt = $this->db->prepare("INSERT INTO PosiblesReservasEnfrentamiento
				(idEnfrentamiento,UsuarioRegistradousuario,fecha,horaInicio,horaFin,PistaidPista,disponibilidad)
				VALUES (?,?,?,?,?,?,?)");

			$stmt->execute(array($idEnfrentamiento,$currentuser,$reserva[0],trim($reserva[2]),$horaFin,trim($reserva[1]),trim($reserva[3])));

		}

		return $this->db->lastInsertId();
	}


	public function findAllByEnfrentamiento($idEnfrentamiento) {
		$stmt = $this->db->prepare("SELECT * from PosiblesReservasEnfrentamiento where idEnfrentamiento=?");
		$stmt->execute(array($idEnfrentamiento));
		$posiblesReservas_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$posiblesReservas= array();

		foreach ($posiblesReservas_db as $reserva) {
			array_push($posiblesReservas, new PosiblesReservasEnfrentamiento(
				$reserva['idEnfrentamiento'], $reserva['idReserva'],
				$reserva['fecha'],$reserva['horaInicio'],$reserva['horaFin'],$reserva['PistaidPista'],
				$reserva['disponibilidad'], new UsuarioRegistrado($reserva['UsuarioRegistradousuario'])
			));
		}

		return $posiblesReservas;
	}

	public function eliminarAcuerdo($idEnfrentamiento) {
		$stmt = $this->db->prepare("DELETE FROM PosiblesReservasEnfrentamiento WHERE idEnfrentamiento=?");
		$stmt->execute(array($idEnfrentamiento));
	}

}
