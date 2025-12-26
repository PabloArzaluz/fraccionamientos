<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();
  date_default_timezone_set('America/Mexico_City');
  $current_page_admin = "estados-cuenta";


  $mesActual  = date('m');
  $anoActual = date('Y');
  $fechaActual = $anoActual."-".$mesActual."-01";

  function getUltimoDiaMes($elAnio,$elMes) {
  return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
  }

  
  

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Estados de Cuenta :: Panel Admin</title>
    <?php include("inc/head-common.php"); ?>
    <script type='text/javascript'>
    function cambiarMes(){
      if(document.getElementById('generaFecha').options[document.getElementById('generaFecha').selectedIndex].value != ""){
        var fechaRequerida = document.getElementById('generaFecha').options[document.getElementById('generaFecha').selectedIndex].value;
        window.location = "panel-estados-cuenta.php?fecha="+fechaRequerida;
      }
      
    }
     </script>
  

  </head>

  <body>
  <?php 
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
  	include("inc/nav-common.php")
  ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ol class="breadcrumb">
          <li><a href="index.php">Country del Lago</a></li>
          <li class="active">Panel de Administracion</li>
        </ol>
      </div>
    </div>
  </div>
<div class="container">
<?php include("inc/nav-panel-admin.php"); ?>
</div>
<div class="container">
<br>
  <div class="row">
    <div class="col-xs-9">
      <a href="oper_estado_cuenta.php?agre=add" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cargar Estado de Cuenta</a>
    </div>
    <div class="col-xs-3 text-right">

      <?php 
        $consulta_mes = mysql_query("SELECT distinct year(fecha),month(fecha) FROM estados WHERE MONTH(fecha) order by fecha desc;",$link) or die(mysql_error());
        if(mysql_num_rows($consulta_mes)>0){
          echo "<select class='form-control'  id='generaFecha' onchange='cambiarMes()' required>";
          echo "<option value=''>Seleccione un Mes</option>";
          while($filaMes = mysql_fetch_array($consulta_mes)){
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

  </div>
  <br>
  <?php if(isset($_GET['info']) && $_GET['info'] == 1){ ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Estado de Cuenta Cargado Correctamente
      </div>
    </div>
  </div>
  <?php } ?>
 
    <div class="row">
    <div class="col-xs-12">
<table class="table table-condensed table-bordered">
<thead>
<tr>
<th>Titulo</th>
<th>Ruta</th>
<th>Descripcion</th>
<th></th><th></th>
</tr>
</thead>
<?php
//echo $fechaRequerida;
//echo $fecha_entre;
  $consulta_noti = mysql_query("SELECT * FROM estados where fecha BETWEEN '$fechaRequerida' and '$fecha_entre';",$link) or die(mysql_error());
  while($arr_comentarios = mysql_fetch_array($consulta_noti)){ 
              echo "<tr>
              <td>$arr_comentarios[1]</td>
              <td>$arr_comentarios[2]</td>
              <td>$arr_comentarios[4]</td>
              
              <td class='text-center'>
              <div class='btn-group' role='group' aria-label='...'>";

            if ($arr_comentarios[5]=="pdf") {
             echo "<a href='visor.php?oper=$arr_comentarios[2]' class='btn btn-success btn-xs'>Ver</a></div></td>";
            }
            elseif ($arr_comentarios[5]=="jpg") {
              
              echo "<a href='$arr_comentarios[2]' class='btn btn-success btn-xs' >Ver</a></div></td>";
            }
              echo "<td><a href='delete-estados.php?id=$arr_comentarios[0]&f=$fechaRequerida' class='btn btn-danger btn-xs'>Eliminar</a></td></tr>";
            }
          ?>
</table>
    </div>
  </div>
  </div>



  <?php 
		include("inc/footer-common.php");
	?>
  <script type="text/javascript">
  $('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
  </script>
    </body>
</html>