<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view=ViewManager::getInstance();
$view->setVariable("title", "Acordar reservas");
$fecha=$view->getVariable("fecha");
$idEnfrentamiento=$view->getVariable("idEnfrentamiento");
$anterior=0;
?>


	<!--Página reservar pista-->
	<h1>Reservar pista enfrentamiento: <?= $idEnfrentamiento; ?> </h1>


	<!-- SECCION DE LA LEYENDA DE ETIQUETAS-->
	<section>
			<table class="table" >
			<thead><tr><th>Etiquetas</th></tr></thead>
			<tbody><tr>
				<td style="border:solid;background-color:green;color:black;">Disponible</td>
				<td style="border:solid;background-color:blue;color:black;">Libre</td>
				<td style="border:solid;background-color:red;color:black;">Ocupado</td>
			</tr></tbody>
			</table>

	</section>


	<!-- SECCION DE LAs PISTAS-->
	<section>

							<table class="table" >
							<thead><tr><th>Escoge Fecha</th></tr></thead>


									<form  action="index.php?controller=gestionarReservas&amp;action=acordarPistasFecha&amp;idEnfrent=<?= $idEnfrentamiento; ?>" method="POST">

										<tbody><tr><td><input type="date"  name="fecha" id="fecha" >
										<input type="submit" name="ver" value="Ver pistas"></td></tr></tbody></table>
                  </form>

                  <?php if($fecha!=NULL):?>
                    <form  action="index.php?controller=acordarReservas&amp;action=addPosiblesReservas&amp;idEnfrent=<?= $idEnfrentamiento; ?>" method="POST">
                    <table class="table">
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
												if($pista->getNumInscritos()=='' ||$pista->getNumInscritos()=='0'){
													?>
													<td>
                          <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-success">
                          <input style="border:solid;background-color:green;color:black;"
                          type="checkbox"
                          name="reservas[]"
                          value="<?= $pista->getFecha();?>/
                                 <?= $pista->getHorarioIdPista();?>/
                                 <?= $pista->getHora();?>/
                                 <?= $pista->getDisponibilidad();?>">


                            <?php echo $pista->getHora(); ?></input>
                            </label>
                          </div>
                          </td>
												<?php
												}else{
													?>

                          <td>
                          <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-danger">
                          <input disabled style="border:solid;background-color:green;color:black;"
                          type="checkbox"
                          name="reservas[]"
                          value="<?= $pista->getFecha(); ?>
                                 <?= $pista->getHorarioIdPista(); ?>
                                 <?= $pista->getHora(); ?>
                                 <?= $pista->getDisponibilidad(); ?>">


                            <?php echo $pista->getHora(); ?></input>
                            </label>
                          </div>
                          </td>
												<?php
                      }
												?>

											<?php
											}else{
											?>
                        <td>
                        <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-danger">
                        <input disabled style="border:solid;background-color:red;color:black;"
                        type="checkbox"
                        name="reservas[]"
                        value="<?= $pista->getFecha(); ?>
                               <?= $pista->getHorarioIdPista(); ?>
                               <?= $pista->getHora(); ?>
                               <?= $pista->getDisponibilidad();?>">


                          <?php echo $pista->getHora(); ?></input>
                          </label>
                        </div>
                        </td>
											<?php
											}
										}
										?>

								</table>

                  <button type="submit" class="btn btn-primary" >Acordar reservas</button>

                </form>
              <?php endif;?>

	</section>
