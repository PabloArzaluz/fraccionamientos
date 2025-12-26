<?php
	session_start();
  $actual_page = "mantenimiento";
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();

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
    $conocercantidad = mysql_query("SELECT COUNT(DISTINCT id_mantto) from  mantto;",$link) or die(mysql_error());
    $cantidad = mysql_fetch_row($conocercantidad);
    $conocerpagados = mysql_query("select count(DISTINCT id_mantto) from mantto where estatus=1;",$link) or die(mysql_error());
    $cantidadpagados = mysql_fetch_row($conocerpagados);
    $porcentajepagados = ($cantidad[0] / 100 ) * $cantidadpagados[0];
    $porcentajenopagados = 100 - $porcentajepagados ;
  ?>
  <div class="container">
    <div class="row">
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
            $consulta_mantto = mysql_query("select user.id_user,user.no_casa,mantto.estatus from user inner join mantto on user.id_user = mantto.id_user order by user.no_casa;",$link) or die(mysql_error());
            while($arr_mantto = mysql_fetch_array($consulta_mantto)){ 
              echo "<tr ";
                if($arr_mantto[2] == 0){echo "class='danger'";}else{echo "class='success'";}
              echo "><td>$arr_mantto[1]</td><td>";
                if($arr_mantto[2] == 0){echo "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> No Pagado";}else{echo "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Pagado"; }
              echo "</td></tr>";
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
