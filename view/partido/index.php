<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partidos");
$fecha = $view->getVariable("fecha");
$anterior = 0;
$view->setVariable("title", "Crear Partido");

$currentuser = $_SESSION["currentuser"];
$currenttype = $_SESSION["currenttype"];

?>

<html lang="es">
    <head><link rel="stylesheet" href="/css/crearPartidoStyle.css" type="text/css"></head>
    <body>
        <h3>Promocionar Partido</h3>
        <section>
            <table class="table" >
                <thead><tr><th>Etiquetas</th></tr></thead>
                <tbody><tr><td style="border:solid;background-color:green;color:black;">Disponible</td>
                        <td style="border:solid;background-color:red;color:black;">Ocupado</td></tr></tbody>
            </table>
        </section>
        <section>
            <table class="table" >
                <thead><tr><th>Escoge Fecha</th></tr></thead>
                <form  action="index.php?controller=Partido&amp;action=verPistasFechaPartido" method="POST">
                    <tbody><tr><td><input type="date"  name="fecha" id="fecha" >
                                <input type="submit" name="ver" value="Ver pistas"></td></tr></tbody></table>
            <table class="table" >
                <?php if ($fecha != NULL) { 
                    foreach ($fecha as $pista) { ?>
        <?php if ($anterior != $pista->getHorarioIdPista()) { ?>
                            <thead><tr><th>Pista: <?php $pista->getHorarioIdPista(); ?></th></tr></thead>

                            <?php                    
                            $anterior = $pista->getHorarioIdPista();
                        }
                        ?>
                        <?php if ($pista->getDisponibilidad() != 'disponible') { 
                                if($pista->getNumInscritos()=='' ||$pista->getNumInscritos()=='0'){?>
                                    <td><a style="border:solid;background-color:blue;color:black;" href="index.php?controller=Partido&amp;action=comprobarReservaPartido&amp;fecha=<?= $pista->getFecha(); ?>&amp;pista=<?= $pista->getHorarioIdPista(); ?>&amp;hora=<?= $pista->getHora(); ?>&amp;disponibilidad=<?= $pista->getDisponibilidad(); ?>"><?php echo $pista->getHora(); ?></a></td>
                                    <?php
                                }else{
                                    ?>
                                    <td><a style="border:solid;background-color:red;color:black;" href="index.php?controller=Partido&amp;action=comprobarReservaPartido&amp;fecha=<?= $pista->getFecha(); ?>&amp;pista=<?= $pista->getHorarioIdPista(); ?>&amp;hora=<?= $pista->getHora(); ?>&amp;disponibilidad=<?= $pista->getDisponibilidad(); ?>"><?php echo $pista->getHora(); ?></a></td>
                                    <?php
                                }
                         } else { ?>
                            <td><a style="border:solid;background-color:green;color:black;" href="index.php?controller=Partido&amp;action=comprobarReservaPartido&amp;fecha=<?= $pista->getFecha(); ?>&amp;pista=<?= $pista->getHorarioIdPista(); ?>&amp;hora=<?= $pista->getHora(); ?>&amp;disponibilidad=<?= $pista->getDisponibilidad(); ?>"><?php echo $pista->getHora(); ?></a></td>
        <?php } ?>
    <?php }
} ?>
                </form>
            </table>
        </section>
        <footer>
            <p>ABP_23</p>
        </footer>
    </body>
</html>
