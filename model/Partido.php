<?php

// file: model/Partido.php
require_once(__DIR__ . "/../core/ValidationException.php");

/**
 * Class Partido
 *
 */
class Partido {

    private $idPartido;
    private $fecha;
    private $horaInicio;
    private $horaFin;
    private $inicioInscripcion;
    private $finInscripcion;

    public function __construct($idPartido = NULL, $fecha = NULL, $horaInicio = NULL, $horaFin = NULL, $inicioInscripcion = NULL, $finInscripcion = NULL) {

        $this->idPartido = $idPartido;
        $this->fecha = $fecha;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->inicioInscripcion = $inicioInscripcion;
        $this->finInscripcion = $finInscripcion;
    }

    public function getIdPartido() {
        return $this->idPartido;
    }
    

    public function getFecha() {
        return $this->fecha;
    }
    
    public function getHoraInicio() {
        return $this->horaInicio;
    }

    public function getHoraFin() {
        return $this->horaFin;
    }

    public function getInicioInscripcion() {
        return $this->inicioInscripcion;
    }

    public function getFinInscripcion() {
        return $this->finInscripcion;
    }

    public function setIdPartido($idPartido) {
        $this->idPartido = $idPartido;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    
    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;
    }

    public function setHoraFin($horaFin) {
        $this->horaFin = $horaFin;
    }

    public function setInicioInscripcion($inicioInscripcion) {
        $this->inicioInscripcion = $inicioInscripcion;
    }

    public function setFinInscripcion($finInscripcion) {
        $this->finInscripcion = $finInscripcion;
    }

}

