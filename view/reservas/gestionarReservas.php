<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view=ViewManager::getInstance();
$view->setVariable("title", "Gestionar reservas");
$fecha=$view->getVariable("fecha");
$anterior=0;
?>

 
	<!--Página reservar pista-->
	<h1>Reservar pista</h1>

   
	<!-- SECCION DE LA LEYENDA DE ETIQUETAS-->	
	<section>
			<table class="table" >
			<thead><tr><th>Etiquetas</th></tr></thead>
			<tbody><tr><td style="border:solid;background-color:green;color:black;">Disponible</td>
			<td style="border:solid;background-color:red;color:black;">Ocupado</td></tr></tbody>
			</table>
 
	</section>

 
	<!-- SECCION DE LAs PISTAS-->	
	<section>
					
							<table class="table" >
							<thead><tr><th>Escoge Fecha</th></tr></thead>
							
								
									<form  action="index.php?controller=gestionarReservas&amp;action=verPistasFecha" method="POST">
										<tbody><tr><td><input type="date"  name="fecha" id="fecha" >
										<input type="submit" name="ver" value="Ver pistas"></td></tr></tbody></table>
										<table class="table" >
										<?php 
										foreach($fecha as $pista){
											if($anterior!=$pista->getHorarioIdPista()){
												?>
												<thead><tr><th>Pista: <?php echo $pista->getHorarioIdPista();?></th></tr></thead>
												
												<?php 
												$anterior=$pista->getHorarioIdPista();
											}
											?>
											<?php
											if($pista->getDisponibilidad()=='disponible'){
												?>
												<td><a style="border:solid;background-color:green;color:black;" href="index.php?controller=gestionarReservas&amp;action=comprobarReserva&amp;fecha=<?= $pista->getFecha(); ?>&amp;
												pista=<?= $pista->getHorarioIdPista(); ?>&amp;hora=<?= $pista->getHora(); ?>&amp;
												disponibilidad=<?= $pista->getDisponibilidad();?>&amp;
												numInscritos=<?= $pista->getNumInscritos();?>"><?php echo $pista->getHora(); ?></a></td>

											<?php
											}else{
											?>
												<td><a style="border:solid;background-color:red;color:black;" href="index.php?controller=gestionarReservas&amp;action=comprobarReserva&amp;fecha=<?= $pista->getFecha(); ?>&amp;
												pista=<?= $pista->getHorarioIdPista(); ?>&amp;hora=<?= $pista->getHora(); ?>&amp;
												disponibilidad=<?= $pista->getDisponibilidad();?>&amp;
												numInscritos=<?= $pista->getNumInscritos();?>"><?php echo $pista->getHora(); ?></a></td>
											<?php
											}	
										}
										?>
									</form>
								</table>			
				
	</section>


