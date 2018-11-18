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
class Enfrentamiento {

	/**
	* The id of this post
	* @var int
	*/
	private $idEnfrentamiento;

	/**
	* The title of this post
	* @var Pareja
	*/
	private $pareja1;

	/**
	* The content of this post
	* @var Pareja
	*/
	private $pareja2;

	/**
	* The author of this post
	* @var string
	*/
	private $set1;

	/**
	* The author of this post
	* @var string
	*/
	private $set2;

	/**
	* The author of this post
	* @var string
	*/
	private $set3;

	/**
	* The list of comments of this post
	* @var string
	*/
	private $resultado;

	/**
	* The list of comments of this post
	* @var Grupo
	*/
	private $grupo;

	/**
	* The constructor
	*
	* @param int $idEnfrentamiento The id of the post
	* @param Pareja $idPareja1 The id of the post
	* @param Pareja $idPareja2 The content of the post
	* @param string $set1 The author of the post
	* @param string $set2 The author of the post
	* @param string $set3 The author of the post
	* @param string $resultado The list of comments
	*/
	public function __construct($idEnfrentamiento=NULL, Pareja $pareja1=NULL, Pareja $pareja2=NULL,
															$set1=NULL, $set2=NULL, $set3=NULL, $resultado=NULL, Grupo $grupo=NULL) {
		$this->idEnfrentamiento = $idEnfrentamiento;
		$this->pareja1 = $pareja1;
		$this->pareja2 = $pareja2;
		$this->set1 = $set1;
		$this->set2 = $set2;
		$this->set3 = $set3;
		$this->resultado = $resultado;
		$this->grupo = $grupo;

	}

	/**
	* Gets the id of this post
	*
	* @return int The id of this post
	*/
	public function getIdEnfrentamiento() {
		return $this->idEnfrentamiento;
	}

	/**
	* Gets the title of this post
	*
	* @return Pareja The title of this post
	*/
	public function getPareja1() {
		return $this->pareja1;
	}

	/**
	* Gets the title of this post
	*
	* @return Pareja The title of this post
	*/
	public function getPareja2() {
		return $this->pareja2;
	}

	/**
	* Gets the title of this post
	*
	* @return string The title of this post
	*/
	public function getSet1() {
		return $this->set1;
	}
	/**
	* Gets the title of this post
	*
	* @return string The title of this post
	*/
	public function getSet2() {
		return $this->set2;
	}

	/**
	* Gets the title of this post
	*
	* @return string The title of this post
	*/
	public function getSet3() {
		return $this->set3;
	}

	/**
	* Gets the title of this post
	*
	* @return string The title of this post
	*/
	public function getResultado() {
		return $this->resultado;
	}

	/**
	* Gets the title of this post
	*
	* @return Grupo The title of this post
	*/
	public function getGrupo() {
		return $this->grupo;
	}

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function setSet1($set) {
		$this->set1 = $set;
	}

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function setSet2($set) {
		$this->set2 = $set;
	}

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function setSet3($set) {
		$this->set3 = $set;
	}

	/**
	* Sets the title of this post
	*
	* @param string $title the title of this post
	* @return void
	*/
	public function setResultado($res) {
		$this->resultado = $res;
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
