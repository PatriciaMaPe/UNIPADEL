
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

            function compareA() {

                var startDt = document.getElementById("inicio").value;
                var endDt = document.getElementById("fin").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin').value = "";
                    return false;
                }
            }
            
            function compareB() {

                var startDt = document.getElementById("inicio_ins").value;
                var endDt = document.getElementById("inicio").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de inicio es anterior a la de inicio de inscripciones");
                    document.getElementById('inicio_ins').value = "";
                    return false;
                }
            }
            
            function compareC() {

                var startDt = document.getElementById("inicio_ins").value;
                var endDt = document.getElementById("fin_ins").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de finalizacion es anterior a la inicio");
                    document.getElementById('fin_ins').value = "";
                    return false;
                }
            }
            
            function compareD() {

                var startDt = document.getElementById("fin_ins").value;
                var endDt = document.getElementById("inicio").value;

                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {

                    alert("Cuidado, la fecha de inicio es anterior a la de finalizacion de inscripciones");
                    document.getElementById('fin_ins').value = "";
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
                        <input type="date" id ="inicio_ins" name="inicioInscripcion" value="" onblur="compareB();" required/><br>
                        <label>Fecha fin inscripciones</label>
                        <input type="date" id="fin_ins" name="finInscripcion" value=""  onblur="compareC();compareD();" required/><br><br>
                        <div class="col-auto">
                        <label>Categoria</label>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <input type="checkbox" name="masculina" value="Masculina">
                                <label for="masculina">Masculina</label>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelMAS1" value="1"> 1
                                </div>
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelMAS2" value="2"> 2
                                </div>
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelMAS3" value="3"> 3
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <input type="checkbox" name="femenina" value="Femenina">
                                <label for="femenina">Femenina</label>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelFEM1" value="1"> 1
                                </div>
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelFEM2" value="2"> 2
                                </div>
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelFEM3" value="3"> 3
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <input type="checkbox" name="mixta" value="Mixta">
                                <label for="mixta">Mixta</label>
                            </div>
                            <div class="row">
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelMIX1" value="1"> 1
                                </div>
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelMIX2" value="2"> 2
                                </div>
                                <div class="col-auto">
                                    <input type="checkbox" name="nivelMIX3" value="3"> 3
                                </div>
                            </div>
                        </div>
                        <label>Número de participantes por categoria</label>
                        <input type="number" name="maxParticipantes" min="8" max="12">
                        <br><br>
                        <label>Reglas</label><br>
                        <textarea name="reglas" rows="3" cols="40"></textarea><br><br>
                        <input type="submit" name="submit" value="Crear campeonato">
                    </form>
                </div>
            </div>
        </div>

<footer>
    <p>ABP_23</p>
</footer>

</body>
</html>
