<?php 
	 session_start();
  	
  	include('configPHP/config.inc.php');
  	
  	
    date_default_timezone_set('America/Mexico_City');

    $id_user = $_GET['i'];
    $stringMeses = $_GET['meses'];

    $meses = explode(",", $stringMeses);
    $cant = count($meses);

    for($i=0;$i<$cant;$i++){
      $stringComparativo = $meses[$i]."-01";
      //conocer existencia en bd
      $comparaBD = mysqli_query($mysqliConn,"select * from mensualidades where id_user=$id_user and fecha='$stringComparativo';") or die(mysqli_error($mysqliConn));
      if(mysqli_num_rows($comparaBD)>0){
          
      }else{
        $insertarenBD = mysqli_query($mysqliConn,"insert into mensualidades(id_user,fecha) values($id_user,'$stringComparativo');") or die(mysqli_error($mysqliConn));
      }

    }
    header("Location: panel-estatus-mantenimiento.php");

  	/*$oper = $_GET['oper'];
    $fecha = date("Y-m-d"); 
    $hora = date("G:i:s"); 
    $user = $_SESSION['id_user'];

  	if($oper == "add"){
  	  $titulo = $_POST['titulo-aviso'];
      $descripcion = $_POST['descripcion-aviso'];
      $consultaAgregar = "insert into noti(titulo,texto,fecha,id_user,hora) values('$titulo','$descripcion','$fecha',$user,'$hora');";
      $agregarNoti = mysqli_query($consultaAgregar,$link) or die (mysqli_error($mysqliConn));
  		header("Location: panel-avisos.php");
  	}elseif ($oper == "edit") {
  		$id_noti = $_GET['i'];
      $titulo = $_POST['titulo-aviso'];
      $descripcion = $_POST['descripcion-aviso'];
      $consultaEditar = "update noti set titulo='$titulo',texto='$descripcion',fecha='$fecha',hora='$hora',id_user=$user where id_noti=$id_noti;";
      $editarNoti = mysqli_query($consultaEditar,$link) or die (mysqli_error($mysqliConn));
      header("Location: panel-avisos.php");
    	}elseif($oper=="del"){
  		  $id_noti = $_GET['i'];
        $borrar_noti = mysqli_query($mysqliConn,"delete from noti where id_noti=$id_noti;") or die(mysqli_error($mysqliConn));
  		  header("Location: panel-avisos.php");
  	}*/
 ?>