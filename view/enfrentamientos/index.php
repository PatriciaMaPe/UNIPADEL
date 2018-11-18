<?php
//file: view/enfrentamientos/index.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$gruposCampeonatos = $view->getVariable("gruposCampeonatos");

//$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Resultados");

?>

<!-- Enfrentamientos -->
<div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Campeonato</th>
      <th scope="col">Categoria</th>
      <th scope="col">Tipo</th>
      <th scope="col">Nivel</th>
      <th scope="col">Liga</th>
      <th scope="col">Grupo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($gruposCampeonatos as $grupo): ?>
      <tr>
        <!-- col enfrentamiento -->
        <td> <?= $grupo->getCampeonato()->getIdCampeonato(); ?></td>
        <!-- col pareja -->
        <td> <?= $grupo->getCategoria()->getIdCategoria();?></td>
        <!-- col resultado -->
        <td><?= $grupo->getCategoria()->getTipo(); ?> </td>
        <td><?= $grupo->getCategoria()->getNivel(); ?> </td>
        <td><?= $grupo->getTipoLiga(); ?> </td>
        <td><?= $grupo->getIdGrupo(); ?> </td>

      <td>


        <a href="index.php?controller=enfrentamiento&amp;action=view&amp;id=<?= $grupo->getIdGrupo(); ?>&amp;liga=<?= $grupo->getTipoLiga(); ?>">Consultar</a>
        <a href="index.php?controller=enfrentamiento&amp;action=generarEnfrentamientos&amp;id=<?= $grupo->getIdGrupo(); ?>&amp;liga=<?= $grupo->getTipoLiga(); ?>">Enfrentar</a>
        <a href="index.php?controller=enfrentamiento&amp;action=generarRanking&amp;id=<?= $grupo->getIdGrupo(); ?>&amp;liga=<?= $grupo->getTipoLiga(); ?>">Ranking</a>

      </td>

      </tr>
        <?php endforeach; ?>

  </tbody>

  </table>
