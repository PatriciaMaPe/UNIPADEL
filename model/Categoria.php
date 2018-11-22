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
class Categoria {

	/**
	* El nombre del usuario
	* @var int
	*/
	private $idCategoria;

	/**
	* The password of the user
	* @var int
	*/
	private $nivel;

	/**
	* The password of the user
	* @var string
	*/
	private $tipo;

	/**
	* The password of the user
	* @var int
	*/
	private $maxParticipantes;

	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($idCategoria=NULL, $nivel=NULL, $tipo=NULL, $maxParticipantes=NULL) {
		$this->idCategoria = $idCategoria;
		$this->nivel = $nivel;
		$this->tipo = $tipo;
		$this->maxParticipantes = $maxParticipantes;
	}

	/**
	* Gets the username of this user
	*
	* @return int The username of this user
	*/
	public function getIdCategoria() {
		return $this->idCategoria;
	}

	/**
	* Gets the username of this user
	*
	* @return int The username of this user
	*/
	public function getNivel() {
		return $this->nivel;
	}

	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getTipo() {
		return $this->tipo;
	}

	/**
	* Gets the username of this user
	*
	* @return int The username of this user
	*/
	public function getMaxParticipantes() {
		return $this->maxParticipantes;
	}

	public function setIdCategoria($idCategoria) {
			$this->idCategoria = $idCategoria;
	}

	public function setNivel($nivel) {
			$this->nivel = $nivel;
	}

	public function setTipo($tipo) {
			$this->tipo = $tipo;
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
