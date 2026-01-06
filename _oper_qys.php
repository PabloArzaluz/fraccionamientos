<?php 

	 session_start();

  	include('configPHP/conecta.inc.php');

  	include('configPHP/config.inc.php');

  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  	

    date_default_timezone_set('America/Mexico_City');



  	$oper = $_GET['oper'];

    $fecha = date("Y-m-d"); 

    $hora = date("G:i:s"); 

    $user = $_SESSION['id_user'];



   $titulo = $_POST['titulo-qys'];

   $descripcion = $_POST['descripcion-qys'];



    

    

    



  	if($oper == "add"){

      if($_FILES['archivo']['error'] == 4){
         $rutaGuarda = "";
         $consultaAgregar = "insert into qys(titulo,descripcion,id_user,visitas,fecha,hora,img,status,razon_cierre) values('$titulo','$descripcion',$user,0,'$fecha','$hora','$rutaGuarda',1,'');";
         $agregarNoti = mysqli_query($mysqli,$consultaAgregar,$link) or die (mysqli_error($mysqli));
        

      }else{
          $tipo = $_FILES['archivo']['type'];
          $tamaño = ($_FILES['archivo']['size'] / 1024) . "kB";
           $better_token = md5(uniqid(mt_rand(), true));
           $temporal = $_FILES['archivo']['tmp_name'];
           $cadena = $_FILES['archivo']['name'];
     

         $extensiones = explode(".",$_FILES['archivo']['name']);

         $rutaGuarda = $better_token.".".$extensiones[1];



         echo $consultaAgregar = "insert into qys(titulo,descripcion,id_user,visitas,fecha,hora,img,status,razon_cierre) values('$titulo','$descripcion',$user,0,'$fecha','$hora','$rutaGuarda',1,'');";

         $agregarNoti = mysqli_query($mysqli,$consultaAgregar,$link) or die (mysqli_error($mysqli));



         $ruta = "Files/qys/".$rutaGuarda;

         move_uploaded_file($temporal,$ruta);

        

      }

  	   

  		header("Location: quejas-sugerencias.php");

  	}elseif ($oper == "edit") {

  		$id_noti = $_GET['i'];

      $titulo = $_POST['titulo-aviso'];

      $descripcion = $_POST['descripcion-aviso'];

      $consultaEditar = "update noti set titulo='$titulo',texto='$descripcion',fecha='$fecha',hora='$hora',id_user=$user where id_noti=$id_noti;";

      $editarNoti = mysqli_query($mysqli,$consultaEditar,$link) or die (mysqli_error($mysqli));

      //header("Location: panel-avisos.php");

    	}elseif($oper=="del"){

  		  $id_noti = $_GET['i'];

        $borrar_noti = mysqli_query($mysqli,"delete from noti where id_noti=$id_noti;") or die(mysqli_error($mysqli));

  		  //header("Location: panel-avisos.php");

  	}

 ?>