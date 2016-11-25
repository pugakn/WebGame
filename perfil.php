<?php
session_start();

	if(!isset($_SESSION["player_email"])){
		//Redirijo hacia el inicio de sesion
		header("location: ExamenFinal.php");
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Perfil</title>
		<script type="text/javascript" scr="bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
	</head>
	<body>
		</br><p class="text-right col-sm-11"><?php echo $_SESSION["player_name"] . " " . $_SESSION["player_lastname"] . "Cerrar cesión" ?></p></br>

		<div class="text-center">
			<h1>Bienvenido <?php echo $_SESSION["player_name"] . " " . $_SESSION["player_lastname"]; ?></h1>
			<p>Inicia una partida, ó revisa las puntuaciuones del juego</p>
			<button type="button">Jugar!</button>
		</div>

		<div class="text-center">
			<h2>Tus estadísticas</h2>
			<?php

			?>
			<h2>Estadísticas generales</h2>
		</div>


	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</body>
</html>