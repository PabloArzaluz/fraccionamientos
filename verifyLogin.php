<?php 
	session_start();
	require_once 'configPHP/conecta.inc.php';
	require_once 'inc/config-site.php';



	$user     = $_POST['email_country_login'] ?? '';
	$password = $_POST['password_country_login'] ?? '';

	if ($user === '' || $password === '') {
		header("Location: index.php?alert=1");
		exit;
	}

	$sql = "
		SELECT id_user, nombre, level
		FROM user
		WHERE user_login = ? AND password = ?
		LIMIT 1
	";

	$stmt = mysqli_prepare($mysqli, $sql);
	if (!$stmt) {
		die("Prepare failed: " . mysqli_error($mysqli));
	}

	mysqli_stmt_bind_param($stmt, "ss", $user, $password);
	mysqli_stmt_execute($stmt);

	/* 🔴 CLAVE: NO usar get_result */
	mysqli_stmt_store_result($stmt);

	if (mysqli_stmt_num_rows($stmt) > 0) {

		mysqli_stmt_bind_result($stmt, $id_user, $nombre, $level_user);
		mysqli_stmt_fetch($stmt);

		$_SESSION['id_user']    = $id_user;
		$_SESSION['name_user']  = htmlspecialchars_decode($nombre);
		$_SESSION['level_user'] = $level_user;
		$_SESSION['redirect']   = "avisos";

		if ($level_user == 3) {
			header("Location: vista_estatus_mantto.php");
		} else {
			header("Location: notificaciones.php");
		}
		exit;

	} else {
		header("Location: index.php?alert=1");
		exit;
	}
