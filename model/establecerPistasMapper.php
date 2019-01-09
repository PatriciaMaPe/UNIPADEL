<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/establecerPistas.php");

/**

* @author Victor
*/
class establecerPistasMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function insertarPista($pista) {
		$stmt = $this->db->prepare("SELECT idPista FROM Pista WHERE idPista='".$pista."'");
		$stmt->execute();
		$pistas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$existe=count($pistas);
		if($existe ==0){
			$stmt = $this->db->prepare("INSERT INTO Pista (idPista) VALUES (?)");
			$stmt->execute(array($pista));
		}
		return $this->db->lastInsertId();
	}
	public function insertarHorario(establecerPistas $horario) {

		$stmt = $this->db->prepare("INSERT INTO Horario (horario,idPista,disponibilidad,fecha) VALUES (?,?,?,?)");
		$stmt->execute(array($horario->getHora(),$horario->getHorarioIdPista(),$horario->getDisponibilidad(),$horario->getFecha()));
		return $this->db->lastInsertId();
	}

}
