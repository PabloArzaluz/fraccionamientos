<?php
	//Local Database
	
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="fraccionamientos";
    

	//Remote Database
	/*
	$dbhost="localhost";
	$dbuser="syscomle_country";
	$dbpass="Qw3rty2012%";
	$dbname="syscomle_country";
	*/

	// Nueva version de conexion
	$mysqliConn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$mysqliConn) {
		die("Error de conexión: " . mysqli_connect_error());
	}


	mysqli_set_charset($mysqliConn, "utf8");

?>