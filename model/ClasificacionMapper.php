<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Clasificacion.php");
require_once(__DIR__."/../model/ParejaMapper.php");
require_once(__DIR__."/../model/UsuarioRegistradoMapper.php");

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
	private $parejaMapper;
	private $usuarioMapper;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
		$this->parejaMapper = new ParejaMapper();
		$this->usuarioMapper = new UsuarioRegistradoMapper();
	}


	/**
	*
	*/
	public function findByLigaCampeonato($campeonatoId, $tipoLiga, $grupoId){
		$stmt = $this->db->prepare("SELECT ParejaidPareja, resultado FROM Clasificacion
			WHERE CampeonatoidCampeonato=? AND GrupotipoLiga=? AND GrupoidGrupo=? ORDER BY resultado DESC");
		$stmt->execute(array($campeonatoId, $tipoLiga, $grupoId));
		$clasificacion_db = $stmt->fetchAll(PDO::FETCH_ASSOC);


		$clasificacion = array();

		foreach ($clasificacion_db as $clas) {
			$pareja = $this->parejaMapper->getUsuariosPareja($clas['ParejaidPareja']);

			$capitan = $this->usuarioMapper->findById($pareja[0]);
			
			$deportista = $this->usuarioMapper->findById($pareja[1]);
			array_push($clasificacion, new Clasificacion(NULL, new Pareja($clas['ParejaidPareja'], $capitan, $deportista), $clas['resultado']));
		}

		 return $clasificacion;

	}


	}
