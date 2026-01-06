<?php 
    session_start();
    include('configPHP/conecta.inc.php');
    include('configPHP/config.inc.php');
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
    
    date_default_timezone_set('America/Mexico_City');

    $oper = $_GET['oper'];
    $fechahoracaptura = date("Y-m-d G:i:s"); 
    
    $descripcion = $_POST['descripcion'];
    $monto = $_POST['monto'];
    $fecha = $_POST['fecha'];

    $hora = date("G:i:s"); 
    $user = $_SESSION['id_user'];
       
    if($oper == 'add'){
      $INSERTAR_GASTO_FIJO = "insert into gastos_variables(descripcion, monto, id_user, fecha, fecha_captura) values('$descripcion','$monto',$user,'$fecha','$fechahoracaptura');";
      $INY_INSERTAR_GASTO_FIJO = mysqli_query($mysqli,$INSERTAR_GASTO_FIJO) or die(mysqli_error($mysqli));
      header('Location: panel-gastos-variables.php');
    }
    if($oper=='edit'){
      
      $id_gastos_variables = $_GET['i'];
      $ACTUALIZAR_GASTO_FIJO = "update gastos_variables set descripcion='$descripcion',monto='$monto',id_user=$user,fecha='$fecha' where id_gastos_variables=$id_gastos_variables;";
      $INY_ACTUALIZAR_GASTO_FIJO = mysqli_query($mysqli,$ACTUALIZAR_GASTO_FIJO) or die(mysqli_error($mysqli));
      header('Location: panel-gastos-variables.php');
    }

    

    /*

    if($anoactual < $anotemp1) {
      $rutaGuarda = "Estados/".$anoactual;
        if (file_exists($rutaGuarda)) {
        }else{
        mkdir($rutaGuarda,0777); 
        } 
      }                
                switch ($fecha) {
                      case 01:
                        $mes = "Enero";
                        break;
                      case 02:
                        $mes =  "Febrero";
                        
                        break;
                      case 03:
                        $mes =  "Marzo";
                        
                      case 04:
                        $mes ="Abril";
                        
                        break;
                      case 05:
                        $mes = "Mayo";
                        
                        break;
                      case 06:
                        $mes = "Junio";
                       
                        break;
                      case 07:
                        $mes = "Julio";
                        
                        break;
                      case 08:
                        $mes = "Agosto";
                        
                        break;
                      case 09:
                       $mes = "Septiembre";
                      break;
                      case 10:
                              $mes = "Octubre";            
                              break;
                      case 11:
                        $mes = "Noviembre";
                      break;
                      case 12:
                        $mes = "Diciembre";
                        break;  
                      default:
                        echo "No Existe otro mes";
                        break;
                    }
                    $rutaGuarda = "Estados/"."$anoactual"."/".$mes;
                              if (file_exists($rutaGuarda)){                   
                                }else{
                                  mkdir($rutaGuarda,0777);     
                                 }
                  if ($_FILES['archivo']['error'] > 0){
                      echo "Error: " . $_FILES['archivo']['error'] . "<br>";
                      echo "<SCRIPT LANGUAGE='javascript'>alert('Tipo de archivo incorrecto. Por favor la extencion debe ser JPG o PDF ');document.location=('oper_estado_cuenta.php');</SCRIPT>";
                      }else{                                          
                        $ruta = "Estados/".$anoactual."/".$mes."/" .$better_token;
                        if ($tipo =="application/pdf"){
                            $ruta = $ruta.".pdf"; 
                            $tipo_Archivo = "pdf";                                               
                            }elseif ($tipo =="image/jpeg"){
                          $ruta = $ruta.".jpg";
                          $tipo_Archivo = "jpg";                                                
                         }else{
                              echo "<SCRIPT LANGUAGE='javascript'>alert('Error! Archivo No valido');document.location=('oper_estado_cuenta.php?agre=add');</SCRIPT>";
                              return false;
                         }                                              
                                          }
                  move_uploaded_file($temporal,$ruta);
                  $consultaAgregar = "insert into estados (titulo,ruta,id_user,descripcion,tipo,fecha) values('".$titul."','".$ruta."',".$_SESSION['id_user'].",'".$descripcion."','".$tipo_Archivo."','".$fecha_completa."');";
                  $agrgarComprobante = mysqli_query($mysqli,$consultaAgregar,$link);
                  echo "<SCRIPT LANGUAGE='javascript'>document.location=('panel-estados-cuenta.php?info=1');</SCRIPT>";
          */        
              
           ?>