<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view=ViewManager::getInstance();
$view->setVariable("title", "Gestionar reservas");

$reserva = $view->getVariable("reserva");

?>

	<section>

					<table class="table" >

							<thead><tr><th>Datos de la reserva<th></tr></thead>

								<form method="POST" action="index.php?controller=RealizarReserva&amp;action=anadirReserva">
									<tbody>

									<tr><th>Usuario</th><td> <input style="border:none" type="text" name="usuario" value="<?= $reserva['UsuarioRegistradousuario']?>" readonly></td></tr>

									<tr><th>Pista</th><td> <input style="border:none" type="text" name="pista" value="<?= $reserva['PistaidPista']; ?>" readonly></td></tr>
									<tr><th>Hora Inicial</th><td> <input style="border:none" type="text" name="hora" value="<?= $reserva['horaInicio'];?>" readonly></td></tr>
									<tr><th>Hora Final</th><td> <input style="border:none" type="text" name="horaFinal" value="<?= $reserva['horaFin']; ?>" readonly></td></tr>
									<tr><th>Fecha</th><td> <input style="border:none" type="text" name="fecha" value="<?= $reserva['fecha']; ?>" readonly></td></tr>

									
									<tr><th></th><td> <input style="border:none" type="hidden" name="disponibilidad" value="<?= $view->getVariable("disponibilidad");?>" readonly></td></tr>

									</tbody></table>

								</form>
								<td></tr></tbody>

					</table>




	</section>
