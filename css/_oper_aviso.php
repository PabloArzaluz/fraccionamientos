<?php 
	 session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	$link=Conecta();
    date_default_timezone_set('America/Mexico_City');

  	$oper = $_GET['oper'];
    $fecha = date("Y-m-d"); 
    $hora = date("G:i:s"); 
    $user = $_SESSION['id_user'];

  	if($oper == "add"){
  	  $titulo = $_POST['titulo-aviso'];
      $descripcion = $_POST['descripcion-aviso'];
      $consultaAgregar = "insert into noti(titulo,texto,fecha,id_user,hora) values('$titulo','$descripcion','$fecha',$user,'$hora');";
      $agregarNoti = mysql_query($consultaAgregar,$link) or die (mysql_error());
  		header("Location: panel-avisos.php");
  	}elseif ($oper == "edit") {
  		$id_noti = $_GET['i'];
      $titulo = $_POST['titulo-aviso'];
      $descripcion = $_POST['descripcion-aviso'];
      $consultaEditar = "update noti set titulo='$titulo',texto='$descripcion',fecha='$fecha',hora='$hora',id_user=$user where id_noti=$id_noti;";
      $editarNoti = mysql_query($consultaEditar,$link) or die (mysql_error());
      header("Location: panel-avisos.php");
    	}elseif($oper=="del"){
  		  $id_noti = $_GET['i'];
        $borrar_noti = mysql_query("delete from noti where id_noti=$id_noti;",$link) or die(mysql_error());
  		  header("Location: panel-avisos.php");
  	}
 ?>