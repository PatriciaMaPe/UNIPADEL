<?php

require_once(__DIR__ . "/../model/Campeonato.php");
require_once(__DIR__ . "/../model/CampeonatoMapper.php");
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../model/CategoriaMapper.php");
require_once(__DIR__ . "/../model/CampeonatoCategoria.php");
require_once(__DIR__ . "/../model/CampeonatoCategoriaMapper.php");
require_once(__DIR__ . "/../model/GrupoMapper.php");
require_once(__DIR__ . "/../model/Pareja.php");
require_once(__DIR__ . "/../model/ParejaMapper.php");
require_once(__DIR__ . "/../model/UsuarioRegistrado.php");
require_once(__DIR__ . "/../model/UsuarioRegistradoMapper.php");


require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class CampeonatoController extends BaseController {

    private $campeonatoMapper;
    private $categoriaMapper;
    private $campeonatoCategoriaMapper;
    private $parejaMapper;
    private $usuarioRegistradoMapper;

    public function __construct() {
        parent::__construct();

        $this->campeonatoMapper = new CampeonatoMapper();
        $this->categoriaMapper = new CategoriaMapper();
        $this->campeonatoCategoriaMapper = new campeonatoCategoriaMapper();
        $this->grupoMapper = new GrupoMapper();
        $this->parejaMapper = new ParejaMapper();
        $this->usuarioRegistradoMapper = new usuarioRegistradoMapper();
    }

    //Paginas

    public function index() {

        if (!isset($this->currentUser)) {
            $this->view->render("usuarios", "login");
        } else {
            //if($this->currentUser->getTipo()!='admin'){
            //$errors = array();
            //$errors["general"] = "Usuario no valido para crear campeonatos";
            //$this->view->setVariable("errors", $errors);
            //$this->view->redirect("home", "index");
            //}
            $gruposCampeonatos = $this->grupoMapper->findAll();
            $this->view->setVariable("gruposCampeonatos", $gruposCampeonatos, false);
            $campeonatos = $this->campeonatoMapper->findAll();
            $this->view->setVariable("campeonatos", $campeonatos, false);
            $this->view->render("campeonato", "index");
        }
    }

    public function crearCampeonato() {

        if (!isset($this->currentUser)) {
            $this->view->render("usuarios", "login");
        } else {
            //if($this->currentUser->getTipo()!='admin'){
            //$errors = array();
            //$errors["general"] = "Usuario no valido para crear campeonatos";
            //$this->view->setVariable("errors", $errors);
            //$this->view->redirect("home", "index");
            //}
            $this->view->render("campeonato", "crearCampeonato");
        }
    }

    public function view() {

        if (!isset($_REQUEST["id"])) {
            throw new Exception("Necesario un identificador de campeonato");
        }
        $idCampeonato = $_REQUEST["id"];
        if ($idCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }
        $campeonato = $this->campeonatoMapper->findById($idCampeonato);
        $idCategorias = $this->campeonatoCategoriaMapper->findByCampeonatoId($idCampeonato);
        $categorias = $this->categoriaMapper->findById($idCategorias);
        $this->view->setVariable("campeonato", $campeonato, false);
        $this->view->setVariable("categorias", $categorias, false);
        $this->view->render("campeonato", "view");
    }

    public function modificar() {

        if (!isset($_REQUEST["id"])) {
            throw new Exception("Necesario un identificador de campeonato");
        }
        $idCampeonato = $_REQUEST["id"];
        if ($idCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }
        $campeonato = $this->campeonatoMapper->findById($idCampeonato);
        $this->view->setVariable("campeonato", $campeonato, false);
        $this->view->render("campeonato", "modificar");
    }

    public function anadirCategoria() {

        if (!isset($_REQUEST["id"])) {
            throw new Exception("Necesario un identificador de campeonato");
        }
        $idCampeonato = $_REQUEST["id"];
        if ($idCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }

        $campeonato = $this->campeonatoMapper->findById($idCampeonato);
        $this->view->setVariable("campeonato", $campeonato, false);
        $this->view->render("campeonato", "añadirCategoria");
    }

    public function inscribir() {
        if (!isset($_REQUEST["id"])) {
            throw new Exception("Necesario un identificador de campeonato");
        }
        $idCampeonato = $_REQUEST["id"];
        if ($idCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }
        $campeonato = $this->campeonatoMapper->findById($idCampeonato);
        $idCategorias = $this->campeonatoCategoriaMapper->findByCampeonatoId($idCampeonato);
        $categorias = $this->categoriaMapper->findById($idCategorias);
        $this->view->setVariable("campeonato", $campeonato, false);
        $this->view->setVariable("categorias", $categorias, false);
        $this->view->render("campeonato", "inscribirse");
    }

    //Funciones

    public function modificarCampeonato() {

        $campeonato = new Campeonato();
        if (isset($_POST["idCampeonato"])) {

            $campeonato->setIdCampeonato($_POST["idCampeonato"]);
            $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
            $campeonato->setFechaInicio($_POST["fechaInicio"]);
            $campeonato->setFechaFin($_POST["fechaFin"]);
            $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
            $campeonato->setFinInscripcion($_POST["finInscripcion"]);
            $campeonato->setReglas($_POST["reglas"]);

            try {
                $campeonato->checkIsValidForUpdate();
                $this->campeonatoMapper->update($campeonato);
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        //MOSTRAR MENSAJES DE ERROR O CORRECTA EJECUCION
        
        $gruposCampeonatos = $this->grupoMapper->findAll();
        $this->view->setVariable("gruposCampeonatos", $gruposCampeonatos, false);
        $campeonatos = $this->campeonatoMapper->findAll();
        $this->view->setVariable("campeonatos", $campeonatos, false);
        $this->view->render("campeonato", "index");
    }

    public function add() {

        function creacionCategoria($idCampeonato, $tipoCategoria, $nivel) {

            $categoria = new Categoria();
            $categoriaMapper = new CategoriaMapper();
            $campeonatoCategoria = new CampeonatoCategoria();
            $campeonatoCategoriaMapper = new CampeonatoCategoriaMapper();
            $categoria->setTipo($tipoCategoria);
            $categoria->setNivel($nivel);
            $categoria->setMaxParticipantes($_POST["maxParticipantes"]);

            try {
                $categoria->checkIsValidForCreate();
                $idCategoria = $categoriaMapper->save($categoria);
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }

            $campeonatoCategoria->setIdCampeonato($idCampeonato);
            $campeonatoCategoria->setIdCategoria($idCategoria);

            try {
                $campeonatoCategoria->checkIsValidForCreate();
                $campeonatoCategoriaMapper->save($campeonatoCategoria);
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        $campeonato = new Campeonato();
        if (isset($_POST["nombreCampeonato"])) {

            $campeonato->setNombreCampeonato($_POST["nombreCampeonato"]);
            $campeonato->setFechaInicio($_POST["fechaInicio"]);
            $campeonato->setFechaFin($_POST["fechaFin"]);
            $campeonato->setInicioInscripcion($_POST["inicioInscripcion"]);
            $campeonato->setFinInscripcion($_POST["finInscripcion"]);
            $campeonato->setReglas($_POST["reglas"]);

            try {

                $campeonato->checkIsValidForCreate();
                $idcam = $this->campeonatoMapper->save($campeonato);

                if (isset($_POST["masculina"])) {

                    $tipoCategoria = $_POST["masculina"];

                    if (isset($_POST["nivelMAS1"])) {
                        $nivel = $_POST["nivelMAS1"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS2"])) {
                        $nivel = $_POST["nivelMAS2"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS3"])) {
                        $nivel = $_POST["nivelMAS3"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
                if (isset($_POST["femenina"])) {

                    $tipoCategoria = $_POST["femenina"];

                    if (isset($_POST["nivelFEM1"])) {
                        $nivel = $_POST["nivelFEM1"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelFEM2"])) {
                        $nivel = $_POST["nivelFEM2"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelFEM3"])) {
                        $nivel = $_POST["nivelFEM3"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
                if (isset($_POST["mixta"])) {

                    $tipoCategoria = $_POST["mixta"];

                    if (isset($_POST["nivelMIX1"])) {
                        $nivel = $_POST["nivelMIX1"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMIX2"])) {
                        $nivel = $_POST["nivelMIX2"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMIX3"])) {
                        $nivel = $_POST["nivelMIX3"];
                        creacionCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        //MOSTRAR MENSAJES DE ERROR O CORRECTA EJECUCION
        
        $gruposCampeonatos = $this->grupoMapper->findAll();
        $this->view->setVariable("gruposCampeonatos", $gruposCampeonatos, false);
        $campeonatos = $this->campeonatoMapper->findAll();
        $this->view->setVariable("campeonatos", $campeonatos, false);
        $this->view->render("campeonato", "index");
    }

    public function eliminar() {

        if (!isset($_REQUEST["id"])) {
            throw new Exception("Necesario un identificador de campeonato");
        }
        $idCampeonato = $_REQUEST["id"];
        if ($idCampeonato == NULL) {
            throw new Exception("No se han realizado campeonatos");
        }

        //MOSTRAR MENSAJES DE ERROR O CORRECTA EJECUCION
        
        $this->campeonatoMapper->delete($idCampeonato);
        $gruposCampeonatos = $this->grupoMapper->findAll();
        $this->view->setVariable("gruposCampeonatos", $gruposCampeonatos, false);
        $campeonatos = $this->campeonatoMapper->findAll();
        $this->view->setVariable("campeonatos", $campeonatos, false);
        $this->view->render("campeonato", "index");
    }

    public function addCategoria() {

        function anadirCategoria($idCampeonato, $tipoCategoria, $nivel) {
            $categoria = new Categoria();
            $categoriaMapper = new CategoriaMapper();
            $campeonatoCategoria = new CampeonatoCategoria();
            $campeonatoCategoriaMapper = new CampeonatoCategoriaMapper();
            $categoria->setTipo($tipoCategoria);
            $categoria->setNivel($nivel);
            $categoria->setMaxParticipantes($_POST["maxParticipantes"]);
            try {
                $categoria->checkIsValidForCreate();
                $idCategoria = $categoriaMapper->save($categoria);
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
            $campeonatoCategoria->setIdCampeonato($idCampeonato);
            $campeonatoCategoria->setIdCategoria($idCategoria);
            try {
                $campeonatoCategoria->checkIsValidForCreate();
                $campeonatoCategoriaMapper->save($campeonatoCategoria);
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }

        if (isset($_POST["idCampeonato"])) {
            $idcam = $_POST["idCampeonato"];
            try {
                if (isset($_POST["masculina"])) {
                    $tipoCategoria = $_POST["masculina"];
                    if (isset($_POST["nivelMAS1"])) {
                        $nivel = $_POST["nivelMAS1"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS2"])) {
                        $nivel = $_POST["nivelMAS2"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMAS3"])) {
                        $nivel = $_POST["nivelMAS3"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
                if (isset($_POST["femenina"])) {
                    $tipoCategoria = $_POST["femenina"];
                    if (isset($_POST["nivelFEM1"])) {
                        $nivel = $_POST["nivelFEM1"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelFEM2"])) {
                        $nivel = $_POST["nivelFEM2"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelFEM3"])) {
                        $nivel = $_POST["nivelFEM3"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
                if (isset($_POST["mixta"])) {
                    $tipoCategoria = $_POST["mixta"];
                    if (isset($_POST["nivelMIX1"])) {
                        $nivel = $_POST["nivelMIX1"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMIX2"])) {
                        $nivel = $_POST["nivelMIX2"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                    if (isset($_POST["nivelMIX3"])) {
                        $nivel = $_POST["nivelMIX3"];
                        anadirCategoria($idcam, $tipoCategoria, $nivel);
                    }
                }
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        
        //MOSTRAR MENSAJES DE ERROR O CORRECTA EJECUCION
        
        $gruposCampeonatos = $this->grupoMapper->findAll();
        $this->view->setVariable("gruposCampeonatos", $gruposCampeonatos, false);
        $campeonatos = $this->campeonatoMapper->findAll();
        $this->view->setVariable("campeonatos", $campeonatos, false);
        $this->view->render("campeonato", "index");
    }

    public function inscribirse() {
        if (!isset($_POST["idCampeonato"])) {
            throw new Exception("Necesario un identificador de campeonato");
        }
        $idCampeonato = $_POST["idCampeonato"];
        $capitan = $_POST["nombreCapitan"];
        $compañero = $_POST["nombreDeportista"];
        if ($capitan != $compañero && $this->usuarioRegistradoMapper->findById($capitan) != NULL && $this->usuarioRegistradoMapper->findById($compañero) != NULL) {
            $nivel = $_POST["nivel"];
            $tipo = $_POST["tipo"];

            $campeonato = $this->campeonatoMapper->findById($idCampeonato);
            $categoria = $this->categoriaMapper->findByTipoNivel($idCampeonato, $nivel, $tipo);

            if ($categoria != NULL) {

                $grupos = $this->grupoMapper->findByCampeonatoCategoria($idCampeonato, $categoria["idCategoria"]);
                $idGrupo = NULL;
                if ($grupos == NULL) {
                    $idGrupo = $this->parejaMapper->crearGrupoB($idCampeonato, $categoria["idCategoria"], "regular");
                } else {
                    foreach ($grupos as $grupo) {
                        $numParticipantes = $this->parejaMapper->countByGrupo($grupo["idGrupo"]);
                        if ($numParticipantes["cont"] < $categoria["maxParticipantes"]) {
                            $idGrupo = $grupo["idGrupo"];
                        }
                    }
                }
                if ($idGrupo == NULL) {
                    $idGrupo = $this->parejaMapper->crearGrupoB($idCampeonato, $categoria["idCategoria"], "regular");
                }
                $regular = 'regular';
                $contA = $this->parejaMapper->findDupledA($capitan, $idGrupo, $regular);
                $contB = $this->parejaMapper->findDupledB($compañero, $idGrupo, $regular);
                if ($contA["cont"] == 0 && $contB["cont"] == 0) {
                    $this->parejaMapper->addPareja($capitan, $compañero, $idGrupo, "regular");
                    echo 'INSCRIPCIÓN REALIZADA CON ÉXITO';
                }
            }
        }
        
        //MOSTRAR MENSAJES DE ERROR O CORRECTA EJECUCION
        
        $gruposCampeonatos = $this->grupoMapper->findAll();
        $this->view->setVariable("gruposCampeonatos", $gruposCampeonatos, false);
        $campeonatos = $this->campeonatoMapper->findAll();
        $this->view->setVariable("campeonatos", $campeonatos, false);
        $this->view->render("campeonato", "index");
    }

}
