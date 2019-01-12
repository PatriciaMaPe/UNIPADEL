<?php
//file: view/enfrentamientos/index.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$enfrentamientosPareja = $view->getVariable("enfrentamientosPareja");
$reservas = $view->getVariable("reservasEnfrentamiento");

$view->setVariable("title", "Enfrentamientos");

$currentuser = $_SESSION["currentuser"];
$currenttype = $_SESSION["currenttype"];

?>

<!-- Enfrentamientos -->
<div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Enfrentamiento</th>
      <th scope="col">Pareja</th>
      <th scope="col">Resultado</th>
      <th scope="col">Grupo</th>
      <th scope="col">Liga</th>
      <th scope="col">Pista</th>
    </tr>
  </thead>

  <tbody>
		  <?php $reserva=0; ?>
    <?php foreach ($enfrentamientosPareja as $enfrentamiento): ?>
      <tr>
        <!-- col enfrentamiento -->
        <td> <?= $enfrentamiento->getIdEnfrentamiento(); ?></td>
        <!-- col pareja -->
        <td> <?= $enfrentamiento->getPareja1()->getIdPareja();?></td>
        <!-- col resultado -->
        <td><?= $enfrentamiento->getResultado(); ?> </td>
        <td><?= $enfrentamiento->getGrupo()->getIdGrupo(); ?> </td>
        <td><?= $enfrentamiento->getGrupo()->getTipoLiga(); ?> </td>

      <td>

					<?php if($reservas[$reserva]->getIdEnfrentamiento() == $enfrentamiento->getIdEnfrentamiento()): ?>
							<?= $reservas[$reserva]->getIdReserva(); ?>
						<?php else: ?>
							<a href="index.php?controller=gestionarReservas&amp;action=acordarReserva">Reservar</a>
					<?php endif; ?>
      </td>

      </tr>
			<?php $reserva++; ?>
        <?php endforeach; ?>

  </tbody>

  </table>

</main>

</body>
</html>
