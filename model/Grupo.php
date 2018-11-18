<?php
// file: model/Post.php

require_once(__DIR__."/../core/ValidationException.php");

/**
* Class Post
*
* Represents a Post in the blog. A Post was written by an
* specific User (author) and contains a list of Comments
*
* @author Patricia
*/
class Grupo {

	/**
	* The id of this post
	* @var int
	*/
	private $idGrupo;

	/**
	* The title of this post
	* @var Campeonato
	*/
	private $campeonato;

	/**
	* The content of this post
	* @var Categoria
	*/
	private $categoria;

	/**
	* The content of this post
	* @var string
	*/
	private $tipoLiga;

	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($idGrupo=NULL, Campeonato $campeonato=NULL, Categoria $categoria=NULL, $tipoLiga=NULL) {
		$this->idGrupo = $idGrupo;
		$this->campeonato = $campeonato;
		$this->categoria = $categoria;
		$this->tipoLiga = $tipoLiga;

	}

	/**
	* Gets the id of this post
	*
	* @return int The id of this post
	*/
	public function getIdGrupo() {
		return $this->idGrupo;
	}

	/**
	* Gets the title of this post
	*
	* @return int The title of this post
	*/
	public function getCampeonato() {
		return $this->campeonato;
	}


	/**
	* Gets the content of this post
	*
	* @return int The content of this post
	*/
	public function getCategoria() {
		return $this->categoria;
	}

	/**
	* Gets the content of this post
	*
	* @return int The content of this post
	*/
	public function getTipoLiga() {
		return $this->tipoLiga;
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
