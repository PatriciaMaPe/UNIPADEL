<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");
require_once(__DIR__."/../model/establecerPistas.php");
require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/RealizarReserva.php");

/**
*
*
* @author Victor
*/
class RealizarReservaMapper {

	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function insertarReserva(RealizarReserva $reserva , $fecha,$hora,$pista,$num,$finInscripcion) {
		
		
			
		 	if($num==2){//ESTE IF PARA SABER SI NUM INSCRITOS ES IGUAL, SI LO ES INSERTA LA RESERVA Y SE PONE A CERO
		 		
				$stmt = $this->db->prepare("INSERT INTO Reserva (fecha,PistaidPista,horaInicio,horaFin,disponibilidad,UsuarioRegistradousuario) VALUES (?,?,?,?,?,?)");
				$stmt->execute(array($reserva->getFecha(),$reserva->getPistaidPista(),$reserva->getHoraInicio(),$reserva->getHoraFin(),'ocupado',$reserva->getUsuarioRegistradousuario()));
				
				
				$stmt6 = $this->db->prepare("UPDATE Horario SET disponibilidad='ocupado' WHERE fecha='".$fecha."' AND horario='".$hora."' AND idPista='".$pista."'");
				$stmt6->execute();
				$num++;
		 		$stmt6 = $this->db->prepare("UPDATE Horario SET numInscritos='".$num."' WHERE fecha='".$fecha."' AND horario='".$hora."' AND idPista='".$pista."'");
				$stmt6->execute();
				

		 		
		 	}else if($num==0){//SI NO SE ACTUALIZA EL VALOR NUM INSCRITOS 
		 		
		 		$num++;
		 		$stmt = $this->db->prepare("INSERT INTO Partido (fecha,horaInicio,horaFin,pista,finInscripcion) VALUES (?,?,?,?,?)");
				$stmt->execute(array($reserva->getFecha(),$reserva->getHoraInicio(),$reserva->getHoraFin(),$reserva->getPistaidPista(),$reserva->getFinInscripcion()));
				$stmt6 = $this->db->prepare("UPDATE Horario SET numInscritos='".$num."' WHERE fecha='".$fecha."' AND horario='".$hora."' AND idPista='".$pista."'");
				$stmt6->execute();
			
		 	}else{
		 		$num++;
		 		$stmt6 = $this->db->prepare("UPDATE Horario SET numInscritos='".$num."' WHERE fecha='".$fecha."' AND horario='".$hora."' AND idPista='".$pista."'");
				$stmt6->execute();
				
		 	}
		 	return $this->db->lastInsertId();
		
	}

	public function cancelarInscripcion(RealizarReserva $reserva,$fecha,$hora,$pista,$num) {

		if($num < 3 && $num > 0){
			$num--;
			$stmt7 = $this->db->prepare("UPDATE Horario SET numInscritos='".$num."' WHERE fecha='".$fecha."' AND horario='".$hora."' AND idPista='".$pista."'");
			$stmt7->execute();
		}else{
			echo "No hay personas inscritas, no se puede cancelar la inscripción";
		}
	}
	public function cancelarReserva(RealizarReserva $reserva,$fecha,$hora,$pista,$num) {
		
		/*CANCELAR UNA RESERVA*/

			$stmt = $this->db->prepare("DELETE FROM Reserva WHERE PistaidPista=? AND horaInicio=? AND fecha=?");
			$stmt->execute(array($reserva->getPistaidPista(),$reserva->getHoraInicio(),$reserva->getFecha()));
			$stmt6 = $this->db->prepare("UPDATE Horario SET disponibilidad='disponible' WHERE fecha='".$fecha."' AND horario='".$hora."' AND idPista='".$pista."'");
			$stmt6->execute();
			$num=0;
			$stmt7 = $this->db->prepare("UPDATE Horario SET numInscritos='".$num."' WHERE fecha='".$fecha."' AND horario='".$hora."' AND idPista='".$pista."'");

			$stmt7->execute();
		
		
	}
	



}
