<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/establecerPistas.php");
require_once(__DIR__."/../model/GestionarReservas.php");

/**
*
*
* @author Victor
*/
class GestionarReservasMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function updateHorario( $disponibilidad, $idPista, $horario, $fecha) {
		$stmt = $this->db->prepare("UPDATE Horario SET disponibilidad=? WHERE idPista=? AND horario=? AND fecha=?");
		$stmt->execute(array($disponibilidad,$idPista,$horario,$fecha));

	}
	public function findByFecha($fec){
		$stmt = $this->db->prepare("SELECT idPista,horario,disponibilidad FROM Horario WHERE fecha=? ORDER BY idPista,horario");
		$stmt->execute(array($fec));
		$pistas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horas=array();

		foreach($pistas as $hora){
			array_push($horas, new GestionarReservas($fec,$hora["disponibilidad"],$hora["idPista"],$hora["horario"]));
		}

		return $horas;

	}


}
