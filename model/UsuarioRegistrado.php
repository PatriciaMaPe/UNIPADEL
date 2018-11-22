<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class User
*
* Representa un usuario preteneciente al club
*
* @author Patricia
*/
class UsuarioRegistrado {

	/**
	* El nombre del usuario
	* @var string
	*/
	private $usuario;

	/**
	* The password of the user
	* @var string
	*/
	private $password;

	/**
	* The password of the user
	* @var string
	*/
	private $nombre;

	/**
	* The password of the user
	* @var string
	*/
	private $apellido;

	/**
	* The password of the user
	* @var string
	*/
	private $tipo;

	/**
	* The constructor
	*
	* @param string $username The name of the user
	* @param string $passwd The password of the user
	*/
	public function __construct($usuario=NULL, $password=NULL, $nombre=NULL, $apellido=NULL, $tipo=NULL) {
		$this->usuario = $usuario;
		$this->password = $password;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->tipo = $tipo;
	}

	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getUsuario() {
		return $this->usuario;
	}

	/**
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}

	/**
	* Gets the password of this user
	*
	* @return string The password of this user
	*/
	public function getPassword() {
		return $this->password;
	}
	/**
	* Sets the password of this user
	*
	* @param string $passwd The password of this user
	* @return void
	*/
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getNombre() {
		return $this->nombre;
	}

	/**
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	* Gets the username of this user
	*
	* @return string The username of this user
	*/
	public function getApellido() {
		return $this->apellido;
	}

	/**
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
	public function setApellido($apellido) {
		$this->apellido = $apellido;
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
	* Sets the username of this user
	*
	* @param string $username The username of this user
	* @return void
	*/
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
