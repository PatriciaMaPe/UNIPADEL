<?php
//file: controller/EnfrentamientoController.php

require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/Enfrentamiento.php");
require_once(__DIR__."/../model/EnfrentamientoMapper.php");
require_once(__DIR__."/../model/GrupoMapper.php");
require_once(__DIR__."/../model/ParejaMapper.php");
require_once(__DIR__."/../model/ClasificacionMapper.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
* Class EnfrentamientoController
*
*
* @author Patricia
*/
class EnfrentamientoController extends BaseController {

	/**
	* Reference to the PostMapper to interact
	* with the database
	*
	* @var EnfrentamientoMapper
	*/
	private $enfrentamientoMapper;


	private $grupoMapper;
	private $parejaMapper;

	public function __construct() {
		parent::__construct();
		$this->enfrentamientoMapper = new EnfrentamientoMapper();
		$this->grupoMapper = new GrupoMapper();
		$this->parejaMapper = new ParejaMapper();
		$this->clasificacionMapper = new ClasificacionMapper();
	}

	/**
	*
	*/
	public function index() {
		if (!isset($this->currentUser)) {
			$this->view->render("usuarios", "login");
		}else{
			if($this->currentUser->getTipo()!='admin'){

			}

		// obtain the data from the database
		$gruposCampeonatos = $this->grupoMapper->findAll();
		// put the array containing Post object to the view
		$this->view->setVariable("gruposCampeonatos", $gruposCampeonatos, false);
		// render the view (/view/enfrentamientos/index.php)
		$this->view->render("enfrentamientos", "index");
		}
	}

	/**
	*
	*
	* @throws Exception If no such post of the given id is found
	* @return void
	*
	*/
	public function view(){
		if (!isset($this->currentUser)) {
			//throw new Exception("Necesitas iniciar sesion");
			$this->view->render("usuarios", "login");
		}else{
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A id is mandatory");
		}
		if (!isset($_REQUEST["liga"])) {
			throw new Exception("A liga is mandatory");
		}
		if (!isset($_REQUEST["campeonato"])) {
			throw new Exception("A campeonato is mandatory");
		}

		$grupoId = $_REQUEST["id"];
		$tipoLiga = $_REQUEST["liga"];
		$campeonato = $_REQUEST["campeonato"];

		// obtain the data from the database
		$enfrentamientosParejas = $this->enfrentamientoMapper->findByIdPareja($grupoId, $tipoLiga, $campeonato);
		$parejas = $this->enfrentamientoMapper->findAllParejas($grupoId, $tipoLiga);


		if($enfrentamientosParejas==NULL){
			throw new Exception("No se han realizado los enfrentamientos");
		}

		// put the array containing Post object to the view
		$this->view->setVariable("enfrentamientosParejas", $enfrentamientosParejas, false);
		$this->view->setVariable("parejas", $parejas, false);
		$this->view->setVariable("idGrupo", $grupoId, false);
		$this->view->setVariable("tipoLiga", $tipoLiga, false);

		// render the view (/view/enfrentamientos/view.php)
		$this->view->render("enfrentamientos", "view");
		}
	}

	//TODO desactivar boton de generar enfrentamientos una vez realizado
	public function generarEnfrentamientos() {
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A post id is mandatory");
		}
		if (!isset($_REQUEST["liga"])) {
			throw new Exception("A post id is mandatory");
		}
		if (!isset($_REQUEST["campeonato"])) {
			throw new Exception("A post id is mandatory");
		}
		if (!isset($_REQUEST["categoria"])) {
			throw new Exception("A post id is mandatory");
		}

		$grupoId = $_REQUEST["id"];
		$tipoLiga = $_REQUEST["liga"];
		$campeonatoId = $_REQUEST["campeonato"];
		$categoriaId = $_REQUEST["categoria"];
		// Get the Post object from the database
		if($tipoLiga=='regular'){
		$lastInsert = $this->parejaMapper->generarEnfrentamientosRegular($grupoId,$campeonatoId, $categoriaId);
	} elseif ($tipoLiga=='cuartos') {
		$lastInsert = $this->parejaMapper->generarEnfrentamientosCuartos($grupoId,$campeonatoId, $categoriaId);
	} elseif ($tipoLiga=='semifinal') {
		$lastInsert = $this->parejaMapper->generarEnfrentamientosSemifinales($grupoId,$campeonatoId, $categoriaId);

	}
}


	public function generarRanking() {
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A post id is mandatory");
		}
		if (!isset($_REQUEST["liga"])) {
			throw new Exception("A post id is mandatory");
		}
		if (!isset($_REQUEST["campeonato"])) {
			throw new Exception("A post id is mandatory");
		}
		if (!isset($_REQUEST["categoria"])) {
			throw new Exception("A post id is mandatory");
		}


		// Get the Post object from the database
		$grupoId = $_REQUEST["id"];
		$tipoLiga = $_REQUEST["liga"];
		$campeonatoId = $_REQUEST["campeonato"];
		$categoriaId = $_REQUEST["categoria"];
		if($tipoLiga=='regular'){
			$lastInsert = $this->parejaMapper->generarRankingRegular($grupoId,$campeonatoId, $categoriaId, $tipoLiga);
			$clasificacion = $this->clasificacionMapper->findByLigaCampeonato($campeonatoId, $tipoLiga);

			$this->view->setVariable("clasificacion", $clasificacion, false);
			// render the view (/view/enfrentamientos/view.php)
			$this->view->render("clasificacion", "index");

		} elseif ($tipoLiga=='cuartos') {
			$lastInsert = $this->parejaMapper->generarRankingCuartos($grupoId, $campeonatoId, $categoriaId, $tipoLiga);
			$clasificacion = $this->clasificacionMapper->findByLigaCampeonato($campeonatoId, $tipoLiga);

			$this->view->setVariable("clasificacion", $clasificacion, false);
			// render the view (/view/enfrentamientos/view.php)
			$this->view->render("clasificacion", "index");
		}

	}


	public function modificarResultados() {
		$idPareja1 = $_POST["pareja1"];
		$idPareja2 = $_POST["pareja2"];
		$set1 = $_POST["set1"];
		$set2 = $_POST["set2"];
		$set3 = $_POST["set3"];

		$this->enfrentamientoMapper->recogerResultados($idPareja1, $idPareja2, $set1, $set2, $set3);

		$this->view->redirect("enfrentamiento", "index");


}

}
