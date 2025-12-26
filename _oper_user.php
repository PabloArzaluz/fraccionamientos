<?php 
	session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	$link=Conecta();

  	$oper = $_GET['oper'];

  	if($oper == "add"){
  		$login_user = $_POST['login-user'];
  		$password = $_POST['password-user'];
  		$no_casa = $_POST['nocasa-user'];
  		$nombre_user = $_POST['name-user'];
  		$level_user = $_POST['nivel-user'];
  		$inserta_usuario = mysql_query("insert into user(user_login,nombre,password,no_casa,level) values('$login_user','$nombre_user','$password','$no_casa',$level_user);",$link) or die(mysql_error());
      $id_insertado = mysql_insert_id();
      $insertar_mantto = mysql_query("insert into mantto(id_user,estatus) values($id_insertado,0);") or die(mysql_error());
  		$_SESSION['redirect'] = "users";
  		header("Location: panel_admin.php");
  	}elseif ($oper == "edit") {
  		$id_user = $_GET['i'];
  		$login_user = $_POST['login-user'];
  		$password = $_POST['password-user'];
  		$no_casa = $_POST['nocasa-user'];
  		$nombre_user = $_POST['name-user'];
  		$level_user = $_POST['nivel-user'];
  		$actualiza_usuario = mysql_query("update user set user_login='$login_user',nombre='$nombre_user',password='$password',no_casa='$no_casa',level=$level_user where id_user=$id_user;",$link) or die(mysql_error());
  		$_SESSION['redirect'] = "users";
  		header("Location: panel-usuarios.php");
  	}elseif($oper=="del"){
  		$id_user = $_GET['i'];
      $borrar_pagos = mysql_query("delete from mantto where id_user=$id_user;",$link) or die(mysql_error());
  		$borrar_usuario = mysql_query("delete from user where id_user=$id_user",$link) or die(mysql_error());
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
		$cambioestado = mysql_query("update mantto set estatus=$stat where id_user=$id;",$link) or die (mysql_error());
	}elseif($operacion == "ins"){
		$insertaestado = mysql_query("insert into mantto(id_user,estatus) values($id,$stat);",$link) or die(mysql_error());
	}
	
	header("Location: panel_admin.php");*/
 ?>