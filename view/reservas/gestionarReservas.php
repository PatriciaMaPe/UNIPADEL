
<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view= ViewManager::getInstance();
$view->setVariable("title", "Gestionar reservas");
$fecha=$view->getVariable("fecha");
var_dump($view);
?>


	<!--Página reservar pista-->
	<h1>Reservar pista</h1>
	<div class="table-responsive">
	  <table class="table">

	  <thead>
	    <tr>
	      <th> Parejas </th>
	      <?php foreach ($parejas as $pareja): ?>
	        <th scope="col"> <?= htmlentities($pareja->getIdPareja()) ?> </th>
	      <?php endforeach; ?>
	      <th>Resultado</th>
	      <th> Acciones </th>
	    </tr>
	  </thead>


	<section>

					<div class="row justify-content-md-center">
						<div class="panel panel-primary col-xl-5" id="panel">
							<div class="panel-heading">Escoge Fecha</div>
							<div class="panel-body">
									<form  action="../index.php?controller=GestionarReservas&amp;action=verPistasFecha" method="POST">
										<label> Fecha: </label><input type="date"  name="fecha" id="fecha" >
										<input type="hidden" name="idPista" value="" >
										<input type="submit" name="ver" value="Ver pistas" >
									</form>

							</div>
						</div>
					</div>




	</section>
