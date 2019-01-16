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
  public function findReservaByIdEnfrentamiento($enfrentamiento){
    $idsReservasEnfrent = array();

      $stmt = $this->db->prepare("SELECT * FROM Reserva_Enfrentamiento WHERE idEnfrentamiento=?");
      $stmt->execute(array($enfrentamiento));
      $reservasEnfrentamiento_db = $stmt->fetch(PDO::FETCH_ASSOC);

      return $reservasEnfrentamiento_db["PistaidPista"];
  }

  public function findIdReservaByIdEnfrentamiento($enfrentamiento){
    $idsReservasEnfrent = array();

      $stmt = $this->db->prepare("SELECT idReserva FROM Reserva_Enfrentamiento WHERE idEnfrentamiento=?");
      $stmt->execute(array($enfrentamiento));
      $reservasEnfrentamiento_db = $stmt->fetch(PDO::FETCH_ASSOC);

      return $reservasEnfrentamiento_db["idReserva"];
  }


  public function insertarReservaEnfrentamiento($idReserva,$idEnfrentamiento, $idPista, $horaInicio, $fecha) {
    try {
      $this->db->beginTransaction();

      $stmt = $this->db->prepare("INSERT INTO Reserva_Enfrentamiento(idReserva,idEnfrentamiento,PistaidPista) VALUES (?,?,?)");
      $stmt->execute(array($idReserva, $idEnfrentamiento, $idPista));

      $this->eliminarReservaEnfrentamiento($idEnfrentamiento);

      $this->db->commit();

      return $this->db->lastInsertId();
    }
    catch(Exception $e) {
      $this->db->rollBack();
      echo "Error durante la transacción";
      die;
    }

  }

  public function eliminarReservaEnfrentamiento($idEnfrentamiento) {
    $stmt = $this->db->prepare("DELETE FROM PosiblesReservasEnfrentamiento WHERE idEnfrentamiento=?");
    $stmt->execute(array($idEnfrentamiento));
  }
}
