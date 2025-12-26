<?php
	session_start();
	  include('configPHP/conecta.inc.php');
	  include('configPHP/config.inc.php');
	  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
	  $link=Conecta();
	$id=$_GET['id'];
	$fecha = $_GET['f'];
	$elimina = mysql_query("delete from estados where id_estados=$id;",$link) or die(mysql_error());
	header('Location: panel-estados-cuenta.php?fecha='.$fecha);
?>