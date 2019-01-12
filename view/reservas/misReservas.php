<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view=ViewManager::getInstance();
$view->setVariable("title", "Mis reservas");
$user=$view->getVariable("UsuarioRegistradousuario");

?>
<table class="table" >
<thead><tr><th>Fecha</th><th>Pista</th><th>Hora inicio</th><th>Hora fin</th></tr></thead>
<tbody>
<?php
foreach($user as $usuario){
	
	?>
	<tr>
	<td><?php echo $usuario->getFecha();?></td>
	<td><?php echo $usuario->getPistaidPista();?></td>
	<td><?php echo $usuario->getHoraInicio();?></td>
	<td><?php echo $usuario->getHoraFin();?></td>
	<td><a href="index.php?controller=RealizarReserva&amp;action=cancelarReserva&amp;fecha=<?= $usuario->getFecha(); ?>&amp;pista=<?= $usuario->getPistaidPista(); ?>&amp;horaInicio=<?= $usuario->getHoraInicio(); ?>&amp;horaFin=<?= $usuario->getHoraFin(); ?>">Cancelar Reserva</a></td>
	</tr>
<?php
}
?>
</tbody>
</table>