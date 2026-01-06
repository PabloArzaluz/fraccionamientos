<?php 
	session_start();
    include('configPHP/conecta.inc.php');
    include('configPHP/config.inc.php');
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
    
    date_default_timezone_set('America/Mexico_City');

    if(!isset($_SESSION['id_user'])){
		header('Location:index.php');
		die();
	}

	$oper 				= 	$_GET['oper'];
    $fecha 				= 	date("Y-m-d"); 
    $hora 				= 	date("G:i:s"); 
    $user 				= 	$_SESSION['id_user'];
	$titulo 				=	$_POST['titulo'];
    $descripcion 				=	$_POST['descripcion'];
	$statusEncuesta	=  	$_POST['statusEncuesta'];

    /*$pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];
    $pregunta3 = $_POST['pregunta3'];
    $pregunta4 = $_POST['pregunta4'];
    $pregunta5 = $_POST['pregunta5'];
    */
    //Validar Operacion
    if($oper == "add" ){
        //Primero Insertamos encuesta
        $consultaAgregar = "insert into encuestas (idUsuario,fechahora,status, titulo,descripcion) 
            values('".$user."','".$fecha." ".$hora."','".$statusEncuesta."','".$titulo."','".$descripcion."');";
        $iny_Agregar = mysqli_query($mysqli,$consultaAgregar,$link);
        $IdEncuesta =  mysql_insert_id($link); 
        $IdEncuesta;
        //Insertar Preguntas
        //$consultaAgregarPreguntas = "insert into preguntasencuestas (idEncuesta,descripcion,status, titulo) 
         //  values('".$user."','".$fecha." ".$hora."','".$statusEncuesta."','".$titulo."');";
         header("Location: oper_encuesta.php?oper=edit&i=".$IdEncuesta);
    }
    if($oper=="edit"){
        $idEncuesta = $_GET['i'];
        $consultaEditar = "update encuestas set  status = '$statusEncuesta', titulo = '$titulo', descripcion = '$descripcion' where idEncuesta = $idEncuesta;";
        $iny_Editar = mysqli_query($mysqli,$consultaEditar,$link);
        header("Location: panel-encuestas.php");
    }
               
/*
	switch ($fecha) {
        case "01":
            $mes = "Enero";
            break;
        case "02":
			$mes =  "Febrero";
			break;
        case "03":
            $mes =  "Marzo";
			break;
        case "04":
            $mes ="Abril";
            break;
        case "05":
            $mes = "Mayo";
            break;
        case "06":
            $mes = "Junio";
	        break;
        case "07":
            $mes = "Julio";
            break;
        case "08":
            $mes = "Agosto";
            break;
        case "09":
            $mes = "Septiembre";
            break;
        case "10":
            $mes = "Octubre";            
            break;
        case "11":
            $mes = "Noviembre";
            break;
        case "12":
	        $mes = "Diciembre";
            break;  
		default:
		    echo "No Existe otro mes";
            break;
    }

	$rutaGuarda = "Comprobantes/"."$anoactual"."/".$mes;
	if (file_exists($rutaGuarda)){
		//
	}else{
		mkdir($rutaGuarda,0777);     
	}

	if ($_FILES['archivo']['error'] > 0){
        echo "Error: " . $_FILES['archivo']['error'] . "<br>";
        echo "<SCRIPT LANGUAGE='javascript'>alert('Tipo de archivo incorrecto. Por favor la extencion debe ser JPG o PDF ');document.location=('oper.comprobante.php');</SCRIPT>";
    }else{                                          
        $ruta = "Comprobantes/".$anoactual."/".$mes."/" .$better_token;
        if ($tipo =="application/pdf"){
            $ruta = $ruta.".pdf"; 
            $tipo_Archivo = "pdf";                                               
        }elseif ($tipo =="image/jpeg"){
            $ruta = $ruta.".jpg";
            $tipo_Archivo = "jpg";                                                
        }else{
            echo "<SCRIPT LANGUAGE='javascript'>alert('Error! Archivo No valido');document.location=('oper_comprobante.php?agre=add');</SCRIPT>";
            return false;
        }                                              
    }

	move_uploaded_file($temporal,$ruta);
	$consultaAgregar = "insert into comprobantes (titulo,ruta,id_user,descripcion,tipo,fecha) values('".$titul."','".$ruta."',".$_SESSION['id_user'].",'".$descripcion."','".$tipo_Archivo."','".$fechaComprobante."');";
    $agrgarComprobante = mysqli_query($mysqli,$consultaAgregar,$link);
    echo "<SCRIPT LANGUAGE='javascript'>document.location=('panel-comprobantes-gastos.php?info=1');</SCRIPT>";*/
?>