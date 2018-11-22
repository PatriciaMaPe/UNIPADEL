<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class Campeonato
*
* Representa un campeonato celebrado en el club
*
*/
class Campeonato {

	/**
	* El id del campeonato
	* @var int
	*/
	private $idCampeonato;

	private $nombreCampeonato;

	/**
	* The password of the user
	* @var DateTime
	*/
	private $fechaInicio;

	/**
	* The password of the user
	* @var DateTime
	*/
	private $fechaFin;

	/**
	* The password of the user
	* @var DateTime
	*/
	private $fechaInicioInscripciones;

	/**
	* The password of the user
	* @var DateTime
	*/
	private $fechaFinInscripciones;

	private $reglas;

	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($idCampeonato=NULL, $nombreCampeonato=NULL, $fechaInicio=NULL, $fechaFin=NULL, $fechaInicioInscripciones=NULL, $fechaFinInscripciones=NULL, $reglas=NULL) {
		$this->idCampeonato = $idCampeonato;
		$this->nombreCampeonato = $nombreCampeonato;
		$this->fechaInicio = $fechaInicio;
		$this->fechaFin = $fechaFin;
		$this->fechaInicioInscripciones = $fechaInicioInscripciones;
		$this->fechaFinInscripciones = $fechaFinInscripciones;
		$this->reglas = $reglas;
	}

	/**
	* Gets the username of this user
	*
	* @return int The username of this user
	*/
	public function getIdCampeonato() {
		return $this->idCampeonato;
	}

	public function getNombreCampeonato() {
			return $this->nombreCampeonato;
	}

	/**
	* Gets the username of this user
	*
	* @return DateTime The username of this user
	*/
	public function getFechaInicio() {
		return $this->fechaInicio;
	}

	/**
	* Gets the username of this user
	*
	* @return DateTime The username of this user
	*/
	public function getFechaFin() {
		return $this->fechaFin;
	}

	public function getFechaInicioInscripciones() {
			return $this->fechaInicioInscripciones;
	}

	public function getFechaFinInscripciones() {
			return $this->fechaFinInscripciones;
	}

	public function getReglas() {
			return $this->reglas;
	}

	public function setIdCampeonato($idCampeonato) {
			$this->idCampeonato = $idCampeonato;
	}

	public function setNombreCampeonato($nombreCampeonato) {
			$this->nombreCampeonato = $nombreCampeonato;
	}

	public function setFechaInicio($fechaInicio) {
			$this->fechaInicio = $fechaInicio;
	}

	public function setFechaFin($fechaFin) {
			$this->fechaFin = $fechaFin;
	}

	public function setFechaInicioInscripciones($fechaInicioInscripciones) {
			$this->fechaInicioInscripciones = $fechaInicioInscripciones;
	}

	public function setFechaFinInscripciones($fechaFinInscripciones) {
			$this->fechaFinInscripciones = $fechaFinInscripciones;
	}

	public function setReglas($reglas) {
			$this->reglas = $reglas;
	}

	/**
	 * Checks if the current instance is valid
	 * for being inserted in the database.
	 *
	 * @throws ValidationException if the instance is
	 * not valid
	 *
	 * @return void
	 */
	public function checkIsValidForCreate() {
			$errors = array();
			if ($this->idCampeonato == NULL) {
					$errors["idCampeonato"] = "Identificador de campeonato no encontrado";
			}
			if ($this->fechaInicio == NULL) {
					$errors["fechaInicio"] = "Fecha de inicio de campeonato no encontrada";
			}
			if ($this->fechaFin == NULL) {
					$errors["fechaFin"] = "Fecha de finalización de campeonato no encontrada";
			}
			if ($this->inicioInscripcion == NULL) {
					$errors["inicioInscripcion"] = "Fecha de inicio de inscipciones de campeonato no encontrada";
			}
			if ($this->finInscripcion == NULL) {
					$errors["finIncsipcion"] = "Fecha de finalización de inscripciones de campeonato no encontrada";
			}
			if (sizeof($errors) > 0) {
					throw new ValidationException($errors, "Creacion de campeonato no valida");
			}
	}
}
