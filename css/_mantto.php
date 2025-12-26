<?php 
	session_start();
  	
  	include('configPHP/config.inc.php');
  	
  	
 	date_default_timezone_set('America/Mexico_City');

  	$id = $_POST['user'];
	$operacion = $_POST['oper'];

	$ano = date("Y"); 
    $mes = date("m");

	$fechaActual = $ano."-".$mes."-01";

	
	$insertarMesActual = mysqli_query($mysqliConn,"insert into mensualidades(id_user,fecha) values($id,'$fechaActual');") or die(mysqli_error($mysqliConn));
	
	/*
if(!isset($_POST['stat'])){
		$stat = 0;
	}else{
		$stat = 1;
	}

	if($operacion == "upd"){
		//$cambioestado = mysqli_query($mysqliConn,"update mantto set estatus=$stat where id_user=$id;",$link) or die (mysqli_error($mysqliConn));
	}elseif($operacion == "ins"){
		//$insertaestado = mysqli_query($mysqliConn,"insert into mantto(id_user,estatus) values($id,$stat);") or die(mysqli_error($mysqliConn));
	}*/
	/*$_SESSION['redirect'] = "mantto";*/
	header("Location: panel-estatus-mantenimiento.php");
 ?>