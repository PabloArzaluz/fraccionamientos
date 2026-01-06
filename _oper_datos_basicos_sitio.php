<?php 
	 session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	
    date_default_timezone_set('America/Mexico_City');
    include("inc/config-site.php");
    
    $NOMBRE_SITIO = $_POST['nombre-sitio'];
    $FECHA_INICIO =  $_POST['fechaInicio'];
    
    $ACTUALIZAR_NOMBRE_SITIO = "update config_site set name_site='$NOMBRE_SITIO' where id_config_site = 1;";
    $INY_ACTUALIZAR_NOMBRE_SITIO = mysqli_query($mysqli,$ACTUALIZAR_NOMBRE_SITIO) or die(mysqli_error($mysqli));
    
    $ACTUALIZAR_FECHA_INICIO = "update config_site set fecha_inicio='$FECHA_INICIO' where id_config_site = 1;";
    $INY_ACTUALIZAR_FECHA_INICIO = mysqli_query($mysqli,$ACTUALIZAR_FECHA_INICIO) or die(mysqli_error($mysqli));

    header("Location: panel-configuracion-sitio.php?m=1&info=1");
 ?>