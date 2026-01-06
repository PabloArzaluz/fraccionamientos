<?php 
	 session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	
    date_default_timezone_set('America/Mexico_City');
    include("inc/config-site.php");
    
  	$id_qys = $_GET['id'];
    $status = $_GET['status'];
    

    $actualizarStatus = "update qys set status=$status where id_qys=$id_qys;";
    $iny_ActualizarStatus = mysqli_query($mysqli,$actualizarStatus) or die(mysqli_error($mysqli));

    if($status == 1){
      $cambiarA = 2;
    }else{
      $cambiarA = 1;
    }

    header("Location: panel-quejas-sugerencias.php?status=$cambiarA");

 ?>