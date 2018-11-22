<?php
// file: model/PartidoMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Partido.php");
/**
 * Class CampeonatoMapper
 *
 */
class PartidoMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  public function save(Partido $partido) {

    $stmt = $this->db->prepare("INSERT INTO Partido(fecha, horaInicio, horaFin, inicioInscripcion, finInscripcion) values (?,?,?,?,?)");
    $stmt->execute(array($partido->getFecha(), $partido->getHoraInicio(), $partido->getHoraFin(), $partido->getInicioInscripcion(), $partido->getFinInscripcion()));
    //return $this->db->lastInsertId();
  }
}
