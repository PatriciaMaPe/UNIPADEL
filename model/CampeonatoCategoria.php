<?php

require_once(__DIR__ . "/../core/ValidationException.php");

class CampeonatoCategoria {

    private $idCategoria;
    private $idCampeonato;

    public function __construct($idCategoria = NULL, $idCampeonato = NULL) {
        $this->idCategoria = $idCategoria;
        $this->idCampeonato = $idCampeonato;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getIdCampeonato() {
        return $this->idCampeonato;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function setIdCampeonato($idCampeonato) {
        $this->idCampeonato = $idCampeonato;
    }

    public function checkIsValidForCreate() {
            
			$errors = array();
                        
			if ($this->idCampeonato == NULL) {
					$errors["idCampeonato"] = "ID de campeonato no encontrado";
			}
			if ($this->idCategoria == NULL) {
					$errors["idCategoria"] = "ID de categoria no encontrado";
			}
			if (sizeof($errors) > 0) {
					throw new ValidationException($errors, "Creacion de Campeonato Categoria no valida");
			}
	}
    
}
