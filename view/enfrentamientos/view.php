<?php
//file: view/enfrentamientos/view.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

//$enfren = $view->getVariable("enfrentamientos");
$enfrenParejas = $view->getVariable("enfrentamientosParejas"); //array con enfrentamientos por parejas
var_dump($enfrenParejas);

$parejas = $view->getVariable("parejas");
//$currentuser = $view->getVariable("currentusername");
$view->setVariable("title", "Enfrentamientos");

if($enfrenParejas==null){
  echo "null";
}
?>

<!-- Enfrentamientos -->
<div class="table-responsive">
  <table class="table">

  <thead>
    <tr>
      <th> Parejas </th>
      <?php foreach ($parejas as $pareja): ?>
        <th scope="col"> <?= htmlentities($pareja->getIdPareja()) ?> </th>
      <?php endforeach; ?>
      <th> Acciones </th>
    </tr>
  </thead>

  <tbody>
    <?php $contPareja=0; ?>

    <?php foreach ($enfrenParejas as $enfrentamientoPareja): ?>
      <tr>
        <?php $contColumna=0; ?>
        <td> <?= $parejas[$contPareja]->getIdPareja(); ?> </td>
        <!-- col resultado -->
        <?php foreach ($enfrentamientoPareja as $enfrentamiento): ?>
            <?php if($enfrentamiento->getPareja1()->getIdPareja() == $enfrentamiento->getPareja2()->getIdPareja()): ?>
              <td><?= $enfrentamiento->getPareja1()->getIdPareja(); ?></td>
            <?php else: ?>
              <td><?= $enfrentamiento->getSet1(); ?></td>
            <?php endif; ?>
            <?php $contColumna++;?>

      <?php endforeach; ?>

      <?php $contPareja++;?>
      <td>
        <a class="add" title="Add" data-toggle="tooltip">Add</a>
        <a class="edit" title="Edit" data-toggle="tooltip">Edit</a>
      </td>
        </tr>

    <?php endforeach; ?>
  </tbody>

  </table>
