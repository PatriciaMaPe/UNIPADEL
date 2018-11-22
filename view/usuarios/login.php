<?php
//file: view/users/login.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "");
$errors = $view->getVariable("errors");
?>

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
