
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$gruposCampeonatos = $view->getVariable("gruposCampeonatos");
$view->setVariable("title", "Crear Campeonato");
?>

<html lang="es">
    <body>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha inicio</th>
                        <th scope="col">Fecha fin</th>
                        <th scope="col">Inicio inscripcion</th>
                        <th scope="col">Fin inscripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($campeonatos as $campeonato): ?>
                        <tr>
                            <td><?= $campeonato->getNombreCampeonato(); ?> </td>
                            <td><?= $campeonato->getFechaInicio(); ?> </td>
                            <td><?= $campeonato->getFechaFin(); ?> </td>
                            <td><?= $campeonato->getInicioInscripcion(); ?> </td>
                            <td><?= $campeonato->getFinInscripcion(); ?> </td>
                            <td>
                                <a href="index.php?controller=campeonato&amp;action=inscribir&amp;id=<?= $campeonato->getIdCampeonato(); ?>">Inscribirse</a>
                                <a href="index.php?controller=campeonato&amp;action=view&amp;id=<?= $campeonato->getIdCampeonato(); ?>">Consultar</a>
                                <!-- SOLO EL ADMIN PUEDE VER MODIFICAR O ELIMINAR -->
                                <a href="index.php?controller=campeonato&amp;action=modificar&amp;id=<?= $campeonato->getIdCampeonato(); ?>">Modificar</a>                                   
                                <?php
                                $show = true;
                                foreach ($gruposCampeonatos as $grupo):
                                    if ($grupo->getCampeonato()->getIdCampeonato() == $campeonato->getIdCampeonato()) {
                                        $show = false;
                                    }
                                endforeach;
                                if ($show) {
                                    ?>
                                    <a href="index.php?controller=campeonato&amp;action=eliminar&amp;id=<?= $campeonato->getIdCampeonato(); ?>" onclick="return confirm('¿Confirmas que quieres eliminar este campeonato: <?php echo $campeonato->getNombreCampeonato() ?> ?')">Eliminar</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>

<footer>
    <p>ABP_23</p>
</footer>

</body>
</html>
