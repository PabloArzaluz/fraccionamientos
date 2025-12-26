<?php
	session_start();
	  
	  include('configPHP/config.inc.php');
	  
	  
	$id=$_GET['id'];
	$fecha = $_GET['f'];
	$elimina = mysqli_query($mysqliConn,"delete from estados where id_estados=$id;") or die(mysqli_error($mysqliConn));
	header('Location: panel-estados-cuenta.php?fecha='.$fecha);
?>