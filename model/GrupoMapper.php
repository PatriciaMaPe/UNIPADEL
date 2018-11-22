<?php
// file: model/GrupoMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Campeonato.php");
require_once(__DIR__."/../model/Categoria.php");
require_once(__DIR__."/../model/Grupo.php");


/**
* Class GrupoMapper
*
* Database interface for Grupo entities
*
* @author Patricia
*/
class GrupoMapper {

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
	public function findAll() {
		$stmt = $this->db->query("SELECT Grupo.*, Categoria.nivel, Categoria.tipo
			FROM `Grupo`, `Categoria` WHERE Categoria.idCategoria = Grupo.Campeonato_CategoriaCategoriaidCategoria
			ORDER BY Grupo.Campeonato_CategoriaCampeonatoidCampeonato, Grupo.tipoLiga,Grupo.idGrupo");
		$gruposCampeonato_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$grupos = array();

		foreach ($gruposCampeonato_db as $grupo) {
			$campeonato = new Campeonato($grupo["Campeonato_CategoriaCampeonatoidCampeonato"]);
			$categoria = new Categoria($grupo["Campeonato_CategoriaCategoriaidCategoria"], $grupo["nivel"], $grupo["tipo"]);
			array_push($grupos, new Grupo($grupo["idGrupo"], $campeonato, $categoria, $grupo["tipoLiga"]));
		}

		return $grupos;
	}


	}
