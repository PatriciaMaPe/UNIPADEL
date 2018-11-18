<?php
//file: view/enfrentamientos/index.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$lastInsert = $view->getVariable("lastInsert");

if ($lastInsert == NULL){
  echo "NULL";
}else{
  echo "wiii";
}

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
      <th scope="col">Grupo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($lastInsert as $insert): ?>
      <tr>
        <!-- col enfrentamiento -->
        <td> <?= $insert->getIdPareja(); ?></td>
        <td> Hola </td>

      <td>
        <a class="add" title="Add" data-toggle="tooltip">Add</a>
      </td>

      </tr>
        <?php endforeach; ?>

  </tbody>

  </table>
