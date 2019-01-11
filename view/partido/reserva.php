<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Gestionar reservas");
?>

<section>
    <table class="table" >				
        <thead><tr><th>Datos promocionar partido<th></tr></thead>								
        <form method="POST" action="index.php?controller=Partido&amp;action=anadirReservaPartido">
            <tbody>
                <tr><th>Pista</th><td> <input style="border:none" type="text" name="pista" value="<?php echo $view->getVariable("pista"); ?>" readonly></td></tr>
                <tr><th>Hora Inicial</th><td> <input style="border:none" type="text" name="hora" value="<?php echo $view->getVariable("hora"); ?>" readonly></td></tr>
                <tr><th>Fecha</th><td> <input style="border:none" type="text" name="fecha" value="<?php echo $view->getVariable("fecha"); ?>" readonly></td></tr>
                <tr><th>Hora Final</th><td> <input style="border:none" type="text" name="horaFinal" value="<?php echo $view->getVariable("horaFinal"); ?>:00" readonly></td></tr>
                <tr><th></th><td> <input style="border:none" type="hidden" name="disponibilidad" value="<?php echo $view->getVariable("disponibilidad"); ?>" readonly></td></tr>
            </tbody></table>
    <a href="index.php?controller=Partido&amp;action=index"><button type="button" >Volver</button></a>
    <?php if ($view->getVariable("disponibilidad") == 'disponible') { ?>
        <input type="submit" name="reservar" value="Reservar" >
    <?php } else {
        ?><!-- CANCELAR PARTIDO OMITIDO <input type="submit" name="cancelar" value="Cancelar" > -->
    <?php } ?>																											
    </form>
    <td></tr></tbody>							
        </table>														
</section>