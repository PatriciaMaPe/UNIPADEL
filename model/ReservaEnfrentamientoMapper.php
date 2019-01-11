<?php
// file: model/PistaEnfrentamientoMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/ReservaEnfrentamiento.php");
/**
 * Class PistaEnfrentamientoMapper
 *
 */
class ReservaEnfrentamientoMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
  * Recuperamos la reserva asociada a un enfrentamiento
  */
  public function findReservaByIdEnfrentamiento($enfrentamientos){
    $idsReservasEnfrent = array();

    foreach ($enfrentamientos as $enfrentamiento) {
      $stmt = $this->db->prepare("SELECT * FROM Reserva_Enfrentamiento WHERE idEnfrentamiento=?");
      $stmt->execute(array($enfrentamiento->getIdEnfrentamiento()));
      $reservasEnfrentamiento_db = $stmt->fetch(PDO::FETCH_ASSOC);

      array_push($idsReservasEnfrent, new ReservaEnfrentamiento($reservasEnfrentamiento_db["idReserva"],
                                   $reservasEnfrentamiento_db["idEnfrentamiento"]));
    }

    return $idsReservasEnfrent;

  }
}
