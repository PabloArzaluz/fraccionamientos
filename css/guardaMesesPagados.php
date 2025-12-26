<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();
  date_default_timezone_set('America/Mexico_City');
  
  $mesesExplode = explode(",", $_POST['meses']);
  $usuario = $_POST['usuario'];
  
  for($i=0;$i<count($mesesExplode);$i++){
    $mesCompleto = $mesesExplode[$i]."-01";
    $conocerMes = mysql_query("select * from mensualidades where id_user=$usuario and fecha='$mesCompleto';",$link) or die(mysql_error());
    $arrayMes = mysql_fetch_row($conocerMes);
    if(mysql_num_rows($conocerMes) == 0){
      $mesCompleto;
      $insertarFechasFaltantes = mysql_query("insert into mensualidades(id_user,fecha) values($usuario,'$mesCompleto');",$link) or die(mysql_error());
    }
  }

  $eliminarFalsos = mysql_query("select * from mensualidades where id_user=$usuario",$link) or die(mysql_error());
  while($arrFalsos = mysql_fetch_array($eliminarFalsos)){
    $bandera=0;
     for($i=0;$i<count($mesesExplode);$i++){
       $mesCompleto = $mesesExplode[$i]."-01";
        if($arrFalsos[2] == $mesCompleto){
          $bandera=$bandera+1;
        }
      }
      if($bandera==0){
        $borrarBD = mysql_query("delete from mensualidades where id_mensualidad=".$arrFalsos[0],$link) or die(mysql_error());
      }
      $bandera;
  }
  header("Location:panel-estatus-mantenimiento.php");
?>
