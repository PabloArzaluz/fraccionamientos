<?php
	session_start();

	include('configPHP/conecta.inc.php');

	include('configPHP/config.inc.php');

	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

	

	if(!isset($_SESSION['id_user'])){
		header('Location:index.php');
		die();
	}

	$id=$_GET['id'];
	$fechahoracaptura = date("Y-m-d G:i:s"); 
	
	$consulta_eliminar = "delete from gastos_variables where id_gastos_variables=$id;";

	//Insertar Registro de Eliminacion
	$queryInsertaLog = "INSERT INTO log_eliminacion(consulta,user,fechahora)
		VALUES('$consulta_eliminar','".$_SESSION['id_user']."','$fechahoracaptura');";
	$insertaLogEliminacion = mysqli_query($mysqli,$queryInsertaLog) or die(mysqli_error($mysqli));


	$elimina = mysqli_query($mysqli,$consulta_eliminar ) or die(mysqli_error($mysqli));

	header('Location: panel-gastos-variables.php');

?>