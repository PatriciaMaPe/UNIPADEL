<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/PartidoReserva.php");

class PartidoReservaMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

    public function save(PartidoReserva $partidoReserva) {

    $stmt = $this->db->prepare("INSERT INTO Partido_Reserva(PartidoidPartido,ReservaidReserva) values (?,?)");
    $stmt->execute(array($partidoReserva->getIdPartido(), $partidoReserva->getIdReserva()));

  }
        
	}


