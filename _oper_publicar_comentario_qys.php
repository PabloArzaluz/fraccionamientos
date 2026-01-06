<?php 
	 session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	
    date_default_timezone_set('America/Mexico_City');

    //Publicar Comentario de Quejas y Sugerencias

  	$idqys = $_GET['id'];
    $usuario = $_SESSION['id_user'];
    $fecha = date("Y-m-d"); 
    $hora = date("G:i:s"); 
    $comentario = $_POST['comentario'];

    $insertarComentario = "insert into qys_reply(id_qys,comentario,fecha,hora,id_user) values($idqys,'$comentario','$fecha','$hora',$usuario);";
    $iny_insertar_Comentario = mysqli_query($mysqli,$insertarComentario) or die(mysqli_error($mysqli));

    header("Location: ver-qys.php?id=$idqys&info=1");
 ?>