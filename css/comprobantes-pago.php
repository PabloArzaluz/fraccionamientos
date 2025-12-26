<?php
	session_start();
  
  include('configPHP/config.inc.php');
  $actual_page = "comprobantes";
  
  $mesActual  = date('m');
  $anoActual = date('Y');
  $fechaActual = $anoActual."-".$mesActual."-01"; 
  
  date_default_timezone_set('America/Mexico_City');

function getUltimoDiaMes($elAnio,$elMes) {
  return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
  }

   if(!isset($_GET['fecha'])){
      $fechaRequerida = $fechaActual;
      $ultimo_dia_mes = getUltimoDiaMes($anoActual,$mesActual);
      $fecha_entre = $anoActual."-".$mesActual."-".$ultimo_dia_mes;
    }else{
      $fechaRequerida = $_GET['fecha'];
      $separaFecha = explode("-", $fechaRequerida);
      $ultimo_dia_mes = getUltimoDiaMes($separaFecha[0],$separaFecha[1]);
      $fecha_entre = $separaFecha[0]."-".$separaFecha[1]."-".$ultimo_dia_mes;
    }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Comprobantes de Gasto :: Country del Lago</title>
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type='text/javascript'>
    function cambiarMes(){
      if(document.getElementById('generaFecha').options[document.getElementById('generaFecha').selectedIndex].value != ""){
        var fechaRequerida = document.getElementById('generaFecha').options[document.getElementById('generaFecha').selectedIndex].value;
        window.location = "comprobantes-pago.php?fecha="+fechaRequerida;
      }
      
    }
     </script>

  </head>

  <body>
    <?php 
    include("inc/nav-common.php")
  ?>

 <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ol class="breadcrumb">
          <li><a href="index.php">Country del Lago</a></li>
          <li class="active">Comprobantes de Gasto</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h4>Comprobantes de Gasto</h4>
      </div>
    </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col-xs-1 col-sm-6 col-md-9">
      
      </div>
          <div class="col-xs-11 col-sm-6 col-md-3 text-right">

      <?php 
        $consulta_mes = mysqli_query($mysqliConn,"SELECT distinct year(fecha),month(fecha) FROM comprobantes WHERE MONTH(fecha) order by fecha desc;") or die(mysqli_error($mysqliConn));
        if(mysqli_num_rows($consulta_mes)>0){
          echo "<select class='form-control'  id='generaFecha' onchange='cambiarMes()' required>";
          echo "<option value=''>Seleccione un Mes</option>";
          while($filaMes = mysqli_fetch_array($consulta_mes)){
            $filaMesNombre = "";
            if($filaMes[1]=="1"){$filaMesNombre="Enero";}
            if($filaMes[1]=="2"){$filaMesNombre="Febrero";}
            if($filaMes[1]=="3"){$filaMesNombre="Marzo";}
            if($filaMes[1]=="4"){$filaMesNombre="Abril";}
            if($filaMes[1]=="5"){$filaMesNombre="Mayo";}
            if($filaMes[1]=="6"){$filaMesNombre="Junio";}
            if($filaMes[1]=="7"){$filaMesNombre="Julio";}
            if($filaMes[1]=="8"){$filaMesNombre="Agosto";}
            if($filaMes[1]=="9"){$filaMesNombre="Septiembre";}
            if($filaMes[1]=="10"){$filaMesNombre="Octubre";}
            if($filaMes[1]=="11"){$filaMesNombre="Novimebre";}
            if($filaMes[1]=="12"){$filaMesNombre="Diciembre";}
            $armaMesValue = $filaMes[0]."-".$filaMes[1]."-01";
            echo "<option value='$armaMesValue'";
            if($fechaRequerida == $armaMesValue){
              echo 'selected';
            } 
            echo ">$filaMesNombre-$filaMes[0]</option>";
          }
          echo "</select>";
        }else{
          echo "No hay resultados para mostrar";
        }
?>  
    </div>
   <br><br><br> 
  </div>
  <div class="row">
    <div class="col-xs-12">
<?php
//echo $fechaRequerida;
//echo $fecha_entre;
  $consulta_comprobantes = mysqli_query($mysqliConn,"SELECT * FROM comprobantes where fecha BETWEEN '$fechaRequerida' and '$fecha_entre';") or die(mysqli_error($mysqliConn));
  while($Arrcomprobantes = mysqli_fetch_array($consulta_comprobantes)){ 
      if ($Arrcomprobantes[5]=="pdf") {
             /*echo "<a href='visor.php?oper=$Arrcomprobantes[2]' class='btn btn-success btn-xs'>ver</a></div></td></tr>";*/
             echo"
                  <div class='col-sm-6 col-md-3 col-xs-12'>
                    <div class='thumbnail'>
                      
                      <div class='caption'>
                        <h4>".$Arrcomprobantes[1]."</h4>
                        <span>".$Arrcomprobantes[4]."</span><br><br>
                        <span><a href='visor.php?oper=$Arrcomprobantes[2]' class='btn btn-sm btn-primary' role='button'>Ver Archivo Original </a></span> <span class='label label-success'>JPG</span>
                      </div>
                    </div>
                  </div>
                ";
            }
            elseif ($Arrcomprobantes[5]=="jpg") {
              /*echo "<a href='$Arrcomprobantes[2]' class='btn btn-success btn-xs' >ver</a></div></td></tr>";*/
              echo"
                <div class='col-sm-6 col-md-3 col-xs-12'>
                    <div class='thumbnail'>
                      
                      <div class='caption'>
                        <h4>".$Arrcomprobantes[1]."</h4>
                        <span>".$Arrcomprobantes[4]."</span><br><br>
                        <span><a href='$Arrcomprobantes[2]' class='btn btn-sm btn-primary' role='button'>Ver Archivo Original </a></span> <span class='label label-success'>PDF</span>
                      </div>
                    </div>
                  </div>
                  ";
              }
            }
          ?>

    </div>

  </div>
</div>
		<?php 
			include("inc/footer-common.php");
		 ?>
    </body>
</html>
