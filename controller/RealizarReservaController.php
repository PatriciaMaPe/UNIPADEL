<?php

require_once(__DIR__."/../model/GestionarReservasMapper.php");
require_once(__DIR__."/../model/RealizarReserva.php");
require_once(__DIR__."/../model/RealizarReservaMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
* @author Victor
*/
class RealizarReservaController extends BaseController {

	private $RealizarReservaController;

	public function __construct() {
		parent::__construct();
		$this->RealizarReservaMapper = new RealizarReservaMapper();
		$this->GestionarReservasMapper = new GestionarReservasMapper();
	}
	public function index() {
		$this->view->render("reservas", "gestionarReservas");

	}


	public function anadirReserva() {
			$reserva = new RealizarReserva();
			// populate the Post object with data form the form
			$pista=$_REQUEST["pista"];
			$hora=$_REQUEST["hora"];
			$horaFin=$_REQUEST["horaFinal"];
			$fecha=$_REQUEST["fecha"];
			$disponibilidad=$_REQUEST["disponibilidad"];
			$reserva->setPistaIdPista($pista);
			$reserva->setHoraInicio($hora);
			$reserva->setHoraFin($horaFin);
			$reserva->setFecha($fecha);

			if($disponibilidad=='disponible'){
				$disponibilidad='ocupado';
				$reserva->setDisponibilidad('ocupado');
				$this->RealizarReservaMapper->insertarReserva($reserva);
				$this->view->setFlash("Operación realizada");
				$this->GestionarReservasMapper->updateHorario($disponibilidad,$pista,$hora,$fecha);
			}else{
				$disponibilidad='disponible';
				$reserva->setDisponibilidad('disponible');
				$this->RealizarReservaMapper->cancelarReserva($reserva);
				$this->view->setFlash("Operación realizada");
				$this->GestionarReservasMapper->updateHorario($disponibilidad,$pista,$hora,$fecha);
			}
			?>
			<script>
			 alert('Operacion realizada');
			 </script>;
			<?

			$this->view->render("reservas", "gestionarReservas");

	}


}
