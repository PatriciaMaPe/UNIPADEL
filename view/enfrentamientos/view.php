<?php
//file: view/enfrentamientos/view.php

require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$enfrenParejas = $view->getVariable("enfrentamientosParejas"); //array con enfrentamientos por parejas
$parejas = $view->getVariable("parejas");
$idGrupo = $view->getVariable("idGrupo");
$tipoLiga = $view->getVariable("tipoLiga");
$campeonato = $view->getVariable("campeonato");

$view->setVariable("title", "Enfrentamientos");

$currentuser = $_SESSION["currentuser"];
$currenttype = $_SESSION["currenttype"];

?>
<div class="row justify-content-md-center">
  <h5>Grupo:</h5>
  <h5><?= $idGrupo ?></h5>
</div>
<div class="row justify-content-md-center">
  <h5>Liga:</h5>
  <h5><?= $tipoLiga ?></h5>
</div>

<?php if ($tipoLiga=='regular'): ?>
<!-- Enfrentamientos Regular -->
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
</div>
    <!-- /Enfrentamientos Regular -->




<?php else: ?>



    <!-- Enfrentamientos Resto Ligas -->
    <div class="table-responsive">
      <table class="table">

        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pareja 1</th>
            <th scope="col">#</th>
            <th scope="col">Pareja 2</th>
            <th scope="col">Resultado</th>
          </tr>
        </thead>

      <tbody>
<?php $contPareja=0; ?>
<?php $contPareja2=(sizeof($parejas)-1); ?>
<?php foreach ($enfrenParejas as $enfrentamientos):?>
    <?php foreach ($enfrentamientos as $enfrentamiento):?>
          <tr>

              <td>  <?= $enfrentamiento->getPareja1()->getIdPareja() ?></td>
                <td>  <?= $parejas[$contPareja]->getCapitan()->getUsuario() ?>
                <br> <?= $parejas[$contPareja]->getDeportista()->getUsuario() ?></td>
              <td>  <?= $enfrentamiento->getPareja2()->getIdPareja() ?></td>
              <td>  <?= $parejas[$contPareja2]->getCapitan()->getUsuario() ?>
              <br> <?= $parejas[$contPareja2]->getDeportista()->getUsuario() ?></td>
              <td>
                    <a data-target="#exampleModal" data-toggle="modal"
                      data-pareja1="<?= $enfrentamiento->getPareja1()->getIdPareja() ?>"
                      data-pareja2="<?= $enfrentamiento->getPareja2()->getIdPareja() ?>"
                      data-set1="<?= $enfrentamiento->getSet1(); ?>"
                      data-set2="<?= $enfrentamiento->getSet2(); ?>"
                      data-set3="<?= $enfrentamiento->getSet3(); ?>"
                      data-campeonato="<?= $campeonato ?>"
                      data-grupo="<?= $idGrupo ?>"
                      data-liga="<?= $tipoLiga ?>"
                      >
                      <?= $enfrentamiento->getSet1(); ?> /
                      <?= $enfrentamiento->getSet2(); ?> /
                      <?= $enfrentamiento->getSet3(); ?>
                    </a>
              </td>


            </tr>
              <?php endforeach; ?>
              <?php $contPareja++;?>
              <?php $contPareja2--;?>
              <?php endforeach; ?>
          </tbody>
          </table>
    </div>
    <!-- /Enfrentamientos Resto Ligas -->
<?php endif; ?>
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
        <form action="index.php?controller=enfrentamiento&amp;action=modificarResultados&amp;
        campeonato=<?= $campeonato ?>&amp;
        grupoId=<?= $idGrupo ?>&amp;
        tipoLiga=<?= $tipoLiga ?>
        " method="POST">

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
            <?php if ($currenttype=="admin"): ?>
              <button type="submit" class="btn btn-primary">Modificar resultados</button>
            <?php else: ?>
              <button disabled type="submit" class="btn btn-primary">Modificar resultados</button>
            <?php endif ?>
          </div>
        </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- !Modal -->
