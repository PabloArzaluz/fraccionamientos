<?php 
session_start();
  	
  	include('configPHP/config.inc.php');
  	
  	
    date_default_timezone_set('America/Mexico_City');

    $mi_pdf = $_GET['oper'];
    if ($mi_pdf){
    	header('Content-type: application/pdf');
  
    	header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
    	readfile($mi_pdf);

	
    	
}

 ?>
