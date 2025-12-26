<?php
	session_start();
	  
	  include('configPHP/config.inc.php');
	  
	  
	$id=$_GET['id'];
	$fecha = $_GET['f'];
	$elimina = mysqli_query($mysqliConn,"delete from comprobantes where id_compro=$id;") or die(mysqli_error($mysqliConn));
	header('Location: panel-comprobantes-gastos.php?fecha='.$fecha);
?>