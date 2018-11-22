<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Campeonato.php");
require_once(__DIR__."/../model/Categoria.php");

/**
* Class PostMapper
*
* Database interface for Post entities
*
*/
class CampeonatoMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Retrieves all posts
	*
	* Note: Comments are not added to the Post instances
	*
	* @throws PDOException if a database error occurs
	* @return mixed Array of Post instances (without comments)
	*/
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM Campeonato, Campeonato_Categoria WHERE users.username = posts.author");
		$posts_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$posts = array();

		foreach ($posts_db as $post) {
			$author = new User($post["username"]);
			array_push($posts, new Post($post["id"], $post["title"], $post["content"], $author));
		}

		return $posts;
	}


	public function test($idCampeonato) {

		$stmt = $this->db->prepare("SELECT idCampeonato FROM Campeonato");
		$stmt->execute(array($idCampeonato));
		$campeonatos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$campeonato = array();

		foreach ($campeonatos_db as $campeonato) {
			array_push($campeonato, new Campeonato($campeonato["idCampeonato"]));
		}

		return $campeonato;
	}

	public function save(Campeonato $campeonato) {

		$stmt = $this->db->prepare("INSERT INTO Campeonato(nombre, fechaInicio, fechaFin, fechaInicioInscripciones, fechaFinInscripciones, reglas) values (?,?,?,?,?,?)");
		$stmt->execute(array($campeonato->getNombreCampeonato(),$campeonato->getFechaInicio(), $campeonato->getFechaFin(), $campeonato->getFechaInicioInscripciones(), $campeonato->getFechaFinInscripciones(), $campeonato->getReglas()));

	}

	}
