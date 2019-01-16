<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view=ViewManager::getInstance();
$view->setVariable("title", "Gestionar reservas");


?>

	<section>

					<table class="table" >
				
							<thead><tr><th>Datos<th></tr></thead>
								
								<form method="POST" action="index.php?controller=RealizarReserva&amp;action=anadirReserva">
									<tbody>
									
										<tr><th>Usuario</th><td> <input style="border:none" type="text" name="usuario" value="<?= $_SESSION["currentuser"];?>" readonly></td></tr>
									
									<tr><th>Pista</th><td> <input style="border:none" type="text" name="pista" value="<?= $view->getVariable("pista");?>" readonly></td></tr>
									<tr><th>Hora Inicial</th><td> <input style="border:none" type="text" name="hora" value="<?= $view->getVariable("hora");?>" readonly></td></tr>
									<tr><th>Hora Final</th><td> <input style="border:none" type="text" name="horaFinal" value="<?= $view->getVariable("horaFinal");?>:00" readonly></td></tr>
									<tr><th>Fecha del partido</th><td> <input style="border:none" type="text" name="fecha" value="<?= $view->getVariable("fecha");?>" readonly></td></tr>
									<?php
										$fecha = $view->getVariable("fecha");
										$nuevafecha = strtotime ( '-7 day' , strtotime ( $fecha ) ) ;
										$nuevafecha = date ( 'Y/m/d' , $nuevafecha );
										
									?>
									<tr><th>Fin inscripciones</th><td> <input style="border:none" type="text" name="finInscripcion" <?php echo "value='".$nuevafecha."'";?> readonly></td></tr>
									

									<tr><th>Numero Inscritos</th><td> <input style="border:none" type="text" name="numInscritos" value="<?= $view->getVariable("numInscritos");?>" readonly></td></tr>

									
									
								
									<tr><th></th><td> <input style="border:none" type="hidden" name="disponibilidad" value="<?= $view->getVariable("disponibilidad");?>" readonly></td></tr>


									
									
									
									</tbody></table>

									<a href="index.php?controller=gestionarReservas&amp;action=index"><button type="button" >Volver</button></a>
										<?php
											if($view->getVariable("disponibilidad")!="ocupado"){
										?>
												<input type="submit" name="inscripcion" value="Inscribirse" >
												<input type="submit" name="desinscribirse" value="Cancelar Inscripcion" >
											
												<input type="submit" name="reservar" value="Reservar" >
										<?php
											}
										?>	
										
									
									
									
									
								</form>
								<td></tr></tbody>
							
					</table>
		
							
					
				
	</section>