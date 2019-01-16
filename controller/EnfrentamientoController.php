<?php
//file: controller/EnfrentamientoController.php

require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/Enfrentamiento.php");
require_once(__DIR__."/../model/EnfrentamientoMapper.php");
require_once(__DIR__."/../model/GrupoMapper.php");
require_once(__DIR__."/../model/ParejaMapper.php");
require_once(__DIR__."/../model/ClasificacionMapper.php");
require_once(__DIR__."/../model/ReservaEnfrentamientoMapper.php");
require_once(__DIR__."/../model/PosiblesReservasEnfrentamientoMapper.php");

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
		$this->reservaEnfrentamientoMapper = new ReservaEnfrentamientoMapper();
		$this->posiblesReservasEnfrentamientoMapper = new PosiblesReservasEnfrentamientoMapper();
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
	* Recuperamos los enfrentamientos que tiene un usuario
	*/
	public function enfrentamientosUsuario() {
		if (!isset($this->currentUser)) {
			$this->view->render("usuarios", "login");
		}
		$usuario = $this->currentUser->getUsuario();

		//Recogemos los distintos ids que tiene la pareja segun la liga
		$idPareja = $this->parejaMapper->getIdPareja($usuario);

		//recogemos los enfrentamientos de la pareja
		$enfrentamientosPareja = $this->enfrentamientoMapper->findByEnfrentamientosPareja($idPareja);
		
		//Array de parejas
		$arrayParejas = array();
		//obtenemos el número de reservas de cada enfrentamiento
		foreach ($enfrentamientosPareja as $key => $enf) {
			$reservaPista = $this->reservaEnfrentamientoMapper->findReservaByIdEnfrentamiento($enf->getIdEnfrentamiento());
			$posiblesReservas = count($this->posiblesReservasEnfrentamientoMapper->findAllByEnfrentamiento($enf->getIdEnfrentamiento()));
			//Comprobamos si existe el enfrentamiento dentro del array comprobando las parejas
			//Si no existe la añadimos y ponemos los datos en $enfrentamientosPareja
			//Si ya existe la eliminamos de $enfrentamientosPareja
			if(
				!in_array([$enf->getPareja1(), $enf->getPareja2(), $enf->getLiga()], $arrayParejas) &&
				!in_array([$enf->getPareja2(), $enf->getPareja1(), $enf->getLiga()], $arrayParejas)
			) {
				array_push($arrayParejas,[$enf->getPareja1(), $enf->getPareja2(), $enf->getLiga()]);
				$enfrentamientosPareja[$key] = [$enf, $reservaPista, $posiblesReservas];
			}
			else {
				unset($enfrentamientosPareja[$key]);
			}
		}

		$this->view->setVariable("enfrentamientosPareja", $enfrentamientosPareja, false);
		//$this->view->setVariable("reservasEnfrentamiento", $reservasEnfrentamiento, false);
		// render the view (/view/enfrentamientos/enfrentamientosUsuario.php)
		$this->view->render("enfrentamientos", "enfrentamientosUsuario");

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
					$this->view->setFlash("<div class='alert alert-danger' role='alert'>
					Se necesita id de grupo</div>");
					$this->view->redirect("enfrentamiento", "index");
				}
				if (!isset($_REQUEST["liga"])) {
					$this->view->setFlash("<div class='alert alert-danger' role='alert'>
					Se necesita el tipo de liga</div>");
					$this->view->redirect("enfrentamiento", "index");
				}
				if (!isset($_REQUEST["campeonato"])) {
					$this->view->setFlash("<div class='alert alert-danger' role='alert'>
					Se necesita id de campeonato</div>");
					$this->view->redirect("enfrentamiento", "index");
				}

				$grupoId = $_REQUEST["id"];
				$tipoLiga = $_REQUEST["liga"];
				$campeonato = $_REQUEST["campeonato"];

		// obtain the data from the database
		$enfrentamientosParejas = $this->enfrentamientoMapper->findByIdPareja($grupoId, $tipoLiga, $campeonato);
		$parejas = $this->enfrentamientoMapper->findAllParejas($grupoId, $tipoLiga);

		if($enfrentamientosParejas==NULL){
			$this->view->setFlash("
			<div class='alert alert-danger' role='alert'>Aun no se han realizado los enfrentamientos
			</div>");
			$this->view->redirect("enfrentamiento", "index");
		}

		// put the array containing Post object to the view
		$this->view->setVariable("enfrentamientosParejas", $enfrentamientosParejas, false);
		$this->view->setVariable("parejas", $parejas, false);
		$this->view->setVariable("idGrupo", $grupoId, false);
		$this->view->setVariable("tipoLiga", $tipoLiga, false);
		$this->view->setVariable("campeonato", $campeonato, false);
		// render the view (/view/enfrentamientos/view.php)
		$this->view->render("enfrentamientos", "view");
		}
	}

	public function viewResultados($idC,$idG,$idL){
		if (!isset($this->currentUser)) {
			//throw new Exception("Necesitas iniciar sesion");
			$this->view->render("usuarios", "login");
		}else{
			$grupoId = $idG;
			$tipoLiga = $idL;
			$campeonato =$idC;
		}

		// obtain the data from the database
		$enfrentamientosParejas = $this->enfrentamientoMapper->findByIdPareja($grupoId, $tipoLiga, $campeonato);
		$parejas = $this->enfrentamientoMapper->findAllParejas($grupoId, $tipoLiga);

		if($enfrentamientosParejas==NULL){
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			No se han realizado los enfrentamientos</div>");
			$this->view->redirect("enfrentamiento", "index");
		}

		// put the array containing Post object to the view
		$this->view->setVariable("enfrentamientosParejas", $enfrentamientosParejas, false);
		$this->view->setVariable("parejas", $parejas, false);
		$this->view->setVariable("idGrupo", $grupoId, false);
		$this->view->setVariable("tipoLiga", $tipoLiga, false);
		$this->view->setVariable("campeonato", $campeonato, false);
		// render the view (/view/enfrentamientos/view.php)
		$this->view->render("enfrentamientos", "view");
	}


	//TODO desactivar boton de generar enfrentamientos una vez realizado
	public function generarEnfrentamientos() {
		if (!isset($_REQUEST["id"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita id del grupo</div>");
			$this->view->redirect("enfrentamiento", "index");
		}
		if (!isset($_REQUEST["liga"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita el tipo de liga</div>");
			$this->view->redirect("enfrentamiento", "index");
		}
		if (!isset($_REQUEST["campeonato"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita id de campeonato</div>");
			$this->view->redirect("enfrentamiento", "index");
		}
		if (!isset($_REQUEST["categoria"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita id de categoria</div>");
			$this->view->redirect("enfrentamiento", "index");
		}

		$grupoId = $_REQUEST["id"];
		$tipoLiga = $_REQUEST["liga"];
		$campeonatoId = $_REQUEST["campeonato"];
		$categoriaId = $_REQUEST["categoria"];
		// Get the Post object from the database
		if($tipoLiga=='regular'){
		$info = $this->parejaMapper->generarEnfrentamientosRegular($grupoId,$campeonatoId, $categoriaId);
	} elseif ($tipoLiga=='cuartos') {
		$info = $this->parejaMapper->generarEnfrentamientosCuartos($grupoId,$campeonatoId, $categoriaId);
	} elseif ($tipoLiga=='semifinal') {
		$info = $this->parejaMapper->generarEnfrentamientosSemifinales($grupoId,$campeonatoId, $categoriaId);
	} elseif ($tipoLiga=='final') {
		$info = $this->parejaMapper->generarEnfrentamientosFinales($grupoId,$campeonatoId, $categoriaId);
	}
	if($info!=NULL){
		$this->view->setFlash($info);
		$this->view->redirect("enfrentamiento", "index");
	}
	$this->view->setFlash("Operación realizada");
	$this->view->redirect("enfrentamiento", "view");
}


	public function generarRanking() {
		if (!isset($_REQUEST["id"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita id de grupo</div>");
			$this->view->redirect("enfrentamiento", "index");
		}
		if (!isset($_REQUEST["liga"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita el tipo de liga</div>");
			$this->view->redirect("enfrentamiento", "index");
		}
		if (!isset($_REQUEST["campeonato"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita id de campeonato</div>");
			$this->view->redirect("enfrentamiento", "index");
		}
		if (!isset($_REQUEST["categoria"])) {
			$this->view->setFlash("<div class='alert alert-danger' role='alert'>
			Se necesita id de categoria</div>");
			$this->view->redirect("enfrentamiento", "index");
		}


		// Get the Post object from the database
		$grupoId = $_REQUEST["id"];
		$tipoLiga = $_REQUEST["liga"];
		$campeonatoId = $_REQUEST["campeonato"];
		$categoriaId = $_REQUEST["categoria"];

		if($tipoLiga=='regular'){
			$lastInsert = $this->parejaMapper->generarRankingRegular($grupoId,$campeonatoId, $categoriaId, $tipoLiga);
			$clasificacion = $this->clasificacionMapper->findByLigaCampeonato($campeonatoId, $tipoLiga, $grupoId);

			$this->view->setVariable("clasificacion", $clasificacion, false);
			// render the view (/view/enfrentamientos/view.php)
			$this->view->render("clasificacion", "index");

		} elseif ($tipoLiga=='cuartos') {
			$lastInsert = $this->parejaMapper->generarRankingCuartos($grupoId, $campeonatoId, $categoriaId, $tipoLiga);
			$clasificacion = $this->clasificacionMapper->findByLigaCampeonato($campeonatoId, $tipoLiga, $grupoId);

			$this->view->setVariable("clasificacion", $clasificacion, false);
			// render the view (/view/enfrentamientos/view.php)
			$this->view->render("clasificacion", "index");
		}elseif ($tipoLiga=='semifinal') {
			$lastInsert = $this->parejaMapper->generarRankingSemifinales($grupoId, $campeonatoId, $categoriaId, $tipoLiga);
			$clasificacion = $this->clasificacionMapper->findByLigaCampeonato($campeonatoId, $tipoLiga, $grupoId);

			$this->view->setVariable("clasificacion", $clasificacion, false);
			// render the view (/view/enfrentamientos/view.php)
			$this->view->render("clasificacion", "index");
		}elseif ($tipoLiga=='final') {
			$lastInsert = $this->parejaMapper->generarRankingFinales($grupoId, $campeonatoId, $categoriaId, $tipoLiga);
			$clasificacion = $this->clasificacionMapper->findByLigaCampeonato($campeonatoId, $tipoLiga, $grupoId);

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

		$campeonato = $_REQUEST["campeonato"];
		$grupoId = $_REQUEST["grupoId"];
		$tipoLiga = $_REQUEST["tipoLiga"];

		$this->enfrentamientoMapper->recogerResultados($idPareja1, $idPareja2, $set1, $set2, $set3);
		$this->viewResultados($campeonato,$grupoId,$tipoLiga);

		//$this->view->redirect("enfrentamiento", "index");


}

}
