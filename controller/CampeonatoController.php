<?php

require_once(__DIR__ . "/../model/Campeonato.php");
require_once(__DIR__ . "/../model/CampeonatoMapper.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/CategoriaMapper.php");


require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class CampeonatoController extends BaseController {

    private $campeonatoMapper;
    private $categoriaMapper;

    public function __construct() {
        parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaMapper = new CategoriaMapper();
    }

    public function index() {
        if (!isset($this->currentUser)) {
            $this->view->render("usuarios", "login");
        } else {
            //if($this->currentUser->getTipo()!='admin'){
            //$errors = array();
            //$errors["general"] = "Usuario no valido para crear campeonatos";
            //$this->view->setVariable("errors", $errors);
            //$this->view->redirect("home", "index");
            //}
            $campeonatos = $this->campeonatoMapper->findAll();
            $this->view->setVariable("campeonatos", $campeonatos, false);
            $this->view->render("campeonato", "index");
        }
    }

    public function add() {

        $campeonato = new Campeonato();
        $categoria = new Categoria();

        if (isset($_POST["nombreCampeonato"])) {

            //TO DO: Depurar entrada del usuario
            try {
                if (isset($_POST["masculina"])) {

                    $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
                    $campeonato->setFechaInicio($_POST["fechaInicio"]);
                    $campeonato->setFechaFin($_POST["fechaFin"]);
                    $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
                    $campeonato->setFinInscripcion($_POST["finInscripcion"]);
                    $campeonato->setReglas($_POST["reglas"]);
                    $categoria->setTipo($_POST["masculina"]);
                    $categoria->setNivel($_POST["nivel"]);

                    try {

                        $campeonato->checkIsValidForCreate();

                        $idcam = $this->campeonatoMapper->save($campeonato);
                        $idcat = $this->categoriaMapper->save($categoria);
                        //TO DO: CampeonatoCategoria crear tabla y guardar los parametros
                    } catch (ValidationException $ex) {
                        $errors = $ex->getErrors();
                        $this->view->setVariable("errors", $errors);
                    }
                }

                if (isset($_POST["femenina"])) {

                    $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
                    $campeonato->setFechaInicio($_POST["fechaInicio"]);
                    $campeonato->setFechaFin($_POST["fechaFin"]);
                    $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
                    $campeonato->setFinInscripcion($_POST["finInscripcion"]);
                    $campeonato->setReglas($_POST["reglas"]);
                    $categoria->setTipo($_POST["femenina"]);
                    $categoria->setNivel($_POST["nivel"]);

                    try {

                        $campeonato->checkIsValidForCreate();
                        
                        $this->campeonatoMapper->save($campeonato);
                        $this->categoriaMapper->save($categoria);
                    } catch (ValidationException $ex) {
                        $errors = $ex->getErrors();
                        $this->view->setVariable("errors", $errors);
                    }
                }

                if (isset($_POST["mixta"])) {

                    $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
                    $campeonato->setFechaInicio($_POST["fechaInicio"]);
                    $campeonato->setFechaFin($_POST["fechaFin"]);
                    $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
                    $campeonato->setFinInscripcion($_POST["finInscripcion"]);
                    $campeonato->setReglas($_POST["reglas"]);
                    $categoria->setTipo($_POST["mixta"]);
                    $categoria->setNivel($_POST["nivel"]);

                    try {

                        $campeonato->checkIsValidForCreate();

                        $this->campeonatoMapper->save($campeonato);
                        $this->categoriaMapper->save($categoria);
                        
                    } catch (ValidationException $ex) {
                        $errors = $ex->getErrors();
                        $this->view->setVariable("errors", $errors);
                    }
                }
                
                $this->view->setFlash(sprintf("Campeonato \"%s\" añadido correctamente."), $campeonato->getNombreCampeonato());
                $this->view->redirect("campeonato", "index");
                
            } catch (ValidationException $ex) {

                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->render("campeonato", "index");
    }

    public function view() {

        $nombreCampeonato = $_REQUEST["nombreCampeonato"];

        if ($nombreCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }

        $campeonatos = $this->campeonatoMapper->finAll();

        $this->view->setVariable("campeonatos", $campeonatos, false);

        $this->view->render("campeonato", "index");
    }

}
