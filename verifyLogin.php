<?php 
	session_start();
	require_once 'configPHP/conecta.inc.php';
	require_once 'inc/config-site.php';

	// Recibir datos
	$user     = $_POST['email_country_login'] ?? '';
	$password = $_POST['password_country_login'] ?? '';

	// Validación mínima
	if ($user === '' || $password === '') {
		header("Location: index.php?alert=1");
		exit;
	}

	// Prepared Statement
	$sql = "SELECT * FROM user WHERE user_login = ? AND password = ? LIMIT 1";
	$stmt = mysqli_prepare($mysqli, $sql);

	if (!$stmt) {
		die("Error en prepare: " . mysqli_error($mysqli));
	}

	mysqli_stmt_bind_param($stmt, "ss", $user, $password);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);

	if ($result && mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_assoc($result);

		$_SESSION['id_user']    = $row['id_user'] ?? $row[0];
		$_SESSION['name_user']  = htmlspecialchars_decode($row['nombre'] ?? $row[2]);
		$_SESSION['level_user'] = $row['level'] ?? $row[5];
		$_SESSION['redirect']   = "avisos";

		// Validar acceso por nivel
		if ($_SESSION['level_user'] == 3) {
			header("Location: vista_estatus_mantto.php");
		} else {
			header("Location: notificaciones.php");
		}
		exit;

	} else {
		header("Location: index.php?alert=1");
		exit;
	}
