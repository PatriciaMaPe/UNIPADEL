<?php
//file: view/enfrentamientos/index.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$posiblesReservas = $view->getVariable("posiblesReservas");

$view->setVariable("title", "Elegir reserva");

$currentuser = $_SESSION["currentuser"];
$currenttype = $_SESSION["currenttype"];

?>

<!-- Enfrentamientos -->
<div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Enfrentamiento</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fecha</th>
      <th scope="col">Hora inicio</th>
      <th scope="col">Hora fin</th>
      <th scope="col">Pista</th>
    </tr>
  </thead>

  <tbody>

    <?php foreach ($posiblesReservas as $reserva): ?>
      <tr>
        <td> <?= $reserva->getIdEnfrentamiento(); ?></td>
        <td> <?= $reserva->getUsuario()->getUsuario(); ?></td>
        <td> <?= $reserva->getFecha(); ?> </td>
        <td> <?= $reserva->getHoraInicio(); ?> </td>
        <td> <?= $reserva->getHoraFin(); ?> </td>
        <td> <?= $reserva->getPistaidPista(); ?> </td>

      <td>
				<a href="index.php?controller=acordarReservas&amp;action=finalizarAcuerdo&amp;
        idEnfrentamiento=<?= $reserva->getIdEnfrentamiento(); ?>&amp;
        usuario=<?= $reserva->getUsuario()->getUsuario(); ?>&amp;
        fecha=<?= $reserva->getFecha(); ?>&amp;
        horaInicio=<?= $reserva->getHoraInicio(); ?>&amp;
        horaFin=<?= $reserva->getHoraFin(); ?>&amp;
        pista=<?= $reserva->getPistaidPista(); ?>">Elegir</a>
      </td>

      </tr>
    <?php endforeach; ?>

  </tbody>

  </table>

</main>

</body>
</html>
