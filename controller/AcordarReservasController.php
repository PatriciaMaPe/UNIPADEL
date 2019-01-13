<?php
//file: controller/EnfrentamientoController.php


require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/GestionarReservasMapper.php");
require_once(__DIR__."/../model/PosiblesReservasEnfrentamientoMapper.php");
require_once(__DIR__."/../model/RealizarReservaMapper.php");
require_once(__DIR__."/../model/ReservaEnfrentamientoMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
* @author Patricia
*/
class AcordarReservasController extends BaseController {

	private $gestionarReservasMapper;
	private $PosiblesReservasEnfrentamientoMapper;

	public function __construct() {
		parent::__construct();
		$this->GestionarReservasMapper = new GestionarReservasMapper();
		$this->PosiblesReservasEnfrentamientoMapper = new PosiblesReservasEnfrentamientoMapper();
		$this->RealizarReservaMapper = new RealizarReservaMapper();
		$this->ReservaEnfrentamientoMapper = new ReservaEnfrentamientoMapper();

	}


	public function acordarReserva() {
			$enfrentamiento = $_REQUEST['enfrentamiento'];
			$posiblesReservas = $this->comprobarPosiblesReservas($enfrentamiento);

			if($posiblesReservas!=NULL){ //Una pareja ya ha elegido pistas, solo se muestran
				$this->view->setVariable("posiblesReservas", $posiblesReservas, false);
				$this->view->render("reservas", "elegirReserva");
			}else{
				$this->view->setVariable("idEnfrentamiento", $enfrentamiento, false);
				$this->view->render("reservas", "acordarReserva");
			}


	}

	public function comprobarPosiblesReservas($enfrentamiento) {
		$posiblesReservas = $this->PosiblesReservasEnfrentamientoMapper->findAllByEnfrentamiento($enfrentamiento);
		return $posiblesReservas;
	}

	public function acordarPistasFecha() {

		if (isset($_REQUEST['fecha'])){
			$dia=$_REQUEST["fecha"];
			$fecha= $this->GestionarReservasMapper->findByFecha($dia);
			$this->view->setVariable("fecha", $fecha, false);
			$this->view->render("reservas", "acordarReserva");
		}
	}

	public function elegirReservas() {

			$reservas = $_REQUEST['reservas'];
			$this->view->setVariable("reservas", $reservas, false);
			$this->view->render("reservas", "acordarReserva");
			foreach ($reservas as $reserva){
    			var_dump($reserva);
			}

	}

	public function addPosiblesReservas() {

			$idEnfrentamiento = $_REQUEST['idEnfrent'];
			$currentuser = $_SESSION["currentuser"];
			$arrayReservas = array();

			$reservas = $_REQUEST['reservas'];
			foreach ($reservas as $reserva){
				$r = explode("/", $reserva);
    		array_push($arrayReservas, $r);

			}

			$this->PosiblesReservasEnfrentamientoMapper->insertarPosiblesReservas($arrayReservas, $currentuser, $idEnfrentamiento);

			$this->view->render("reservas", "acordarReserva");
			echo("Reserva realizada");

	}


	public function finalizarAcuerdo() {

			$idEnfrentamiento = $_REQUEST['idEnfrentamiento'];
			$usuario = $_REQUEST['usuario'];
			$fecha = $_REQUEST['fecha'];
			$horaInicio = $_REQUEST['horaInicio'];
			$horaFin = $_REQUEST['horaFin'];
			$pista = $_REQUEST['pista'];

			$this->GestionarReservasMapper->updateHorario("ocupado", $pista, $horaInicio, $fecha);
			$insercion = $this->RealizarReservaMapper->insertarReserva(new RealizarReserva(
				NULL, $fecha, $horaInicio, $horaFin, $pista, "ocupado"
			));

			$this->ReservaEnfrentamientoMapper->insertarReservaEnfrentamiento($insercion,$idEnfrentamiento,$pista);

			$this->view->render("enfrentamientos", "enfrentamientosUsuario");
			echo("Reserva realizada");

	}

}
