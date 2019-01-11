
<?php
require_once(__DIR__ . "/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");

$campeonato = $view->getVariable("campeonato");
$categorias = $view->getVariable("categorias");

$view->setVariable("title", "Inscribirse Campeonato");
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
            <br>
        </div>
        <br>
        <?php if ($categorias != NULL) { ?>
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
                        foreach ($categorias as $categoria):
                            ?>
                            <tr>
                                <td><?= $categoria["nivel"]; ?> </td>
                                <td><?= $categoria["tipo"]; ?> </td>
                                <td><?= $categoria["maxParticipantes"]; ?></td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-auto">
                        <h3>Inscribirse Campeonato</h3>
                        <form name="inscribirsecampeonato" action="index.php?controller=Campeonato&amp;action=inscribirse" method="POST">
                            <label>Usuario capitan</label>
                            <input type="text" name="nombreCapitan" value="" required/><br>
                            <label>Usuario compañero </label>
                            <input type="text" name="nombreDeportista" value="" required/><br>
                            <label>Nivel</label><br>
                            <input type="radio" name="nivel" value="1" required> 1<br>
                            <input type="radio" name="nivel" value="2" required> 2<br>
                            <input type="radio" name="nivel" value="3" required> 3<br>
                            <label>Tipo</label><br>
                            <input type="radio" name="tipo" value="Masculina" required> Masculina<br>
                            <input type="radio" name="tipo" value="Femenina" required> Femenina<br>
                            <input type="radio" name="tipo" value="Mixta" required> Mixta<br>
                            <input type="hidden" value="<?php echo $campeonato["idCampeonato"] ?>" name="idCampeonato" />
                            <input type="submit" name="submit" value="Inscribirse">
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <footer>
            <p>ABP_23</p>
        </footer>

    </body>
</html>

