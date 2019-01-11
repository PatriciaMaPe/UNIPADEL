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
	public function comprobarMisReservas() {
		$reserva = new RealizarReserva();
		$user = $_SESSION["currentuser"];
		$usuario= $this->RealizarReservaMapper->misReservas($user);
		
		$this->view->setVariable("UsuarioRegistradousuario", $usuario, false);
		
		$this->view->render("reservas", "misReservas");
		
		
	}

	
	public function anadirReserva() {
			$reserva = new RealizarReserva();
			// populate the Post object with data form the form
			$pista=$_REQUEST["pista"];
			$num=$_REQUEST["numInscritos"];
			$hora=$_REQUEST["hora"];
			$horaFin=$_REQUEST["horaFinal"];
			$fecha=$_REQUEST["fecha"];
			$disponibilidad=$_REQUEST["disponibilidad"];
			$fin=$_REQUEST["finInscripcion"];
			
			$usuario=$_REQUEST["usuario"];
			$reserva->setPistaIdPista($pista);
			$reserva->setHoraInicio($hora);
			$reserva->setHoraFin($horaFin);
			$reserva->setFecha($fecha);
			$reserva->setUsuarioRegistradoUsuario($usuario);
			$reserva->setFinInscripcion($fin);
			

			
			
			$hoy = date ( 'Y/m/d');
		
			
				//Si viene de darle a inscribirse
				if(isset($_REQUEST["inscripcion"])){
					if($hoy<=$fin){
						$this->RealizarReservaMapper->insertarReserva($reserva,$fecha,$hora,$pista,$num,$fin);
						echo 'Operación realizada';
						
					}else{
						echo 'No se puede realizar más inscripciones';
					}
				
				}else if(isset($_REQUEST["desinscribirse"])){//Si viene de darle a desinscribirse
					if($hoy<=$fin){
						$this->RealizarReservaMapper->cancelarInscripcion($reserva,$fecha,$hora,$pista,$num);
						echo 'Operación realizada';
					}else{
						echo 'No se puede cancelar la inscripción';
					}
						
			
					
				}else{//Si viene de darle a cancelar Reserva
					$fechafin = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
					$fechafin = date ( 'Y/m/d' , $fechafin );
					
					if($hoy<=$fechafin){
						$this->RealizarReservaMapper->cancelarReserva($reserva,$fecha,$hora,$pista,$num);
						echo 'Operación realizada';
					}else{
						echo 'No se puede cancelar la reserva';
					}
				}

			$this->view->render("reservas", "gestionarReservas");
			

	}


}
?>