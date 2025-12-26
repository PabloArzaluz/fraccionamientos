<?php
	//Local Database
	include("conecta.inc.php");
	
	// Nueva version de conexion
	$mysqliConn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$mysqliConn) {
		die("Error de conexión: " . mysqli_connect_error());
	}


	mysqli_set_charset($mysqliConn, "utf8");

?>