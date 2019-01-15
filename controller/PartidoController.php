<?php

require_once(__DIR__ . "/../model/Partido.php");
require_once(__DIR__ . "/../model/PartidoMapper.php");
require_once(__DIR__ . "/../model/PartidoReserva.php");
require_once(__DIR__ . "/../model/PartidoReservaMapper.php");
require_once(__DIR__."/../model/GestionarReservas.php");
require_once(__DIR__."/../model/GestionarReservasMapper.php");
require_once(__DIR__."/../model/RealizarReserva.php");
require_once(__DIR__."/../model/RealizarReservaMapper.php");

require_once(__DIR__ . "/../core/ViewManager.php");
require_once(__DIR__ . "/../controller/BaseController.php");

class PartidoController extends BaseController {

    private $partidoMapper;
    private $partidoReservaMapper;
    private $gestionarReservasMapper;
    private $realizarReservaMapper;

    public function __construct() {
        parent::__construct();

        $this->partidoMapper = new PartidoMapper();
        $this->partidoReservaMapper = new PartidoReservaMapper();
        $this->gestionarReservasMapper = new GestionarReservasMapper();
        $this->realizarReservaMapper = new RealizarReservaMapper();
    }

    //Paginas

    public function index() {

        $partidos = $this->partidoMapper->findAll();
        $this->view->setVariable("partidos", $partidos, false);
        $this->view->render("partido", "index");
    }

    //Funciones

    public function add() {
        $partido = new Partido();
        if (isset($_POST["fecha"])) {
            $partido->setFecha($_POST["fecha"]);
            $partido->setHoraInicio($_POST["horaInicio"]);
            $partido->setHoraFin($_POST["horaFin"]);
            $partido->setInicioInscripcion($_POST["inicioInscripcion"]);
            $partido->setFinInscripcion($_POST["finInscripcion"]);
            try {
                $this->partidoMapper->save($partido);
                $this->view->setFlash(sprintf("Partido \"%s\" añadido correctamente."));
                $this->view->redirect("partido", "index");
            } catch (ValidationException $ex) {
                $errors = $ex->getErrors();
                $this->view->setVariable("errors", $errors);
            }
        }
        $this->view->render("partido", "index");
    }

    public function view() {
        $idPartido = $_REQUEST["idPartido"];
        $fecha = $_REQUEST["fecha"];
        $horaInicio = $_REQUEST["horaInicio"];
        $horaFin = $_REQUEST["horaFin"];
        $inicioInscripcion = $_REQUEST["inicioInscripcion"];
        $finInscripcion = $_REQUEST["finInscripcion"];
        if ($idPartido == NULL) {
            throw new Exception("No se han realizado partidos");
        }
        $this->view->setVariable("idPartido", $idPartido, false);
        $this->view->setVariable("fecha", $fecha, false);
        $this->view->setVariable("horaInicio", $horaInicio, false);
        $this->view->setVariable("horaFin", $horaFin, false);
        $this->view->setVariable("inicioInscripcion", $inicioInscripcion, false);
        $this->view->setVariable("finInscripcion", $finInscripcion, false);
        $this->view->render("partido", "index");
    }

    public function verPistasFechaPartido() {
        if (isset($_REQUEST['fecha'])) {
            $dia = $_REQUEST["fecha"];
            $fecha = $this->gestionarReservasMapper->findByFecha($dia);
            $this->view->setVariable("fecha", $fecha, false);
            $this->view->render("partido", "index");
        }
    }

    public function comprobarReservaPartido() {
        $pista = $_REQUEST["pista"];
        $hora = $_REQUEST["hora"];
        $fecha = $_REQUEST["fecha"];
        $disponibilidad = $_REQUEST["disponibilidad"];
        $minutosAumentar = 90;
        $segundos_horaInicio = strtotime($hora);
        $segundos_minutoAumentar = $minutosAumentar * 60;
        $horaFinal = date("H:i", $segundos_horaInicio + $segundos_minutoAumentar);

        $this->view->setVariable("pista", $pista, false);
        $this->view->setVariable("hora", $hora, false);
        $this->view->setVariable("fecha", $fecha, false);
        $this->view->setVariable("disponibilidad", $disponibilidad, false);
        $this->view->setVariable("horaFinal", $horaFinal, false);
        $this->view->render("partido", "reserva");
    }
    
     public function anadirReservaPartido() {
        $reserva = new RealizarReserva();
        $pista = $_REQUEST["pista"];
        $hora = $_REQUEST["hora"];
        $horaFin = $_REQUEST["horaFinal"];
        $fecha = $_REQUEST["fecha"];
        $disponibilidad = $_REQUEST["disponibilidad"];
        $reserva->setPistaIdPista($pista);
        $reserva->setHoraInicio($hora);
        $reserva->setHoraFin($horaFin);
        $reserva->setFecha($fecha);
        //HACE FALTA SER ADMIN
        $reserva->setUsuarioRegistradousuario('admin');
        if ($disponibilidad == 'disponible') {
            $disponibilidad = 'ocupado';
            $reserva->setDisponibilidad('ocupado');
            
            $partido = new Partido();
            $partido->setFecha($fecha);
            $partido->setHoraInicio($hora);
            $partido->setHoraFin($horaFin);
            $idPartido = $this->partidoMapper->save($partido);
            $idReserva = $this->realizarReservaMapper->insertarReserva2($reserva);
            $partidoReserva = new PartidoReserva();
            $partidoReserva->setIdPartido($idPartido);
            $partidoReserva->setIdReserva($idReserva);
            $this->partidoReservaMapper->save($partidoReserva);
            
            $this->gestionarReservasMapper->updateHorario($disponibilidad, $pista, $hora, $fecha, 0);
            
        } else {
            $disponibilidad = 'disponible';
            $reserva->setDisponibilidad('disponible');
            $this->realizarReservaMapper->cancelarReserva2($reserva);
            $this->gestionarReservasMapper->updateHorario($disponibilidad, $pista, $hora, $fecha, 0 );
        }
        //MOSTRAR MENSAJE ERROR O CORRECTA EJECUCION
        $partidos = $this->partidoMapper->findAll();
        $this->view->setVariable("partidos", $partidos, false);
        $this->view->render("partido", "index");
    }

}
