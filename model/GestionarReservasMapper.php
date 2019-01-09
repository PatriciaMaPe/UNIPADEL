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
		/*$stmt3 = $this->db->prepare("SELECT disponibilidad FROM Reserva WHERE PistaidPista='".$idPista."' ");
		$stmt3->execute();
		$row = $stmt3->fetchAll(PDO::FETCH_ASSOC);
		foreach ($row as $value) {
    			$disp= $value['disponibilidad'];
			}*/
		$stmt = $this->db->prepare("UPDATE HORARIO SET disponibilidad=? WHERE idPista=? AND horario=? AND fecha=?");
		$stmt->execute(array($disponibilidad,$idPista,$horario,$fecha));

	}
	public function findByFecha($fec){
		$stmt = $this->db->prepare("SELECT idPista,horario,disponibilidad,numInscritos FROM HORARIO WHERE fecha=? ORDER BY idPista,horario");
		$stmt->execute(array($fec));
		$pistas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$horas=array();

		foreach($pistas as $hora){
			array_push($horas, new GestionarReservas($fec,$hora["disponibilidad"],$hora["idPista"],$hora["horario"],$hora["numInscritos"]));
		}

		return $horas;

	}


}
