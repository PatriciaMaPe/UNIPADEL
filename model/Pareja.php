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
class Pareja {

	/**
	* The id of this post
	* @var int
	*/
	private $idPareja;

	/**
	* The title of this post
	* @var UsuarioRegistrado
	*/
	private $capitan;

	/**
	* The content of this post
	* @var UsuarioRegistrado
	*/
	private $deportista;

	/**
	* The author of this post
	* @var int
	*/
	private $idGrupo;

	/**
	* The constructor
	*
	* @param string $id The id of the post
	* @param string $title The id of the post
	* @param string $content The content of the post
	* @param User $author The author of the post
	* @param mixed $comments The list of comments
	*/
	public function __construct($idPareja=NULL, UsuarioRegistrado $capitan=NULL, UsuarioRegistrado $deportista=NULL, $idGrupo=NULL) {
		$this->idPareja = $idPareja;
		$this->capitan = $capitan;
		$this->deportista = $deportista;
		$this->idGrupo = $idGrupo;

	}

	/**
	* Gets the id of this post
	*
	* @return string The id of this post
	*/
	public function getIdPareja() {
		return $this->idPareja;
	}

	/**
	* Gets the title of this post
	*
	* @return UsuarioRegistrado The title of this post
	*/
	public function getCapitan() {
		return $this->capitan;
	}

	/**
	* Gets the title of this post
	*
	* @return UsuarioRegistrado The title of this post
	*/
	public function getDeportista() {
		return $this->deportista;
	}

	/**
	* Gets the title of this post
	*
	* @return int The title of this post
	*/
	public function getIdGrupo() {
		return $this->idGrupo;
	}

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function setIdPareja($idPareja) {
		$this->idPareja = $idPareja;
	}


	/**
	* Sets the author of this post
	*
	* @param UsuarioRegistrado $author the author of this post
	* @return void
	*/
	public function setCapitan(UsuarioRegistrado $capitan) {
		$this->capitan = $capitan;
	}

	/**
	* Sets the author of this post
	*
	* @param UsuarioRegistrado $author the author of this post
	* @return void
	*/
	public function setDeportista(UsuarioRegistrado $deportista) {
		$this->deportista = $deportista;
	}

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function setIdGrupo($idGrupo) {
		$this->idGrupo = $idGrupo;
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
