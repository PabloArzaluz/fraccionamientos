<?php 
	session_start();
  	include('configPHP/config.inc.php');
 	date_default_timezone_set('America/Mexico_City');

  	$id = $_POST['user'];
	$operacion = $_POST['oper'];

	$ano = date("Y"); 
    $mes = date("m");

	$fechaActual = $ano."-".$mes."-01";

	
	$insertarMesActual = mysqli_query($mysqliConn,"insert into mensualidades(id_user,fecha) values($id,'$fechaActual');") or die(mysql_error($mysqliConn));
	
	header("Location: panel-estatus-mantenimiento.php");
 ?>