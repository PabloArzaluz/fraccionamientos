<?php
session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');
	$fecha  = date('n');

switch ($fecha) {
	case "1":
		echo "Enero";
		break;
	case "2":
		echo "Febrero";
		break;
	case "3":
		echo "Marzo";
		break;
	case "4":
		echo "Abril";
		break;
	case "5":
		echo "Mayo";
		break;
	case "6":
		echo "Junio";
		break;
	case "7":
		echo "Julio";
		break;
	case "8":
		echo "Agosto";
		break;
	case "9":
		echo "Septiembre";
		break;
	case "10":
		$mes = "Octubre";
		mkdir(dirname($mes).$mes,07777);
		break;
	case "11":
		echo "Noviembre";
		break;
	case "12":
		echo "Diciembre";
		break;	
	default:
		echo "No Existe otro mes";
		break;
}

?>