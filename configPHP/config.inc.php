<?php
	//Local Database
	include("conecta.inc.php");
	
	// Nueva version de conexion
	$mysqliConn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if (!$mysqliConn) {
		die("Error de conexión: " . mysqli_connect_error());
	}


	mysqli_set_charset($mysqliConn, "utf8");


	// Detectar el nombre del archivo actual
	$archivo_actual = basename($_SERVER['PHP_SELF']);

	// 2. Validación simple de acceso con EXCEPCIÓN
	// Solo validamos si NO estamos en index.php ni en verifyLogin.php
	if ($archivo_actual != 'index.php' && $archivo_actual != 'verifyLogin.php') {
    
    // Verificamos si existe la variable de sesión
    if (!isset($_SESSION['id_user'])) { // OJO: En tu verifyLogin usaste 'id_user', no 'id_usuario'
        header("Location: index.php");
        exit();
    }
}
?>