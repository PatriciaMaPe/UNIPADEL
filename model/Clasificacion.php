<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");

require_once(__DIR__."/../model/Campeonato.php");
require_once(__DIR__."/../model/Pareja.php");
require_once(__DIR__."/../model/Grupo.php");

/**
* Class Post
*
* Represents a Post in the blog. A Post was written by an
* specific User (author) and contains a list of Comments
*
* @author Patricia
*/
class Clasificacion {

	/**
	* The id of this post
	* @var int
	*/
	private $idClasificacion;

	/**
	* The title of this post
	* @var Pareja
	*/
	private $pareja;

	/**
	* The title of this post
	* @var int
	*/
	private $resultado;
	/**
	* The title of this post
	* @var Grupo
	*/
	private $grupo;
	/**
	* The title of this post
	* @var Campeonato
	*/
	private $campeonato;


	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($idClasificacion=NULL, Pareja $pareja=NULL, $resultado=NULL, Grupo $grupo=NULL, Campeonato $campeonato=NULL) {
		$this->idClasificacion = $idClasificacion;
		$this->pareja = $pareja;
		$this->resultado = $resultado;
		$this->grupo = $grupo;
		$this->campeonato = $campeonato;

	}

	/**
	* Gets the id of this post
	*
	* @return string The id of this post
	*/
	public function getIdClasificacion() {
		return $this->idClasificacion;
	}

	/**
	* Gets the title of this post
	*
	* @return Pareja The title of this post
	*/
	public function getPareja() {
		return $this->pareja;
	}
	public function getResultado() {
		return $this->resultado;
	}
	public function getGrupo() {
		return $this->grupo;
	}
	public function getCampeonato() {
		return $this->campeonato;
	}


	/**
	* Checks if the current instance is valid
	* for being updated in the database.
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForCreate() {
		$errors = array();
		if (strlen(trim($this->title)) == 0 ) {
			$errors["title"] = "title is mandatory";
		}
		if (strlen(trim($this->content)) == 0 ) {
			$errors["content"] = "content is mandatory";
		}
		if ($this->author == NULL ) {
			$errors["author"] = "author is mandatory";
		}

		if (sizeof($errors) > 0){
			throw new ValidationException($errors, "post is not valid");
		}
	}

	/**
	* Checks if the current instance is valid
	* for being updated in the database.
	*
	* @throws ValidationException if the instance is
	* not valid
	*
	* @return void
	*/
	public function checkIsValidForUpdate() {
		$errors = array();

		if (!isset($this->id)) {
			$errors["id"] = "id is mandatory";
		}

		try{
			$this->checkIsValidForCreate();
		}catch(ValidationException $ex) {
			foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
			}
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "post is not valid");
		}
	}
}
