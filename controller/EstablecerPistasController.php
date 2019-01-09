<?php


require_once(__DIR__."/../model/establecerPistas.php");
require_once(__DIR__."/../model/establecerPistasMapper.php");


require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
/**

* @author Victor
*/
class EstablecerPistasController extends BaseController {

	private $establecerPistasMapper;

	public function __construct() {
		parent::__construct();
		$this->establecerPistasMapper = new establecerPistasMapper();

	}

	public function index() {
		var_dump("index");
		$this->view->render("pistas", "establecerPistas");

	}
	public function anadirPista() {

		$pist = new establecerPistas();
			// populate the Post object with data form the form
			$pist->setPista($_POST["pista"]);
			if ($_POST["pista"]!=$pist->getIdPista()) { // reaching via HTTP Post...
			$this->establecerPistasMapper->insertarPista($pist);
			$this->view->setFlash("Operación realizada");

			?>
				 <script>
				 alert('Operacion realizada');

				 </script>;
				<?
			$this->view->render("pistas", "establecerPistas");

		}else{
			//echo 'Ya existe esa pista, se añadirán solo los horarios adicionales';
			$this->view->render("pistas", "establecerPistas");
		}
		$hor = new establecerPistas();
		$disponible='disponible';

		if (isset($_POST['cero'])){
			$hor->setHora($_POST["cero"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['uno'])){
			$hor->setHora($_POST["uno"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['tres'])){
			$hor->setHora($_POST["tres"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['cuatro'])){
			$hor->setHora($_POST["cuatro"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['seis'])){
			$hor->setHora($_POST["seis"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['siete'])){
			$hor->setHora($_POST["siete"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['nueve'])){
			$hor->setHora($_POST["nueve"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['diez'])){
			$hor->setHora($_POST["diez"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['doce'])){
			$hor->setHora($_POST["doce"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['trece'])){
			$hor->setHora($_POST["trece"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['quince'])){
			$hor->setHora($_POST["quince"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['dieciseis'])){
			$hor->setHora($_POST["dieciseis"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['dieciocho'])){
			$hor->setHora($_POST["dieciocho"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['diecinueve'])){
			$hor->setHora($_POST["diecinueve"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['veintiuna'])){
			$hor->setHora($_POST["veintiuna"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}
		if (isset($_POST['veintidos'])){
			$hor->setHora($_POST["veintidos"]);
			$hor->setHorarioIdPista($pist->getIdPista());
			$hor->setDisponibilidad($disponible);
			$hor->setFecha($_POST["fecha"]);
			$this->establecerPistasMapper->insertarHorario($hor);
			$this->view->setFlash("Operación realizada");

		}




	}

}
