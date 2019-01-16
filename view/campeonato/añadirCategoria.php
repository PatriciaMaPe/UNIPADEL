
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$campeonato = $view->getVariable("campeonato");
$view->setVariable("title", "Añadir Categoria");
?>

<html lang="es">
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-auto">
                    <h3>Añadir Categoria</h3>
                    <form name="crearcampeonato" action="index.php?controller=Campeonato&amp;action=addCategoria" method="POST">
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
                        <input type="number" name="maxParticipantes" min="8" max="12" required>
                        <br><br>
                        <input type="hidden" value="<?php echo $campeonato["idCampeonato"] ?>" name="idCampeonato" />
                        <input type="submit" name="submit" value="Añadir Categorias">
                    </form>
                </div>
            </div>
        </div>


        <footer>
            <p>ABP_23</p>
        </footer>

    </body>
</html>
