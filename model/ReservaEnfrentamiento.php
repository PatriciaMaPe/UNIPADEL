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
class ReservaEnfrentamiento {

	/**
	* The id of this post
	* @var int
	*/
	private $idReserva;

	/**
	* The id of this post
	* @var int
	*/
	private $idEnfrentamiento;


	/**
	* The constructor
	*
	* @param int $idReserva
	* @param int $idEnfrentamiento
	*/
	public function __construct($idReserva=NULL, $idEnfrentamiento=NULL, $idPista=NULL) {
		$this->idEnfrentamiento = $idEnfrentamiento;
		$this->idReserva = $idReserva;
		$this->idPista = $idPista;
	}

	/**
	* Gets the id of this post
	*
	* @return int The id of this post
	*/
	public function getIdReserva() {
		return $this->idReserva;
	}

	/**
	* Gets the id of this post
	*
	* @return int The id of this post
	*/
	public function getIdEnfrentamiento() {
		return $this->idEnfrentamiento;
	}

	public function getIdPista() {
		return $this->idPista;
	}


}
