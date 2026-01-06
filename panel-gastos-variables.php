<?php

	session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  date_default_timezone_set('America/Mexico_City');

  $current_page_admin = "gastos-variables";

  include("inc/config-site.php");

  if(!isset($_SESSION['id_user'])){
		header('Location:index.php');
		die();
	}

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

    <title>Gastos Variables :: <?php echo $_SESSION['nombre-sitio']; ?></title>

    <?php include("inc/head-common.php"); ?>

    <script type='text/javascript'>

    function cambiarMes(){

      if(document.getElementById('generaFecha').options[document.getElementById('generaFecha').selectedIndex].value != ""){

        var fechaRequerida = document.getElementById('generaFecha').options[document.getElementById('generaFecha').selectedIndex].value;

        window.location = "panel-gastos-variables.php?fecha="+fechaRequerida;

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

          <li><a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a></li>

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

      <a href="oper_gasto_variable.php?agre=add" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cargar Gasto Variable</a>

    </div>

    <div class="col-xs-3 text-right">



      <?php 

        $consulta_mes = mysqli_query($mysqli,"SELECT DISTINCT
    YEAR(fecha)  AS anio,
    MONTH(fecha) AS mes
FROM gastos_variables
WHERE fecha IS NOT NULL
ORDER BY anio DESC, mes DESC;
") or die(mysqli_error($mysqli));

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

<th>Descripcion</th>

<th>Monto</th>

<th>Fecha</th>

<th></th>

</tr>

</thead>

<?php

//echo $fechaRequerida;

//echo $fecha_entre;

  $consulta_noti = mysqli_query($mysqli,"SELECT * FROM gastos_variables where fecha BETWEEN '$fechaRequerida' and '$fecha_entre';") or die(mysqli_error($mysqli));

  while($arr_comentarios = mysqli_fetch_array($consulta_noti)){ 

              echo "<tr>

              <td>$arr_comentarios[1]</td>

              <td>$ $arr_comentarios[2]</td>

              <td>";

                $date = date_create($arr_comentarios[4]);

                    echo date_format($date, 'd/m/Y');

              echo "</td>

              

              <td class='text-center'>

             ";



              echo "<a href='oper_gasto_variable.php?id=$arr_comentarios[0]&agre=edit' class='btn btn-primary btn-xs'>Editar</a>

              <a href='_delete_gastos_variables.php?id=$arr_comentarios[0]' class='btn btn-danger btn-xs'>Eliminar</a></td></tr>";

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