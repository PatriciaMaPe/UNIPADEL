
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$view->setVariable("title", "Crear Campeonato");
?>
<html lang="es">
    <head><link rel="stylesheet" href="/css/crearCampeonatoStyle.css" type="text/css"></head>
    <body>
        <script>
            function compareB() {

                var startDt = document.getElementById("inicio_ins").value;
                var endDt = document.getElementById("fin_ins").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin_ins').value = "";
                    return false;
                }
            }
            function compareA() {

                var startDt = document.getElementById("inicio").value;
                var endDt = document.getElementById("fin").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin').value = "";
                    return false;
                }
            }
        </script>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Crear campeonato nuevo</h3>
                    <form name="crearcampeonato" action="index.php?controller=Campeonato&amp;action=add" method="POST">
                        <label>Nombre del campeonato</label>
                        <input type="text" name="nombreCampeonato" required/><br><br>
                        <label>Fecha inicio</label>
                        <input type="date" id="inicio" name="fechaInicio" value="" required/><br>
                        <label>Fecha finalización</label>
                        <input type="date" id="fin" name="fechaFin" value="" onblur="compareA();" required/><br>
                        <label>Fecha inscripciones</label>
                        <input type="date" id ="inicio_ins" name="inicioInscripcion" value="" required/><br>
                        <label>Fecha fin inscripciones</label>
                        <input type="date" id="fin_ins" name="finInscripcion" value=""  onblur="compareB();" required/><br><br>
                        <label>Categoria</label>
                        <select name="tipo" required>
                            <option value="">Sin valor</option>
                            <option value="Masculina">Masculina</option>
                            <option value="Femenina">Femenina</option>
                        </select><br><br>
                        <label>Nivel</label>
                        <select name="nivel" required>
                            <option value="">Sin valor</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select><br><br>
                        Reglas<br>
                        <textarea name="reglas" rows="3" cols="40"></textarea><br><br>
                        <input type="submit" name="submit" value="Crear campeonato">
                    </form>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Campeonatos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ((array) $campeonatos as $campeonato): ?>
                            <tr>
                                <td> <?= $campeonato->getNombreCampeonato(); ?></td>

                                <td>
                                    <a href="index.php?controller=campeonato&amp;action=view&amp;id=<?= $campeonato->getNombreCammpeonato(); ?>">Consultar</a>                                   
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

        <footer>
            <p>ABP_23</p>
        </footer>

    </body>
</html>
