<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class User
*
* Representa un campeonato celebrado en el club
*
* @author Patricia
*/
class Campeonato {

	/**
	* El nombre del usuario
	* @var int
	*/
	private $idCampeonato;

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

	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($idCampeonato=NULL, $fechaInicio=NULL, $fechaFin=NULL, $fechaInicioInscripciones=NULL, $fechaFinInscripciones=NULL) {
		$this->idCampeonato = $idCampeonato;
		$this->fechaInicio = $fechaInicio;
		$this->fechaFin = $fechaFin;
		$this->fechaInicioInscripciones = $fechaInicioInscripciones;
		$this->fechaFinInscripciones = $fechaFinInscripciones;
	}

	/**
	* Gets the username of this user
	*
	* @return int The username of this user
	*/
	public function getIdCampeonato() {
		return $this->idCampeonato;
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

	/**
	* Checks if the current user instance is valid
	* for being registered in the database
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->usuario) < 3) {
			$errors["usuario"] = "Username must be at least 3 characters length";

		}
		if (strlen($this->password) < 3) {
			$errors["password"] = "Password must be at least 3 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}
}
