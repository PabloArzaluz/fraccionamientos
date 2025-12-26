<?php 
	session_start();
	include('configPHP/conecta.inc.php');
	include('configPHP/config.inc.php');
	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
	$link=Conecta();

	$user  =  $_POST['email_country_login'];
	$password =  $_POST['password_country_login'];

	$resultado = mysql_query ("select * from user where user_login =  '".$user."' and password ='".$password."'",$link) or die(mysql_error());
	if(mysql_num_rows($resultado)>0){
		$row=mysql_fetch_array($resultado);
		$_SESSION['id_user'] = $row[0];
		$_SESSION['name_user'] = htmlspecialchars_decode($row[2]);
		$_SESSION['level_user'] = $row[5];
		$_SESSION['redirect'] = "avisos";
		header("Location: notificaciones.php");
	}else{
		header("Location: index.php?alert=1");
	}
 ?>