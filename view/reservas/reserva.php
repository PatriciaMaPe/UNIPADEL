<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view=ViewManager::getInstance();
$view->setVariable("title", "Gestionar reservas");


?>

	<section>

					<table class="table" >
				
							<thead><tr><th>Datos reserva<th></tr></thead>
								
								<form method="POST" action="index.php?controller=RealizarReserva&amp;action=anadirReserva">
									<tbody>
									<tr><th>Pista</th><td> <input style="border:none" type="text" name="pista" value="<?= $view->getVariable("pista");?>" readonly></td></tr>
									<tr><th>Hora Inicial</th><td> <input style="border:none" type="text" name="hora" value="<?= $view->getVariable("hora");?>" readonly></td></tr>
									<tr><th>Fecha</th><td> <input style="border:none" type="text" name="fecha" value="<?= $view->getVariable("fecha");?>" readonly></td></tr>
									<tr><th>Hora Final</th><td> <input style="border:none" type="text" name="horaFinal" value="<?= $view->getVariable("horaFinal");?>:00" readonly></td></tr>
									<tr><th></th><td> <input style="border:none" type="hidden" name="disponibilidad" value="<?= $view->getVariable("disponibilidad");?>" readonly></td></tr>
									</tbody></table>
									<a href="index.php?controller=RealizarReserva"><button type="button" >Volver</button></a>
									<?if($view->getVariable("disponibilidad")=='disponible'){?>
										<input type="submit" name="reservar" value="Reservar" >
									<?}else{
											?><input type="submit" name="cancelar" value="Cancelar" >
									<?}?>
									
									
									
								</form>
								<td></tr></tbody>
							
					</table>
		
							
					
				
	</section>