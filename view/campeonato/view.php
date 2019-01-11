<?php
require_once(__DIR__ . "/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$campeonato = $view->getVariable("campeonato");
$categorias = $view->getVariable("categorias");
$view->setVariable("title", "Campeonato");
?>

<html lang="es">
    <body>

        <div class="container">
            <div class="row">
                <h5><?php echo $campeonato["nombre"]; ?></h5>
            </div>
            <div class="row">
                <div class="col"><h5>Fecha inicio <?php echo $campeonato["fechaInicio"]; ?></h5></div>
                <div class="col"><h5>Fecha Fin <?php echo $campeonato["fechaFin"]; ?></h5></div>
            </div>
            <div class="row">
                <div class="col"><h5>Fecha inicio inscripciones <?php echo $campeonato["fechaInicioInscripciones"]; ?></h5></div>
                <div class="col"><h5>Fecha fin inscripciones <?php echo $campeonato["fechaFinInscripciones"]; ?></h5></div>
            </div>
            <div>
                <h5>Reglas: </h5><?php echo $campeonato["reglas"]; ?>
            </div>
            <br>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nivel</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Max. Participantes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($categorias != NULL) {
                        foreach ($categorias as $categoria):
                            ?>
                            <tr>
                                <td><?= $categoria["nivel"]; ?> </td>
                                <td><?= $categoria["tipo"]; ?> </td>
                                <td><?= $categoria["maxParticipantes"]; ?></td>
                            </tr>
                            <?php
                        endforeach;
                    }?>
                </tbody>
            </table>
        </div>
        <!-- SOLO EL ADMIN PUEDE AÑADIR CATEGORIAS -->
        <div>
                <?php if ($categorias == NULL) { ?>
                <a href="index.php?controller=campeonato&amp;action=anadirCategoria&amp;id=<?= $campeonato["idCampeonato"] ?>">Añadir Categorias</a>
                <?php } ?>
            </div>
        <footer>
            <p>ABP_23</p>
        </footer>

    </body>
</html>


