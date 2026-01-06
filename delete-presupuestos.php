<?php
	session_start();
	  include('configPHP/conecta.inc.php');
	  include('configPHP/config.inc.php');
	  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
	  
	$id=$_GET['id'];
	$fecha = $_GET['f'];
	$elimina = mysqli_query($mysqli,"delete from presupuestos where id_presu=$id;") or die(mysqli_error($mysqli));
	header('Location: panel-presupuestos.php?fecha='.$fecha);
?>