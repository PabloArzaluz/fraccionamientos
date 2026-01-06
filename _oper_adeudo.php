<?php
    session_start();
    include('configPHP/conecta.inc.php');
    include('configPHP/config.inc.php');
    $actual_page = "estados";
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
    include("inc/config-site.php");
    
    $mesActual  = date('m');
    $anoActual = date('Y');
    $fechaActual = $anoActual."-".$mesActual."-01"; 
    
    date_default_timezone_set('America/Mexico_City');

    echo "Agregar/Eliminar ADeudo";
    echo $id_usuario = $_GET['i'];
?>