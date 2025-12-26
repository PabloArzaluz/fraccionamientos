<?php 
	 session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	$link=Conecta();
    date_default_timezone_set('America/Mexico_City');

    $user = $_GET['i'];

    $conocerEstadoActual = mysql_query("select adeudo from user where id_user=$user",$link) or die(mysql_error());
    $muestraEstadoActual = mysql_fetch_row($conocerEstadoActual);

    if($muestraEstadoActual[0] == 0){
      $consulta = "update user set adeudo=1 where id_user=$user;";
      $actualizaEstado = mysql_query($consulta,$link) or die(mysql_error());
    }else{
      $consulta = "update user set adeudo=0 where id_user=$user;";
      $actualizaEstado = mysql_query($consulta,$link) or die(mysql_error());
    }
    header("Location: panel-estatus-mantenimiento.php");
 ?>