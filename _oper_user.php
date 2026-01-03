<?php 
	session_start();
  	
  	include('configPHP/config.inc.php');
  	
  	

  	$oper = $_GET['oper'];

  	if($oper == "add"){
  		$login_user = $_POST['login-user'];
  		$password = $_POST['password-user'];
  		$no_casa = $_POST['nocasa-user'];
  		$nombre_user = $_POST['name-user'];
  		$level_user = $_POST['nivel-user'];
  		$inserta_usuario = mysqli_query($mysqliConn,"insert into user(user_login,nombre,password,no_casa,level) values('$login_user','$nombre_user','$password','$no_casa',$level_user);") or die(mysqli_error($mysqliConn));
      $id_insertado = mysqli_insert_id($mysqliConn);
      $insertar_mantto = mysqli_query($mysqliConn,"insert into mantto(id_user,estatus) values($id_insertado,0);") or die(mysqli_error($mysqliConn));
  		$_SESSION['redirect'] = "users";
  		header("Location: panel_admin.php");
  	}elseif ($oper == "edit") {
  		$id_user = $_GET['i'];
  		$login_user = $_POST['login-user'];
  		$password = $_POST['password-user'];
  		$no_casa = $_POST['nocasa-user'];
  		$nombre_user = $_POST['name-user'];
  		$level_user = $_POST['nivel-user'];
  		$actualiza_usuario = mysqli_query($mysqliConn,"update user set user_login='$login_user',nombre='$nombre_user',password='$password',no_casa='$no_casa',level=$level_user where id_user=$id_user;") or die(mysqli_error($mysqliConn));
  		$_SESSION['redirect'] = "users";
  		header("Location: panel-usuarios.php");
  	}elseif($oper=="del"){
  		$id_user = $_GET['i'];
      $borrar_pagos = mysqli_query($mysqliConn,"delete from mantto where id_user=$id_user;") or die(mysqli_error($mysqliConn));
  		$borrar_usuario = mysqli_query($mysqliConn,"delete from user where id_user=$id_user") or die(mysqli_error($mysqliConn));
  		$_SESSION['redirect'] = "users";
  		header("Location: panel-usuarios.php");
  	}

	/*$id = $_POST['user'];
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
	
	header("Location: panel_admin.php");*/
 ?>