<?php
	session_start();
  $actual_page = "mantenimiento";
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();
date_default_timezone_set('America/Mexico_City');
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

    <title>Mantenimiento :: Country del Lago</title>
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
          <li class="active">Pago de Mantenimiento</li>
        </ol>
      </div>
    </div>
  </div>
  <?php
  $ano = date("Y");
  $mes = date("m"); 
 $mes2=date("F");
  if ($mes2=="January") $mes2="Enero";
  if ($mes2=="February") $mes2="Febrero";
  if ($mes2=="March") $mes2="Marzo";
  if ($mes2=="April") $mes2="Abril";
  if ($mes2=="May") $mes2="Mayo";
  if ($mes2=="June") $mes2="Junio";
  if ($mes2=="July") $mes2="Julio";
  if ($mes2=="August") $mes2="Agosto";
  if ($mes2=="September") $mes2="Setiembre";
  if ($mes2=="October") $mes2="Octubre";
  if ($mes2=="November") $mes2="Noviembre";
  if ($mes2=="December") $mes2="Diciembre";
 $fechaActual = $ano."-".$mes."-01";

    $conocercantidad = mysql_query("select COUNT(DISTINCT id_user) from  user where level=0;",$link) or die(mysql_error());
    $cantidad = mysql_fetch_row($conocercantidad);
    $conocerpagados = mysql_query("select count(DISTINCT id_mensualidad) from mensualidades where fecha='$fechaActual';",$link) or die(mysql_error());
    $cantidadpagados = mysql_fetch_row($conocerpagados);
    $porcentajepagados = round(($cantidadpagados[0] * 100 ) / $cantidad[0],0);
    $porcentajenopagados = 100 - $porcentajepagados ;
  ?>
  <div class="container">
    <div class="row">
    <div class="col-xs-12"><h4>Relacion de Pagos: <?php echo $mes2." - ".$ano; ?></h4></div>
      <div class="col-xs-12">
        <div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo $porcentajepagados;?>%">
    Pagado <?php echo $porcentajepagados."% (".$cantidadpagados[0].")";?>
  </div>
  <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php echo $porcentajenopagados;?>%">
    No Pagado <?php echo $porcentajenopagados."% (".($cantidad[0]-$cantidadpagados[0]).")";?>
  </div>
</div>
        <div class="table-responsive">
          <table class="table table-condensed table-bordered">
            <thead>
              <tr><th>Numero Casa</th><th>Estatus</th></tr>
            </thead>
            <tbody>
              <?php
              

            $conocerUsuarioNormalesCasa = mysql_query("select id_user,no_casa from user where level = 0 order by no_casa; ",$link) or die(mysql_error());
            while($arrUsuarios = mysql_fetch_array($conocerUsuarioNormalesCasa)){
                $consulta_mantto = mysql_query("select * from  mensualidades where id_user=$arrUsuarios[0] and fecha='$fechaActual';",$link) or die(mysql_error());
                if(mysql_num_rows($consulta_mantto)>0){
                  echo "<tr class='success'><td> $arrUsuarios[1]</td><td><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Pagado</td></tr>";
                }else{
                  echo "<tr class='danger'><td>$arrUsuarios[1]</td><td><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> No Pagado</td></tr>";
                }

                  /*while($arr_mantto = mysql_fetch_array($consulta_mantto)){ 
                    echo "<tr ";
                      if($arr_mantto[2] == 0){echo "class='danger'";}else{echo "class='success'";}
                    echo "><td>$arr_mantto[1]</td><td>";
                      if($arr_mantto[2] == 0){echo "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> No Pagado";}else{echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Pagado"; }
                    echo "</td></tr>";
                  }*/
            }
             
          ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  

		<?php 
			include("inc/footer-common.php");
		 ?>
    </body>
</html>
