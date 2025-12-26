<?php 
	 session_start();
  	include('configPHP/config.inc.php');
    date_default_timezone_set('America/Mexico_City');

    $user = $_GET['i'];

    $conocerEstadoActual = mysqli_query($mysqliConn,"select adeudo from user where id_user=$user") or die(mysql_error($mysqliConn));
    $muestraEstadoActual = mysqli_fetch_row($conocerEstadoActual);

    if($muestraEstadoActual[0] == 0){
      $consulta = "update user set adeudo=1 where id_user=$user;";
      $actualizaEstado = mysqli_query($mysqliConn,$consulta) or die(mysql_error($mysqliConn));
    }else{
      $consulta = "update user set adeudo=0 where id_user=$user;";
      $actualizaEstado = mysqli_query($mysqliConn,$consulta) or die(mysql_error($mysqliConn));
    }
    header("Location: panel-estatus-mantenimiento.php");
 ?>