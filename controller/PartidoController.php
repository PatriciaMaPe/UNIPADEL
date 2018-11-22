<?php

require_once(__DIR__ . "/../model/Partido.php");
require_once(__DIR__ . "/../model/PartidoMapper.php");
require_once(__DIR__ . "/../model/PartidoMapper.php");

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class PartidoController extends BaseController {

    private $partidoMapper;

    public function __construct() {
        parent::__construct();

        $this->partidoMapper = new PartidoMapper();
    }

    public function index() {
    $this->view->render("partido", "index");
  }

    public function add() {

        $partido = new Partido();

        if (isset($_POST["fecha"])) {

            $partido->setFecha($_POST["fecha"]);
            $partido->setHoraInicio($_POST["horaInicio"]);
            $partido->setHoraFin($_POST["horaFin"]);
            $partido->setInicioInscripcion($_POST["inicioInscripcion"]);
            $partido->setFinInscripcion($_POST["finInscripcion"]);

            try {

                $this->partidoMapper->save($partido);

                $this->view->setFlash(sprintf("Partido \"%s\" añadido correctamente."));
                $this->view->redirect("partido", "index");

            } catch (ValidationException $ex) {

                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $this->view->render("partido", "index");
    }

    public function view(){

		$idPartido = $_REQUEST["idPartido"];
		$fecha = $_REQUEST["fecha"];
		$horaInicio = $_REQUEST["horaInicio"];
                $horaFin = $_REQUEST["horaFin"];
                $inicioInscripcion = $_REQUEST["inicioInscripcion"];
                $finInscripcion = $_REQUEST["finInscripcion"];

		if($idPartido==NULL){
			throw new Exception("No se han realizado partidos");
		}

                $this->view->setVariable("idPartido", $idPartido, false);
		$this->view->setVariable("fecha", $fecha, false);
		$this->view->setVariable("horaInicio", $horaInicio, false);
		$this->view->setVariable("horaFin", $horaFin, false);
                $this->view->setVariable("inicioInscripcion", $inicioInscripcion, false);
                $this->view->setVariable("finInscripcion", $finInscripcion, false);
                $this->view->render("partido", "index");
	}

}
