<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();

$currentuser = $view->getVariable("currentuser");
$currentype = $view->getVariable("currenttype");


?><!DOCTYPE html>
<html>
<head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" type="text/css">
	<!-- enable ji18n() javascript function to translate inside your scripts -->
	<script src="index.php?controller=language&amp;action=i18njs">
	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


	<script type="text/javascript">
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();

  // Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});
			$(this).parents("tr").find(".edit").toggle();
			//$(".add-new").removeAttr("disabled");
		}
    });

	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:nth-child(1)):not(:nth-child(2)):not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".edit").toggle();
		//$(".add-new").attr("disabled", "disabled");
    });

		$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
	var pareja1 = button.data('pareja1')
	var pareja2 = button.data('pareja2')
	var set1 = button.data('set1')
	var set2 = button.data('set2')
	var set3 = button.data('set3')
	var grupo = button.data('grupo')
	var liga = button.data('liga')

  var modal = $(this)
  modal.find('.modal-title').text('Grupo: ' + grupo + ' - Liga: ' + liga)
	modal.find('#pareja1').val(pareja1)
	modal.find('#pareja2').val(pareja2)
  modal.find('#set1').val(set1)
	modal.find('#set2').val(set2)
	modal.find('#set3').val(set3)
})


});
</script>



	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
</head>
<body>

	<?php if($currentype=="admin"): ?>
	<!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php?controller=home&amp;action=index">UNIPADEL</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php?controller=gestionarReservas&amp;action=index">Reservas<span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Campeonatos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="index.php?controller=campeonato&amp;action=index">Crear campeonato</a>
            <a class="dropdown-item" href="index.php?controller=enfrentamiento&amp;action=index">Enfrentamientos</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="index.php?controller=partidos&amp;action=index" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Partidos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="index.php?controller=partidos&amp;action=index">Promocionar partido</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=pistas&amp;action=index">Pistas</a>
        </li>

    </div>
  </nav>
<?php elseif($currentype=="deportista"): ?>
	<!-- Header Usuario deportista-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php?controller=home&amp;action=index">UNIPADEL</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php?controller=gestionarReservas&amp;action=index">Reservas<span class="sr-only">(current)</span></a>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Campeonatos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="index.php?controller=campeonato&amp;action=index">Consultar campeonatos</a>
						<a class="dropdown-item" href="index.php?controller=enfrentamiento&amp;action=index">Enfrentamientos</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="index.php?controller=partidos&amp;action=index" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Partidos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="index.php?controller=partidos&amp;action=index">Promocionar partido</a>
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=pistas&amp;action=index">Pistas</a>
				</li>

		</div>
	</nav>

<?php else: ?>
	<!-- Header default-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php?controller=home&amp;action=index">UNIPADEL</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php?controller=gestionarReservas&amp;action=index">Reservas<span class="sr-only">(current)</span></a>
				</li>


				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Campeonatos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="index.php?controller=campeonato&amp;action=index">Campeonatos</a>
						<a class="dropdown-item" href="index.php?controller=campeonato&amp;action=index">Crear campeonato</a>
						<a class="dropdown-item" href="index.php?controller=enfrentamiento&amp;action=index">Enfrentamientos</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="index.php?controller=partidos&amp;action=index" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Partidos
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="index.php?controller=partido&amp;action=index">Crear partido</a>
					</div>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="index.php?controller=establecerPistas&amp;action=index">Pistas</a>
				</li>

		</div>
	</nav>
<?php endif ?>
  <!-- /Header -->

	<main>
		<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

	<footer>

	</footer>

</body>
</html>
