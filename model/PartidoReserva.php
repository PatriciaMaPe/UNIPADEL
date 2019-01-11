<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class PartidoReserva {

    private $idPartido;
    private $idReserva;

    public function __construct($idPartido = NULL, $idReserva = NULL) {
        $this->idPartido = $idPartido;
        $this->idReserva = $idReserva;
    }

    public function getIdPartido() {
        return $this->idPartido;
    }

    public function getIdReserva() {
        return $this->idReserva;
    }

    public function setIdPartido($idPartido) {
        $this->idPartido = $idPartido;
    }

    public function setIdReserva($idReserva) {
        $this->idReserva = $idReserva;
    }
    
}

