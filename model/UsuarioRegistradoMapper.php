<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");

/**
* Class UserMapper
*
* Database interface for User entities
*
* @author Patricia
*/
class UsuarioRegistradoMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Carga un Usuario de la base de datos dado su nombre de usuario
	*
	* @throws PDOException si ocurre un error en la base de datos
	* @return Post La instancia Usuario. NULL si no se encuentra el usuario
	*/
	public function findById($nombreUsuario){
		$stmt = $this->db->prepare("SELECT * FROM UsuarioRegistrado WHERE usuario=?");
		$stmt->execute(array($nombreUsuario));
		$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

		if($usuario != null) {
			return new UsuarioRegistrado(
			$usuario["usuario"],
			$usuario["password"],
			$usuario["nombre"],
			$usuario["apellido"],
			$usuario["tipoUsuario"]);
		} else {
			return NULL;
		}
	}

	/**
	* Saves a User into the database
	*
	* @param User $user The user to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO UsuarioRegistrado values (?,?,?,?,?)");
		$stmt->execute(array($user->getUsuario(), $user->getPassword(), $user->getNombre(),$user->getApellido(), $user->getTipo()));
	}

	/**
	* Checks if a given username is already in the database
	*
	* @param string $username the username to check
	* @return boolean true if the username exists, false otherwise
	*/
	public function usernameExists($username) {
		$stmt = $this->db->prepare("SELECT count(usuario) FROM UsuarioRegistrado where usuario=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	/**
	* Checks if a given pair of username/password exists in the database
	*
	* @param string $username the username
	* @param string $passwd the password
	* @return boolean true the username/passwrod exists, false otherwise.
	*/
	public function isValidUser($username, $passwd) {
		$stmt = $this->db->prepare("SELECT count(usuario) FROM UsuarioRegistrado where usuario=? and password=?");
		$stmt->execute(array($username, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
}
