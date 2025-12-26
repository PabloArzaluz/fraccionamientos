<?php 
session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	$link=Conecta();
    date_default_timezone_set('America/Mexico_City');

    $mi_pdf = $_GET['oper'];
    if ($mi_pdf){
    	header('Content-type: application/pdf');
  
    	header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
    	readfile($mi_pdf);

	
    	
}

 ?>
