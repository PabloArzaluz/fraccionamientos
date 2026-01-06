<?php 

	 session_start();

  	include('configPHP/conecta.inc.php');

  	include('configPHP/config.inc.php');

  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  	

    if(!isset($_SESSION['id_user'])){
      header('Location:index.php');
      die();
    }
    
    date_default_timezone_set('America/Mexico_City');

    include("inc/config-site.php");

  	$id_gf = $_GET['id'];

    

    //En realizar se cambia el estatus a activo=0 para no mostrar y guardar el historial

    $UPDATE_GASTOS_FIJOS = "update gastos_fijos set activo=0 where id_gastos_fijos = $id_gf;";

    $INY_GASTOS_FIJOS = mysqli_query($mysqli,$UPDATE_GASTOS_FIJOS) or die(mysqli_error($mysqli));



    header("Location: panel-gastos-fijos.php");

    

 ?>