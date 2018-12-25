<?php
//file: controller/HomeController.php


require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");


/**
* Class HomeController
*
*
* @author Patricia
*/
class HomeController extends BaseController {


	public function __construct() {
		parent::__construct();

	}

	/**
 	*
	*/
	public function index() {
		if(isset($_SESSION["currentuser"])){
			$this->view->render("layouts", "home");
		}else{
			$this->view->redirect("usuarioRegistrado", "login");
		}


	}




}
