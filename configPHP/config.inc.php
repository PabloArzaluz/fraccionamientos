<?php
	//Local Database
	include("conecta.inc.php");
	
	// Nueva version de conexion
	$mysqliConn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$mysqliConn) {
		die("Error de conexión: " . mysqli_connect_error());
	}


	mysqli_set_charset($mysqliConn, "utf8");


	// 2. Validación simple de acceso
	// Verificamos si existe la variable de sesión que identifica al usuario
	// Si no existe, significa que la sesión expiró por tiempo natural o nunca se inició
	if (!isset($_SESSION['id_usuario'])) {
		// Si no es la página de login, redirigir al usuario
		// Nota: Asegúrate de que tu archivo de login NO incluya esta validación
		header("Location: index.php");
		exit();
	}
	?>
?>