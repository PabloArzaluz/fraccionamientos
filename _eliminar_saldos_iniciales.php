<?php 

	 session_start();

  	include('configPHP/conecta.inc.php');

  	include('configPHP/config.inc.php');

  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  	

    date_default_timezone_set('America/Mexico_City');

    include("inc/config-site.php");

  	if(!isset($_SESSION['id_user'])){
      header('Location:index.php');
      die();
    }

    $id_saldo_inicial = $_GET['id'];

    

    //Eliminar Saldos Iniciales

    $eliminarSaldosIniciales = "delete from saldos_iniciales where id_saldos_iniciales = $id_saldo_inicial;";

    $iny_eliminar_Comentarios = mysqli_query($mysqli,$eliminarSaldosIniciales) or die(mysqli_error($mysqli));



    //Eliminar Eliminar Tema

    //$eliminarTema = "delete from qys where id_qys=$id_qys;";

    //$iny_eliminar_tema = mysqli_query($mysqli,$eliminarTema) or die(mysqli_error($mysqli));



    header("Location: panel-saldos-iniciales.php");

 ?>