<?php
	session_start();
	  
	  include('configPHP/config.inc.php');
	  
	  
	$id=$_GET['id'];
	$fecha = $_GET['f'];
	$elimina = mysqli_query($mysqliConn,"delete from presupuestos where id_presu=$id;") or die(mysqli_error($mysqliConn));
	header('Location: panel-presupuestos.php?fecha='.$fecha);
?>