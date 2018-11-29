<?php

require_once(__DIR__ ."/../model/Campeonato.php");
require_once(__DIR__ ."/../model/CampeonatoMapper.php");
require_once(__DIR__ ."/../model/Categoria.php");
require_once(__DIR__ ."/../model/CategoriaMapper.php");


require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class CampeonatoController extends BaseController {
    //probamos esto a ver si funcioona
    private $campeonatoMapper;
    private $categoriaMapper;

    public function __construct() {
        parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaMapper = new CategoriaMapper();
    }


    //Crear campeonato
    public function index() {
      if (!isset($this->currentUser)) {
  			$this->view->render("usuarios", "login");
  		}else{
        //if($this->currentUser->getTipo()!='admin'){
          //$errors = array();
  				//$errors["general"] = "Usuario no valido para crear campeonatos";
  				//$this->view->setVariable("errors", $errors);
  				//$this->view->redirect("home", "index");
        //}
        $this->view->render("campeonato", "index");
    }
  }

    public function add() {

        $campeonato = new Campeonato();
        $categoria = new Categoria();

        if (isset($_POST["nombreCampeonato"])) {

            $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
            $campeonato->setFechaInicio($_POST["fechaInicio"]);
            $campeonato->setFechaFin($_POST["fechaFin"]);
            $campeonato->setFechaInicioInscripciones($_POST["inicioInscripcion"]);
            $campeonato->setFechaFinInscripciones($_POST["finInscripcion"]);

            $campeonato->setReglas($_POST["reglas"]);
            $categoria->setTipo($_POST["tipo"]);
            $categoria->setNivel($_POST["nivel"]);

            try {

                $this->campeonatoMapper->save($campeonato);
                $this->categoriaMapper->save($categoria);

                $this->view->setFlash(sprintf("Campeonato \"%s\" añadido correctamente."), $campeonato->getNombreCampeonato());
                $this->view->redirect("campeonato", "index");

            } catch (ValidationException $ex) {

                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->render("campeonato", "index");
    }

    public function view(){

                $idCampeonato = $_REQUEST["idCampeonato"];

		if($idCampeonato==NULL){
			throw new Exception("No se han realizado campeonatos");
		}

                $campeonatos = $this->campeonatoMapper->test($idCampeonato);

                $this->view->setVariable("campeonatos", $campeonatos, false);

                $this->view->render("campeonato", "index");
	}

}
