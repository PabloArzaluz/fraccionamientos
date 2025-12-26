<?php 
	session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	$link=Conecta();


  	
	$id = $_POST['user'];
	$operacion = $_POST['oper'];

	if(!isset($_POST['stat'])){
		$stat = 0;
	}else{
		$stat = 1;
	}
	
	if($operacion == "upd"){
		$cambioestado = mysql_query("update mantto set estatus=$stat where id_user=$id;",$link) or die (mysql_error());
	}elseif($operacion == "ins"){
		$insertaestado = mysql_query("insert into mantto(id_user,estatus) values($id,$stat);",$link) or die(mysql_error());
	}
	$_SESSION['redirect'] = "mantto";
	header("Location: panel-estatus-mantenimiento.php");
 ?>