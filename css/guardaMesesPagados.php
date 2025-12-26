<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');
  
  $mesesExplode = explode(",", $_POST['meses']);
  $usuario = $_POST['usuario'];
  
  for($i=0;$i<count($mesesExplode);$i++){
    $mesCompleto = $mesesExplode[$i]."-01";
    $conocerMes = mysqli_query($mysqliConn,"select * from mensualidades where id_user=$usuario and fecha='$mesCompleto';") or die(mysqli_error($mysqliConn));
    $arrayMes = mysqli_fetch_row($conocerMes);
    if(mysqli_num_rows($conocerMes) == 0){
      $mesCompleto;
      $insertarFechasFaltantes = mysqli_query($mysqliConn,"insert into mensualidades(id_user,fecha) values($usuario,'$mesCompleto');") or die(mysqli_error($mysqliConn));
    }
  }

  $eliminarFalsos = mysqli_query($mysqliConn,"select * from mensualidades where id_user=$usuario") or die(mysqli_error($mysqliConn));
  while($arrFalsos = mysqli_fetch_array($eliminarFalsos)){
    $bandera=0;
     for($i=0;$i<count($mesesExplode);$i++){
       $mesCompleto = $mesesExplode[$i]."-01";
        if($arrFalsos[2] == $mesCompleto){
          $bandera=$bandera+1;
        }
      }
      if($bandera==0){
        $borrarBD = mysqli_query($mysqliConn,"delete from mensualidades where id_mensualidad=".$arrFalsos[0],$link) or die(mysqli_error($mysqliConn));
      }
      $bandera;
  }
  header("Location:panel-estatus-mantenimiento.php");
?>
