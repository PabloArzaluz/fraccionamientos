<?php 
	session_start();
  	
  	include('configPHP/config.inc.php');
  	
  	


  	
	$id = $_POST['user'];
	$operacion = $_POST['oper'];

	if(!isset($_POST['stat'])){
		$stat = 0;
	}else{
		$stat = 1;
	}
	
	if($operacion == "upd"){
		$cambioestado = mysqli_query($mysqliConn,"update mantto set estatus=$stat where id_user=$id;",$link) or die (mysqli_error($mysqliConn));
	}elseif($operacion == "ins"){
		$insertaestado = mysqli_query($mysqliConn,"insert into mantto(id_user,estatus) values($id,$stat);") or die(mysqli_error($mysqliConn));
	}
	$_SESSION['redirect'] = "mantto";
	header("Location: panel-estatus-mantenimiento.php");
 ?>