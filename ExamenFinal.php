<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<script type="text/javascript" scr="bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
	</head>
 	<body>
 		<div class="text-center">
 			<h1>Iniciar seción</h1>
 			<h2>!Empieza a jugar GoogleRex ya!</h2>
 		</div>

 		<?php
		session_start();

		ini_set('display_errors', 1);
		error_reporting(E_ALL);

		if(isset($_POST["cmd_enviar"])){

			$servername = "localhost";
			$username = "root";
			$password = "";
			$db_name = "videojuego";

			$conn = new mysqli($servername, $username, $password,$db_name);

			if($conn->connect_error){
				die("Connection failed " . $conn->connect_error);
			}
			//echo "Connect succesfully";

			//Consulatar Datos
			$sql = "SELECT email, password, name, lastname FROM usuarios ORDER BY email;";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
					//Retorna el registro actual u avanza el punto de los registro de uno en unos
					while($row = $result->fetch_assoc()){
						if($row["email"] == $_POST["txt_username"] && $row["password"] == md5($_POST["txt_password"])){
							$_SESSION["player_name"] = $row["name"];
				        	$_SESSION["player_lastname"] = $row["lastname"];
				        	$_SESSION["player_email"] = $row["email"];
				        	$_SESSION["player_password"] = md5($row["password"]);
				        	//$_SESSION["player_photo"] = $datos[4];
							header("location: perfil.php");
				        } else {
				        	$userExist = false;
				        }
					}

				echo '</br><div class="text-center">';
		 		if(!$userExist) echo "El usuario o la contraseña son incorrectos";
		 		echo '</div></br>';
			}
			$conn->close();

			/*if(file_exists("datos.csv")){
				
				$userExist = true;

				if (($fichero = fopen("datos.csv", "r")) !== FALSE) {
				    while (($datos = fgetcsv($fichero, 1000)) !== FALSE) {
				        // Procesar los datos.
				        if($datos[0] == $_POST["txt_username"] && $datos[1] == $_POST["txt_password"]){
				        	$_SESSION["player_name"] = $datos[2];
				        	$_SESSION["player_lastname"] = $datos[3];
				        	$_SESSION["player_email"] =$datos[0];
				        	$_SESSION["player_password"] =$datos[1];
				        	$_SESSION["player_photo"] =$datos[4];
							header("location: perfil.php");
				        } else {
				        	$userExist = false;
				        }
				    }
				}
				
				echo '</br><div class="text-center">';
		 			if(!$userExist) echo "El usuario o la contraseña son incorrectos";
		 		echo '</div></br>';

			} else {
				echo '<script type="text/javascript">alert("No existe el archivo de origen")</script>';
			}*/
		}

		?>

 		<form class="form-horizontal text-center" action="ExamenFinal.php" method="post" enctype="multipart/form-data">
		  
		  <div class="form-group">
		    <label class="col-sm-2 control-label col-sm-offset-3">Email:</label>
		    <div class="col-sm-3">
		      <input type="email" class="form-control col-sm-4" placeholder="Email" name="txt_username">
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label col-sm-offset-3">Contraseña:</label>
		    <div class="col-sm-3">
		      <input type="password" class="form-control col-sm-4" placeholder="Password" name="txt_password">
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-5">
		      <button type="submit" class="btn btn-default col-sm-4" name="cmd_enviar">Entrar</button>
		    </div>
		  </div>

		</form>

		<p class="text-center"><span>No estas registado aún?</span><a href="registro.php"> registrate aqui</a></p>

 		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 	</body>
</html>

