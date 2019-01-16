<?php
//file: view/enfrentamientos/index.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$enfrentamientosPareja = $view->getVariable("enfrentamientosPareja");

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
      <th scope="col">Pareja 1</th>
      <th scope="col">Pareja 2</th>
      <th scope="col">Resultado</th>
      <th scope="col">Grupo</th>
      <th scope="col">Liga</th>
      <th scope="col">Pista</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($enfrentamientosPareja as $enfrentamiento):


        if($enfrentamiento[0]->getPareja1()->getIdPareja() != $enfrentamiento[0]->getPareja2()->getIdPareja()):
      ?>
        <tr>
          <!-- col enfrentamiento -->
          <td> <?= $enfrentamiento[0]->getIdEnfrentamiento(); ?></td>
          <!-- col pareja -->
          <td> <?= $enfrentamiento[0]->getPareja1()->getIdPareja();?></td>
          <td> <?= $enfrentamiento[0]->getPareja2()->getIdPareja();?></td>
          <!-- col resultado -->
          <td><?= $enfrentamiento[0]->getResultado(); ?> </td>
          <td><?= $enfrentamiento[0]->getGrupo()->getIdGrupo(); ?> </td>
          <td><?= $enfrentamiento[0]->getGrupo()->getTipoLiga(); ?> </td>

          <td>

    					<?php if($enfrentamiento[1] != NULL): ?>
    							<?= $enfrentamiento[1]; ?>
    					<?php elseif($enfrentamiento[2]!=NULL): ?>
                  <a href="index.php?controller=acordarReservas&amp;action=acordarReserva&amp;enfrentamiento=<?= $enfrentamiento[0]->getIdEnfrentamiento(); ?>">Propuesta</a>
              <?php
                elseif(
                  $enfrentamiento[0]->getPareja1()->getCapitan()->getUsuario() == $currentuser ||
                  $enfrentamiento[0]->getPareja2()->getCapitan()->getUsuario() == $currentuser
                ):
              ?>
    							<a href="index.php?controller=acordarReservas&amp;action=acordarReserva&amp;enfrentamiento=<?= $enfrentamiento[0]->getIdEnfrentamiento(); ?>">Reservar</a>

    					<?php else: ?>
              <?= "Pendiente" ?>
              <?php endif; ?>
          </td>

        </tr>
    <?php
        endif;
      endforeach;
    ?>

  </tbody>

  </table>

</main>

</body>
</html>
