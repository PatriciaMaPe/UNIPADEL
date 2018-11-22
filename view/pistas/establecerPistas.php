<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();
$view->setVariable("title", "Establecer horarios y pistas");
?>

	<h1> Establecer horarios y pistas</h1>
	<form action="index.php?controller=establecerPistas&amp;action=anadirPista" method="POST">
	<table class="table">
				<thead><tr><th>Escoger Fecha</th><th>Crear pista</tr></thead>
				<tbody><tr><td><input type="date" name="fecha"></td>

	
					
					<td><input type="number" name="pista" min="1" max="50" value="<?= $pista?>"></td>

				</tbody>
			</table>

			<table class="table">
				<thead><tr><th >Establecer horarios</th></tr></thead>
				<tbody>
					<tr><td><label> Inicio:  00:00</td><td> Fin:    01:30 </label> </td><td> <input type="checkbox" name="cero" value="00:00:00"></td></tr>
					<tr><td><label> Inicio:  01:30</td><td> Fin:    03:00 </label> </td><td> <input type="checkbox" name="uno" value="01:30:00"></td></tr>
					<tr><td><label> Inicio:  03:00</td><td> Fin:    04:30 </label> </td><td> <input type="checkbox" name="tres" value="03:00:00"></td></tr>
					<tr><td><label> Inicio:  04:30</td><td> Fin:    06:00 </label> </td><td> <input type="checkbox" name="cuatro" value="04:30:00"></td></tr>
					<tr><td><label> Inicio:  06:00</td><td> Fin:    07:30 </label> </td><td> <input type="checkbox" name="seis" value="06:00:00"></td></tr>
					<tr><td><label> Inicio:  07:30</td><td> Fin:    09:00 </label> </td><td> <input type="checkbox" name="siete" value="07:30:00"></td></tr>
					<tr><td><label> Inicio:  09:00</td><td> Fin:    10:30 </label> </td><td> <input type="checkbox" name="nueve" value="09:00:00"></td></tr>
					<tr><td><label> Inicio:  10:30</td><td> Fin:    12:00 </label> </td><td> <input type="checkbox" name="diez" value="10:30:00"></td></tr>
					<tr><td><label> Inicio:  12:00</td><td> Fin:    13:30 </label> </td><td> <input type="checkbox" name="doce" value="12:00:00"></td></tr>
					<tr><td><label> Inicio:  13:30</td><td> Fin:    15:00 </label> </td><td> <input type="checkbox" name="trece" value="13:30:00"></td></tr>
					<tr><td><label> Inicio:  15:00</td><td> Fin:    16:30 </label> </td><td> <input type="checkbox" name="quince" value="15:00:00"></td></tr>
					<tr><td><label> Inicio:  16:30</td><td> Fin:    18:00 </label> </td><td> <input type="checkbox" name="dieciseis" value="16:30:00"></td></tr>
					<tr><td><label> Inicio:  18:00</td><td> Fin:    19:30 </label> </td><td> <input type="checkbox" name="dieciocho" value="18:00:00"></td></tr>
					<tr><td><label> Inicio:  19:30</td><td> Fin:    21:00 </label> </td><td> <input type="checkbox" name="diecinueve" value="19:30:00"></td></tr>
					<tr><td><label>	Inicio:  21:00</td><td> Fin:    22:30 </label> </td><td> <input type="checkbox" name="veintiuna" value="21:00:00"></td></tr>
					<tr><td><label> Inicio:  22:30</td><td> Fin:    00:00 </label> </td><td> <input type="checkbox" name="veintidos" value="22:30:00"></td></tr>
				</tbody>
			</table>
			<input type="submit" value="Enviar">
		</form>

