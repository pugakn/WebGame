<?php
error_reporting(E_ALL);
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<script type="text/javascript" scr="bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>
	</head>
 	<body>
 		<h1>Registro de nuevo jugador</h1>
 		<h2>!Introduce tus datos, y comienza a jugar!</h2>

 		<?php 
		if(isset($_POST['cmd_enviar'])){

			$errors = array();

			$name = $_POST['txt_name'];
			$lastname = $_POST['txt_lastname'];
			$email = $_POST['txt_email'];
			$password = $_POST['txt_password'];
			$rpassword = $_POST['txt_rpassword'];
			$photo = $_FILES['file_photo'];

			if(empty($name)) $errors[] = "El nombre es un campo requerido";

			if(empty($lastname)) $errors[] = "El apellido es un campo requerido";

			//Validacion del correo electronico
			if(empty($email)) $errors[] = "El email es un campo requerido";
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "El email no es válido";			

			if(empty($password)) $errors[] = "La contraseña es un campo requerido";

			if(empty($rpassword)) $errors[] = "La contraseña es un campo requerido";

			if( ($photo['size'] / 1024) > 700) $errors[] = "La imagen es invalida - Es muy pesada";

			if( ($photo['type'] != "image/png") && 
				($photo['type'] != "image/jpg") && 
				($photo['type'] != "image/gif")) $errors[] = "La imagen no es png, jpg, o gif";	
	
			if($password != $rpassword) $errors[] = "La contraseña no coincide";

			if(!empty($errors)){
				echo "<ul><li>";
				echo implode("</li><li>", $errors);
				echo "</li></ul>";
			} else {

				/*$files_folder = "img_profiles/";
				if(!file_exists($files_folder)){
					mkdir($files_folder);
				}
				rename($_FILES["file_photo"]["tmp_name"], $files_folder . $_FILES["file_photo"]["name"]);

				//Defino nombre de archivo
				$nombre_archivo = "datos.csv";
				//Creo un puntero/recurso para manejar el archivo. "a" crea el archivo si no existe
				//y coloca el puntero de escritura al final del archivo. Más info: http://php.net/manual/es/function.fopen.php
				$file = fopen($nombre_archivo, "a");
				//Creamos un arreglo de datos
				$datos = array($email, $password, $name, $lastname, $_FILES["file_photo"]["name"]);
				//Insertamos los datos de $datos en el archivo abierto por $file con la función fputcsv
				//http://php.net/manual/es/function.fputcsv.php
				fputcsv($file, $datos);
				//Cerramos el puntero
				fclose($file);
				//Presentamos mensaje de que los datos fueron guardados con éxito
				echo '<script type="text/javascript">alert("Datos guardados con exito")</script>';
				header("location: ExamenFinal.php");*/

				$servername = "localhost";
				$username = "root";
				$password = "";
				$db_name = "videojuego";

				$conn = new mysqli($servername, $username, $password,$db_name);

				if($conn->connect_error){
					die("Connection failed " . $conn->connect_error);
				}
				echo "Connect succesfully";

				//Para registrar datos
				$sql = "INSERT INTO usuarios(email, password, name, lastname) VALUES('" . $_POST['txt_email'] . "', '" . md5($_POST['txt_password']). "', '" . $_POST['txt_name'] 
				. "', '" . $_POST['txt_lastname'] ."');";
				$result = $conn->query($sql);
				if($result === TRUE){
					echo "El registro se creo con exito";
				} else {
					echo "Error al crear registro" . $conn->errors;
				}
				}
				header("location: ExamenFinal.php");
				$conn->close();
			}
		?>

 		<form action="registro.php" method="post" enctype="multipart/form-data">
 			<p><span>Nombre:</span><input type="text" name="txt_name"></p>
 			<p><span>Apellido:</span><input type="text" name="txt_lastname"></p>
 			<p><span>Email:</span><input type="text" name="txt_email"></p>
 			<p><span>Contraseña:</span><input type="password" name="txt_password"></p>
 			<p><span>Repetir contraseña:</span><input type="password" name="txt_rpassword"></p>
 			<p><span>Foto de perfil:</span><input type="file" name="file_photo"></p>
 			<input type="submit" name="cmd_enviar" value="Registrar"><input type="reset" name="cmd_cancelar" value="Cancelar">
 		</form>
 		

 		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 	</body>
</html>
