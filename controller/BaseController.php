<?php
//file: controller/BaseController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/UsuarioRegistrado.php");

/**
 * Class BaseController
 *
 * Implements a basic super constructor for
 * the controllers in the Blog App.
 * Basically, it provides some protected
 * attributes and view variables.
 *
 * @author lipido <lipido@gmail.com>
 */
class BaseController {

	/**
	 * The view manager instance
	 * @var ViewManager
	 */
	protected $view;

	/**
	 * The current user instance
	 * @var UsuarioRegistrado
	 */
	protected $currentUser;

	public function __construct() {

		$this->view = ViewManager::getInstance();

		// get the current user and put it to the view
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if(isset($_SESSION["currentuser"])) {

			$this->currentUser = new UsuarioRegistrado($_SESSION["currentuser"]);
			//add current user to the view, since some views require it
			$this->view->setVariable("currentusername", $this->currentUser->getUsuario());
			$this->view->setVariable("currenttype", $this->currentUser->getTipo());
		}
	}
}
