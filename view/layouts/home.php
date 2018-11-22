<?php
// file: view/layouts/welcome.php

$view = ViewManager::getInstance();
//$currentuser = $view->getVariable("currentuser");
//$currentype = $view->getVariable("currenttype");

//var_dump("home");
//var_dump($currentuser);
//var_dump($currentype);
$errors = $view->getVariable("errors");

?><!DOCTYPE html>
<html>
<head>
	<title><?= $view->getVariable("title", "home") ?></title>
	<meta charset="utf-8">
	<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" type="text/css">
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>
	<header>
		<h3 class="display-3 text-center"><?= "Club UNIPADEL!" ?></h3>
	</header>
	<main>
		<!-- flash message -->
		<div id="flash">
			<?= $view->popFlash() ?>
		</div>


		<h1> Iniciar sesion </h1>

		<?php if($errors["general"]!=NULL): ?>
		<div class="alert alert-danger" role="alert">
		  <?= $errors["general"] ?>
		</div>
		<?php endif ?>

		<form action="index.php?controller=usuarioRegistrado&amp;action=login" method="POST">
		  <div class="form-group col-md-6">
		    <label for="inputUsuario">Usuario</label>
		    <input name="username" type="text" class="form-control" placeholder="Usuario">
		  </div>

		  <div class="form-group col-md-6">
		    <label for="inputPassword">Password</label>
		    <input name="passwd" type="password" class="form-control" placeholder="Password">
		  </div>

		  <div class="form-group">
		  <button type="submit" class="btn btn-primary" value="Login">Login</button>
		  </div>
		</form>

		<p>Not user? <a href="index.php?controller=usuarioController&amp;action=register"> Register here!</a></p>


		    <!--
		    <div id="noticias" class="container">
					<div class="row justify-content-md-center">
		  <div class="card col-sm-12 col-md-8 col-lg-5 col-xl-3" >
		    <img class="card-img-top" src="../assets/padel1.jpg" alt="Card image cap">
		    <div class="card-body">
		      <h5 class="card-title">IV Campeonato</h5>
		      <p class="card-text">Lorem ipsum dolor sit amet consectetur adipiscing, elit facilisi fusce varius sodales,
		        aenean facilisis aliquet condimentum praesent.</p>
		        <button type="button" class="btn btn-lg btn-block btn-light">Inscribirse</button>
		    </div>
		  </div>

		  <div class="card col-sm-12 col-md-8 col-lg-5 col-xl-3">
		    <img class="card-img-top" src="padel1.jpg" alt="Card image cap">
		    <div class="card-body">
		      <h5 class="card-title">Nuevos horarios de pistas</h5>
		      <p class="card-text">Lorem ipsum dolor sit amet consectetur adipiscing, elit facilisi fusce varius sodales,
		        aenean facilisis aliquet condimentum praesent. Lorem ipsum dolor sit amet consectetur adipiscing.Lorem ipsum dolor sit amet consectetur adipiscing.</p>
		        <button type="button" class="btn btn-lg btn-block btn-light">Consultar horarios</button>
		    </div>
		  </div>

		  <div class="card col-sm-12 col-md-8 col-lg-5 col-xl-3">
		    <img class="card-img-top" src="../assets/padel1.jpg" alt="Card image cap">
		    <div class="card-body">
		      <h5 class="card-title">Abrimos nuevo centro de padel</h5>
		      <p class="card-text">Lorem ipsum dolor sit amet consectetur adipiscing, elit facilisi fusce varius sodales,
		        aenean facilisis aliquet condimentum praesent.</p>
		        <button type="button" class="btn btn-lg btn-block btn-light">+ Informacion</button>
		    </div>
		  </div>

		</div>
		</div>
		    /Cards -->
	</main>

</body>
</html>
