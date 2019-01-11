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
    return $this->db->lastInsertId();
  }
  
  public function findAll() {

        $stmt = $this->db->query("SELECT * FROM Partido");
        $stmt->execute();
        $partidos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $partidos = array();

        foreach ($partidos_db as $partido) {
            array_push($partidos, new Partido($partido["idPartido"], $partido["fecha"], $partido["horaInicio"], $partido["horaFin"], $partido["inicioInscripcion"], $partido["finInscripcion"]));
        }

        return $partidos;
    }
}
