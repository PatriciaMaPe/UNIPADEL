	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "unipadelbd";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$pista=$_POST["pista"];
	$hora=$_POST["hora"];
	$fecha=$_POST["fecha"];
	$horaFin=$_POST["horaFin"];
	$disponibilidad=$_POST["disponibilidad"];
	require 'comprobarReserva.php';
	//Realizar Reserva
	if($disponibilidad=='disponible'){
		$disponibilidad='ocupado';
		$sql = "INSERT INTO reserva (PistaidPista,horaInicio,fecha,horaFin,disponibilidad) VALUES ('$pista','$hora','$fecha','$horaFin','$disponibilidad')";
		$sql2 = "UPDATE horario SET disponibilidad='$disponibilidad' WHERE idPista='$pista' AND horario='$hora' AND fecha='$fecha'";
	}
	//Cancelar Reserva
	else if($disponibilidad=='ocupado'){
		$disponibilidad='disponible';

		$sql = "DELETE FROM reserva WHERE PistaidPista='$pista' AND horaInicio='$hora' AND fecha='$fecha'";
		$sql2 = "UPDATE horario SET disponibilidad='$disponibilidad' WHERE idPista='$pista' AND horario='$hora' AND fecha='$fecha'";	

	}else{
		echo "No se puede reservar en esta hora";
	}	
	if ($conn->query($sql) === TRUE) {
		echo ' Operación realizada';
		
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
		if ($conn->query($sql2) === TRUE) {
		echo ' Operación realizada';
		header('Location: gestionarReservas.php');
	} else {
		echo "Error: " . $sql2 . "<br>" . $conn->error;
	}
	?>