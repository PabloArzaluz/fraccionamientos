<?php 

	session_start();

  	include('configPHP/conecta.inc.php');

  	include('configPHP/config.inc.php');

  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  	

 	date_default_timezone_set('America/Mexico_City');

 	include("inc/config-site.php");

 	if(!isset($_SESSION['id_user'])){
		header('Location:index.php');
		die();
	}

  	$id = $_POST['user'];

	$operacion = $_POST['oper'];



	$ano = date("Y"); 

    $mes = date("m");



	$fechaActual = $ano."-".$mes."-01";



	

	$insertarMesActual = mysqli_query($mysqli,"insert into mensualidades(id_user,fecha) values($id,'$fechaActual');") or die(mysqli_error($mysqli));

	

	/*

if(!isset($_POST['stat'])){

		$stat = 0;

	}else{

		$stat = 1;

	}



	if($operacion == "upd"){

		//$cambioestado = mysqli_query($mysqli,"update mantto set estatus=$stat where id_user=$id;",$link) or die (mysqli_error($mysqli));

	}elseif($operacion == "ins"){

		//$insertaestado = mysqli_query($mysqli,"insert into mantto(id_user,estatus) values($id,$stat);") or die(mysqli_error($mysqli));

	}*/

	/*$_SESSION['redirect'] = "mantto";*/

	header("Location: panel-estatus-mantenimiento.php");

 ?>