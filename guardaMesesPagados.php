<?php

	session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  date_default_timezone_set('America/Mexico_City');

  

  //Conocer Tarifa Actual

  $TARIFA_ACTUAL = "select * from cuotas order by fechahora desc limit 1;";

  $INY_TARIFA_ACTUAL = mysqli_query($mysqli,$TARIFA_ACTUAL) or die(mysqli_error($mysqli));

  $F_TARIFA_ACTUAL = mysqli_fetch_array($INY_TARIFA_ACTUAL);

  $tarifa = $F_TARIFA_ACTUAL[0];



  $fechahoracaptura = date("Y-m-d G:i:s"); 



  //CONOCER FECHA DE INICIO DE PERIODO DE SITIO

  $FECHA_INICIO_HISTORIA = "select fecha_inicio from config_site;";

  $INY_FECHA_INICIO_HISTORIA = mysqli_query($mysqli,$FECHA_INICIO_HISTORIA) or die(mysqli_error($mysqli));

  $F_FECHA_INICIAL = mysqli_fetch_array($INY_FECHA_INICIO_HISTORIA);

  $fecha_inicial = substr($F_FECHA_INICIAL[0], 0,4)."-".substr($F_FECHA_INICIAL[0], 5,2)."-01";



  //Generar un arreglo, y guardarlo en variable, de igual forma la variable de Usuario que pagó

  $mesesExplode = explode(",", $_POST['meses']);

  $usuario = $_POST['usuario'];

  $PAGOS = $_POST['pagos'];



  $user_captura = $_SESSION['id_user'];



   //Ciclo de meses desde la fecha de inicio hasta la fecha actual

  $fechaActual = date("Y")."-".date("m")."-01";



  $fechas_completas = array(); 

  $fechaaamostar = $fecha_inicial;

  $fechas_completas[] = $fechaaamostar; 

  while(strtotime($fechaActual) >= strtotime($fecha_inicial)){

   if(strtotime($fechaActual) != strtotime($fechaaamostar)){

      $fechaaamostar = date("Y-m-d", strtotime($fechaaamostar . " + 1 month"));

      $fechas_completas[] = $fechaaamostar; 

    }else{

      $fechas_completas[] = $fechaaamostar; 

      break;

    }

  }



//Conocer si el mes actual y posteriores han sido seleccionados

$mesesPosteriores = 0;

$mesesAnteriores = 0;

for($x=0;$x<count($mesesExplode);$x++){

  $mesesExplodeCompletos[$x] = $mesesExplode[$x]."-01";

  if(strtotime($mesesExplodeCompletos[$x]) >= strtotime($fechaActual)){

      $mesesPosteriores++;

  }

  if(in_array($mesesExplodeCompletos[$x], $fechas_completas)){

    $mesesAnteriores++;

  }

}



$mesesAnteriores +=1;



if($mesesPosteriores > 0){

  if($mesesAnteriores == count($fechas_completas)){

    // se insertaran meses posteriores y las fechas son las completas

     $Posibilidad = 1;

  }else{

    $Posibilidad = 0;

  }

}else{

    $Posibilidad = 3;

    // solo requiere modificar fechas anteriores

}



if($Posibilidad >0 ){

  for($i=0;$i<count($mesesExplode);$i++){

    $mesCompleto = $mesesExplode[$i]."-01";

    $conocerMes = mysqli_query($mysqli,"select * from mensualidades where id_user=$usuario and fecha='$mesCompleto';") or die(mysqli_error($mysqli));

    $arrayMes = mysqli_fetch_row($conocerMes);

    if(mysqli_num_rows($conocerMes) == 0){

      $mesCompleto;

      $insertarFechasFaltantes = mysqli_query($mysqli,"insert into mensualidades(id_user,fecha) values($usuario,'$mesCompleto');") or die(mysqli_error($mysqli));

      $insertarPagosFaltantes = mysqli_query($mysqli,"insert into pagos_mantto(id_user,id_cuota,datetimecobro,fecha,user_captura) values($usuario,$tarifa,'$fechahoracaptura','$mesCompleto',$user_captura);") or die(mysqli_error($mysqli));

    }

  }

  $eliminarFalsos = mysqli_query($mysqli,"select * from mensualidades where id_user=$usuario") or die(mysqli_error($mysqli));

  while($arrFalsos = mysqli_fetch_array($eliminarFalsos)){

    $bandera=0;

     for($i=0;$i<count($mesesExplode);$i++){

       $mesCompleto = $mesesExplode[$i]."-01";

        if($arrFalsos[2] == $mesCompleto){

          $bandera=$bandera+1;

        }

      }

      if($bandera==0){

        $borrarBD = mysqli_query($mysqli,"delete from mensualidades where id_mensualidad=".$arrFalsos[0]) or die(mysqli_error($mysqli));

      }

      $bandera;

  }



  $eliminarFalsosPagos = mysqli_query($mysqli,"select * from pagos_mantto where id_user=$usuario") or die(mysqli_error($mysqli));

  while($arrFalsosPagos = mysqli_fetch_array($eliminarFalsosPagos)){

    $banderaPagos=0;

     for($i=0;$i<count($mesesExplode);$i++){

       $mesCompleto = $mesesExplode[$i]."-01";

        if($arrFalsosPagos[4] == $mesCompleto){

          $banderaPagos=$banderaPagos+1;

        }

      }

      if($banderaPagos==0){

        $borrarPagos = mysqli_query($mysqli,"delete from pagos_mantto where id_pagos_mantto=".$arrFalsosPagos[0]) or die(mysqli_error($mysqli));

      }

      $banderaPagos;

  }



  if($PAGOS == 1){

    //redirigir a pagos

    header("Location:oper-pago-diverso.php?agre=add&user=$usuario");



  }else{

    //redirigir a panel estatus mantenimiento

    

    header("Location:panel-estatus-mantenimiento.php");

  }

}else{

  header("Location:ver-meses-pagados.php?i=$usuario&info=error&pagos=$PAGOS");

}

  

?>

