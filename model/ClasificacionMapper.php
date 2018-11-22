<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Clasificacion.php");

/**
* Class PostMapper
*
* Database interface for Clasificacion entities
*
* @author Patricia
*/
class ClasificacionMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}


	/**
	*
	*/
	public function findByLigaCampeonato($campeonatoId, $tipoLiga){
		$stmt = $this->db->prepare("SELECT ParejaidPareja, resultado FROM Clasificacion
			WHERE CampeonatoidCampeonato=? AND GrupotipoLiga=? ORDER BY resultado");
		$stmt->execute(array($campeonatoId, $tipoLiga));
		$clasificacion_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$clasificacion = array();

		foreach ($clasificacion_db as $clas) {
			array_push($clasificacion, new Clasificacion(NULL, new Pareja($clas['ParejaidPareja']), $clas['resultado']));
		}

		 return $clasificacion;

	}


	}
