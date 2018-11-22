<link href="estilo.css"
      rel="stylesheet" type="text/css">
<html lang="es-ES">
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
	
?>
<html>
<!--Seccion para el menu-->
	<section>
		<nav class="menu">
			<ul>
				<!-- Lista con las opciones que va tener el menú -->
				<li><a>UNIPADEL</a></li>
				<li><a>Reservas</a></li>
				<li><a>Campeonatos</a></li>
				<li><a>Pistas</a></li>
			</ul>
		</nav>
	</section>
	<table>
		<tr><th>Fecha</th><td><?echo $fecha;?></td></tr>
		<tr><th>Pista</th><td><?echo $pista;?></td></tr>
		<tr><th>Hora inicio</th><td><?echo $hora;?></td></tr>
		<tr><th>Hora fin</th><td><?echo $horaFin;?>:00</td></tr>
	</table>
	<form method="POST" action="realizarReserva.php">
		<input type="hidden" name="fecha" id="fecha" value="<?echo $fecha;?>">
		<input type="hidden" name="pista" id="pista" value="<?echo $pista;?>">
		<input type="hidden" name="hora" id="hora" value="<?echo $hora;?>">
		<input type="hidden" name="horaFin" id="horaFin" value="<?echo $horaFin;?>">
		<input type="hidden" name="disponibilidad" id="disponibilidad" value="<?echo $disponibilidad;?>">
		<a href="gestionarReservas.php"><button type="button" >Volver</button></a>
		<?
		if($disponibilidad=='disponible'){
			?>
			<input type="submit" value="Reservar">
			<?
		}else if($disponibilidad=='ocupado'){
			?>
			<input type="submit" value="Cancelar">
			<?
		}else{
			?>
			<input type="hidden" value="No Disponible">
			<?
		}
		?>
	</form>
<html>				