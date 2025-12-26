<?php 
   session_start();
    
    include('configPHP/config.inc.php');
    
    
    date_default_timezone_set('America/Mexico_City');

    $oper = $_GET['oper'];
    $fecha = date("Y-m-d"); 
    $hora = date("G:i:s"); 
    $user = $_SESSION['id_user'];
    $titul = $_POST['titulo'];

    $cadena = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamaño = ($_FILES['archivo']['size'] / 1024) . "kB";
    $better_token = md5(uniqid(mt_rand(), true));
    $descripcion = $_POST['descripcion'];
    $temporal = $_FILES['archivo']['tmp_name'];


    $fecha_completa=date('Y-m-d');
    $fecha  = date('n');
    $anoactual = date('Y');
    $anotemp = date('Y');
    $anotemp1= $anotemp + 1 ;
    

    if($anoactual < $anotemp1) {
      $rutaGuarda = "Presupuestos/".$anoactual;
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
                    $rutaGuarda = "Presupuestos/"."$anoactual"."/".$mes;
                              if (file_exists($rutaGuarda)){                   
                                }else{
                                  mkdir($rutaGuarda,0777);     
                                 }
                  if ($_FILES['archivo']['error'] > 0){
                      echo "Error: " . $_FILES['archivo']['error'] . "<br>";
                      echo "<SCRIPT LANGUAGE='javascript'>alert('Tipo de archivo incorrecto. Por favor la extencion debe ser JPG o PDF ');document.location=('oper_presupuestos.php');</SCRIPT>";
                      }else{                                          
                        $ruta = "Presupuestos/".$anoactual."/".$mes."/" .$better_token;
                        if ($tipo =="application/pdf"){
                            $ruta = $ruta.".pdf"; 
                            $tipo_Archivo = "pdf";                                               
                            }elseif ($tipo =="image/jpeg"){
                          $ruta = $ruta.".jpg";
                          $tipo_Archivo = "jpg";                                                
                         }else{
                              echo "<SCRIPT LANGUAGE='javascript'>alert('Error! Archivo No valido');document.location=('oper_presupuestos.php?agre=add');</SCRIPT>";
                              return false;
                         }                                              
                                          }
                  move_uploaded_file($temporal,$ruta);
                  $consultaAgregar = "insert into presupuestos (titulo,ruta,id_user,descripcion,tipo,fecha) values('".$titul."','".$ruta."',".$_SESSION['id_user'].",'".$descripcion."','".$tipo_Archivo."','".$fecha_completa."');";
                  $agrgarComprobante = mysqli_query($consultaAgregar,$link);
                  echo "<SCRIPT LANGUAGE='javascript'>document.location=('panel-presupuestos.php?info=1');</SCRIPT>";
                  
              
           ?>