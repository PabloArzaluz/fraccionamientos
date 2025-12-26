<?php 
	session_start();
	
	include('configPHP/config.inc.php');
	
	

	$user  =  $_POST['email_country_login'];
	$password =  $_POST['password_country_login'];

	$resultado = mysqli_query ("select * from user where user_login =  '".$user."' and password ='".$password."'") or die(mysqli_error($mysqliConn));
	if(mysqli_num_rows($resultado)>0){
		$row=mysqli_fetch_array($resultado);
		$_SESSION['id_user'] = $row[0];
		$_SESSION['name_user'] = htmlspecialchars_decode($row[2]);
		$_SESSION['level_user'] = $row[5];
		$_SESSION['redirect'] = "avisos";
		header("Location: notificaciones.php");
	}else{
		header("Location: index.php?alert=1");
	}
 ?>