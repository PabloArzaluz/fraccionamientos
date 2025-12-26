<?php
	session_start();
	  include('configPHP/conecta.inc.php');
	  include('configPHP/config.inc.php');
	  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
	  $link=Conecta();
	$id=$_GET['id'];
	$fecha = $_GET['f'];
	$elimina = mysql_query("delete from presupuestos where id_presu=$id;",$link) or die(mysql_error());
	header('Location: panel-presupuestos.php?fecha='.$fecha);
?>