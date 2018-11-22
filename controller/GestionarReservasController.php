<?php
//file: controller/EnfrentamientoController.php


require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/GestionarReservasMapper.php");
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
/**
* @author Victor
*/
class GestionarReservasController extends BaseController {

	private $gestionarReservasMapper;

	public function __construct() {
		parent::__construct();
		$this->GestionarReservasMapper = new GestionarReservasMapper();

	}

	public function index() {

			$this->view->render("reservas", "gestionarReservas");

	}


	public function verPistasFecha() {

		if (isset($_REQUEST['fecha'])){
			$dia=$_REQUEST["fecha"];
			$fecha= $this->GestionarReservasMapper->findByFecha($dia);

			$this->view->setVariable("fecha", $fecha, false);
			$this->view->render("fecha", "view");
		}
	}
}
