<?php
//file: view/enfrentamientos/view.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$enfrenParejas = $view->getVariable("enfrentamientosParejas"); //array con enfrentamientos por parejas
$parejas = $view->getVariable("parejas");
$idGrupo = $view->getVariable("idGrupo");
$tipoLiga = $view->getVariable("tipoLiga");
$view->setVariable("title", "Enfrentamientos");


?>
<div class="row justify-content-md-center">
  <h5>Grupo:</h5>
  <h5><?= $idGrupo ?></h5>
</div>
<div class="row justify-content-md-center">
  <h5>Liga:</h5>
  <h5><?= $tipoLiga ?></h5>
</div>


<!-- Enfrentamientos -->
<div class="table-responsive">
  <table class="table">

  <thead>
    <tr>
      <th> # </th>
      <th> Parejas </th>
      <?php foreach ($parejas as $pareja): ?>
        <th scope="col"><?= $pareja->getCapitan()->getUsuario() ?>-<?= $pareja->getDeportista()->getUsuario() ?> </th>
      <?php endforeach; ?>
    </tr>
  </thead>

  <tbody>
    <?php $contPareja=0; ?>

    <?php foreach ($enfrenParejas as $enfrentamientoPareja): ?>
      <tr>
        <?php $contColumna=0; ?>
        <td> <?= $parejas[$contPareja]->getIdPareja(); ?></td>

        <td> <?= $parejas[$contPareja]->getCapitan()->getUsuario(); ?> <br> <?= $parejas[$contPareja]->getDeportista()->getUsuario(); ?></td>
        <!-- col resultado -->
        <?php foreach ($enfrentamientoPareja as $enfrentamiento): ?>
            <?php if($enfrentamiento->getPareja1()->getIdPareja() == $enfrentamiento->getPareja2()->getIdPareja()): ?>
              <td></td>
            <?php else: ?>

                <td>
                  <a data-target="#exampleModal" data-toggle="modal"
                  data-pareja1="<?= $enfrentamiento->getPareja1()->getIdPareja() ?>"
                  data-pareja2="<?= $enfrentamiento->getPareja2()->getIdPareja() ?>"
                  data-set1="<?= $enfrentamiento->getSet1(); ?>"
                  data-set2="<?= $enfrentamiento->getSet2(); ?>"
                  data-set3="<?= $enfrentamiento->getSet3(); ?>"
                  data-grupo="<?= $idGrupo ?>"
                  data-liga="<?= $tipoLiga ?>"
                  >
                  <?= $enfrentamiento->getSet1(); ?> /
                  <?= $enfrentamiento->getSet2(); ?> /
                  <?= $enfrentamiento->getSet3(); ?>
                  </a>
                </td>

              <?php endif; ?>
            <?php $contColumna++;?>

      <?php endforeach; ?>

      <?php $contPareja++;?>

        </tr>


    <?php endforeach; ?>


      </tbody>

      </table>

    <!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Titulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php?controller=enfrentamiento&amp;action=modificarResultados" method="POST">

          <div class="form-group">
            <div class="form-row">
              <div class="col">
            <label for="message-text" class="col-form-label">Pareja:</label>
            <input id="pareja1" type="text" name="pareja1" class="form-control-plaintext" readonly>
          </div>
          <div class="col">
            <label for="message-text" class="col-form-label">Pareja:</label>
            <input id="pareja2" type="text" name="pareja2" class="form-control-plaintext" readonly>
          </div>
          </div>
            <label for="message-text" class="col-form-label">Set1:</label>
            <input id="set1" name="set1" type="text" class="form-control">

            <label for="message-text" class="col-form-label">Set2:</label>
            <input id="set2" name="set2" type="text" class="form-control">

            <label for="message-text" class="col-form-label">Set3:</label>
            <input id="set3" name="set3" type="text" class="form-control">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Modificar resultados</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- !Modal -->
