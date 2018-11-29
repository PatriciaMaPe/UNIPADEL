
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$campeonatos = $view->getVariable("campeonatos");
$view->setVariable("title", "Crear Campeonato");
?>

<html lang="es">
    <body>
        <script>

            //TO DO: Comprobar fin de inscripcion antes de inicio campeonato
            //TO DO: Form no se desmarca al ser solo uno

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
                <div class="col-md-auto">
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
                        <div class="row">
                            <div class="col-auto">
                                <label>Categoria</label>
                            </div>
                            <!--
                            <select name="tipo" required>
                                <option value="">Sin valor</option>
                                <option value="Masculina">Masculina</option>
                                <option value="Femenina">Femenina</option>
                                <option value="Mixta">Mixta</option>
                            </select>
                            -->
                            <div class="col-auto">
                                <input type="checkbox" name="masculina" value="Masculina">
                                <label for="masculina">Masculina</label>
                            </div>
                            <div class="col-auto">
                                <input type="checkbox" name="femenina" value="Femenina">
                                <label for="femenina">Femenina</label>
                            </div>
                            <div class="col-auto">
                                <input type="checkbox" name="mixta" value="Mixta">
                                <label for="mixta">Mixta</label>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-auto">
                                <label>Nivel</label>
                            </div>
                            <!--
                            <select name="nivel" required>
                                <option value="">Sin valor</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            -->
                            <div class="col-auto">
                                <input type="check" name="nivel" value="1" required> 1
                            </div>
                            <div class="col-auto">
                                <input type="radio" name="nivel" value="2"> 2
                            </div>
                            <div class="col-auto">
                                <input type="radio" name="nivel" value="3"> 3
                            </div>
                        </div>
                        <br><br>
                        <label>Reglas</label><br>
                        <textarea name="reglas" rows="3" cols="40"></textarea><br><br>
                        <input type="submit" name="submit" value="Crear campeonato">
                    </form>
                </div>
            </div>

            <br>

            <!-- Enfrentamientos -->
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
                         <!-- TO DO: Que aparezca la categoria y el nivel // Consulta // Modificacion // Eliminacion -->
                        <td><?= $campeonato->getNombreCampeonato(); ?> </td>
                        <td><?= $campeonato->getFechaInicio(); ?> </td>
                        <td><?= $campeonato->getFechaFin(); ?> </td>
                        <td><?= $campeonato->getInicioInscripcion(); ?> </td>
                        <td><?= $campeonato->getFinInscripcion(); ?> </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

                </main>
            </div>
        </div>

        <footer>
            <p>ABP_23</p>
        </footer>

    </body>
</html>
