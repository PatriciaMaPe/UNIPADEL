<?php
//file: view/clasificacion/index.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$clasificaciones = $view->getVariable("clasificacion");

//$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Clasificacion");

?>

<!-- Clasificacion -->
<div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Pareja</th>
      <th scope="col">Resultado</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($clasificaciones as $clasificacion): ?>
      <tr>
        <td> <?= $clasificacion->getPareja()->getIdPareja(); ?></td>
        <td> <?= $clasificacion->getResultado();?></td>
      </tr>
    <?php endforeach; ?>

  </tbody>

  </table>
