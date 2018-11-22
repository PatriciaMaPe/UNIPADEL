<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$partidos = $view->getVariable("partido");
$view->setVariable("title", "Crear Partido");
?>

<html lang="es">
    <head><link rel="stylesheet" href="/css/crearPartidoStyle.css" type="text/css"></head>
    <body>
        <script>
            function compare() {

                var startDt = document.getElementById("inicio_ins").value;
                var endDt = document.getElementById("fin_ins").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin_ins').value = "";
                    return false;
                }
            }
        </script>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Promocionar Partido</h3>
                    <form name="crearpartido" action="index.php?controller=Partido&amp;action=add" method="POST">
                        <label>Fecha inicio</label>
                        <input type="date" name="fecha" value="" required/><br>
                        <label>Hora de inicio</label>
                        <input type="time" name="horaInicio" value="" required/><br>
                        <label>Hora de finalización</label>
                        <input type="time" name="horaFin" value="" required/><br>
                        <label>Fecha inicio inscripciones</label>
                        <input type="date" name="inicioInscripcion" value="" id="inicio_ins" required/><br>
                        <label>Fecha fin inscripciones</label>
                        <input type="date" name="finInscripcion" value="" id="fin_ins" onblur="compare();" required/><br><br>
                        <input type="submit" name="submit" value="Promocionar Partido">
                    </form>
                </div>
            </div>
            <footer>
                <p>ABP_23</p>
            </footer>

    </body>
</html>
