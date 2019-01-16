<?php
//file: controller/EnfrentamientoController.php


require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/GestionarReservasMapper.php");
require_once(__DIR__."/../model/PosiblesReservasEnfrentamientoMapper.php");
require_once(__DIR__."/../model/RealizarReservaMapper.php");
require_once(__DIR__."/../model/ReservaEnfrentamientoMapper.php");
require_once(__DIR__."/../model/EnfrentamientoMapper.php");
require_once(__DIR__."/../model/ParejaMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../model/ReservaMapper.php");
/**
* @author Patricia
*/
class AcordarReservasController extends BaseController {

	private $gestionarReservasMapper;
	private $PosiblesReservasEnfrentamientoMapper;
	private $ReservaMapper;

	public function __construct() {
		parent::__construct();
		$this->GestionarReservasMapper = new GestionarReservasMapper();
		$this->PosiblesReservasEnfrentamientoMapper = new PosiblesReservasEnfrentamientoMapper();
		$this->RealizarReservaMapper = new RealizarReservaMapper();
		$this->ReservaEnfrentamientoMapper = new ReservaEnfrentamientoMapper();
		$this->EnfrentamientoMapper = new EnfrentamientoMapper();
		$this->ParejaMapper = new ParejaMapper();
		$this->ReservaMapper = new ReservaMapper();
	}


	public function acordarReserva() {
			$enfrentamientoId = $_REQUEST['enfrentamiento'];
			$enfrentamiento = $this->EnfrentamientoMapper->findByIdEnfrentamiento($enfrentamientoId);
			$pareja1 = $this->ParejaMapper->findByIdPareja($enfrentamiento->getPareja1()->getIdPareja());
			$pareja2 = $this->ParejaMapper->findByIdPareja($enfrentamiento->getPareja2()->getIdPareja());

			if ($pareja1->getCapitan()->getUsuario()==$_SESSION["currentuser"] || $pareja2->getCapitan()->getUsuario()==$_SESSION["currentuser"]) {
				$esCapitan=true;
			}
			else {
				$esCapitan=false;
			}

			$posiblesReservas = $this->comprobarPosiblesReservas($enfrentamientoId);
			if($posiblesReservas!=NULL){ //Una pareja ya ha elegido pistas, solo se muestran
				$this->view->setVariable("posiblesReservas", $posiblesReservas, false);
				$this->view->setVariable("esCapitan", $esCapitan, false);
				$this->view->render("reservas", "elegirReserva");
				die;
			}
			if($esCapitan) {
				$this->view->setVariable("idEnfrentamiento", $enfrentamientoId, false);
				$this->view->render("reservas", "acordarReserva");
			}
			else {
				$this->view->setFlash("No se han realizado peticiones de reserva");
				$this->view->redirect("enfrentamiento", "enfrentamientosUsuario");
			}


	}

	public function comprobarPosiblesReservas($enfrentamiento) {
		$posiblesReservas = $this->PosiblesReservasEnfrentamientoMapper->findAllByEnfrentamiento($enfrentamiento);
		return $posiblesReservas;
	}

	public function acordarPistasFecha() {

		if (isset($_REQUEST['fecha'])){
			$idEnfrentamiento=$_REQUEST["idEnfrent"];
			$dia=$_REQUEST["fecha"];
			$fecha= $this->GestionarReservasMapper->findByFecha($dia);
			$this->view->setVariable("fecha", $fecha, false);
			$this->view->setVariable("idEnfrentamiento", $idEnfrentamiento, false);
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

			$this->view->setFlash("Reserva realizada");
			$this->view->redirect("enfrentamiento", "enfrentamientosUsuario");

	}


	public function finalizarAcuerdo() {

			$idEnfrentamiento = $_REQUEST['idEnfrentamiento'];
			$usuario = $_REQUEST['usuario'];
			$fecha = $_REQUEST['fecha'];
			$horaInicio = $_REQUEST['horaInicio'];
			$horaFin = $_REQUEST['horaFin'];
			$pista = $_REQUEST['pista'];

			$enfrentamiento = $this->EnfrentamientoMapper->findByIdEnfrentamiento($idEnfrentamiento);
			$pareja1 = $this->ParejaMapper->findByIdPareja($enfrentamiento->getPareja1()->getIdPareja());
			$pareja2 = $this->ParejaMapper->findByIdPareja($enfrentamiento->getPareja2()->getIdPareja());

			if ($pareja1->getCapitan()->getUsuario()==$_SESSION["currentuser"] || $pareja2->getCapitan()->getUsuario()==$_SESSION["currentuser"]) {
				$esCapitan=true;
			}
			else {
				$esCapitan=false;
			}

			if($esCapitan && $usuario!=$_SESSION["currentuser"]) {
				$this->GestionarReservasMapper->updateHorario("ocupado", $pista, $horaInicio, $fecha, NULL);
				$insercion = $this->RealizarReservaMapper->insertarReserva(new RealizarReserva(
					NULL, $fecha, $horaInicio, $horaFin, $pista, "ocupado", $_SESSION["currentuser"]
				));

				$this->ReservaEnfrentamientoMapper->insertarReservaEnfrentamiento($insercion,$idEnfrentamiento,$pista, $horaInicio, $fecha);

				$this->view->setFlash("Operación realizada");
				$this->view->redirect("enfrentamiento", "enfrentamientosUsuario");
			}
			else {
				$this->view->setFlash("Solo el capitan del equipo contrincante puede confirmar la reserva");
				$this->view->redirect("enfrentamiento", "enfrentamientosUsuario");
			}
	}

	public function rechazarAcuerdo() {
		$idEnfrentamiento = $_REQUEST['idEnfrentamiento'];
		$usuario = $_REQUEST['usuario'];
		$esCapitan = $_REQUEST['esCapitan'];

		if($esCapitan) {
			try {
				$this->PosiblesReservasEnfrentamientoMapper->eliminarAcuerdo($idEnfrentamiento);
				$this->view->setFlash("Operación realizada");
				$this->view->redirect("enfrentamiento", "enfrentamientosUsuario");
			}
			catch (Exception $e)
			{
				$this->view->setFlash("Fallo durante la transacción");
				$this->view->redirect("enfrentamiento", "enfrentamientosUsuario");
			}
		}


	}

	public function mostrarReserva() {
		$idEnfrentamiento = $_REQUEST['idEnfrentamiento'];

		$idReserva = $this->ReservaEnfrentamientoMapper->findIdReservaByIdEnfrentamiento($idEnfrentamiento);
		$reserva = $this->ReservaMapper->findReservaById($idReserva);

		$this->view->setVariable("reserva", $reserva, false);
		$this->view->render("reservas", "reservaAcordada");

	}

}
