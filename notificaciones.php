<?php
	session_start();
  include('configPHP/config.inc.php');
  $actual_page = "notificaciones";
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

    <title>Avisos :: <?php echo $nombre_fraccionamiento; ?></title>
	
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
          <li><a href="index.php"><?php echo $nombre_fraccionamiento; ?></a></li>
          <li class="active">Avisos</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-danger">
        <div class="panel-heading"><h4 class="panel-title" id="sin-salto-h">Pago de Mantenimiento</h4> <span class="label label-success">Aviso Fijado</span></div>
  <div class="panel-body">
<?php
$ano = date("Y");
$mes = date("m");

// Forma optimizada de traducir el mes
$meses = [
    "January" => "Enero", "February" => "Febrero", "March" => "Marzo", 
    "April" => "Abril", "May" => "Mayo", "June" => "Junio", 
    "July" => "Julio", "August" => "Agosto", "September" => "Septiembre", 
    "October" => "Octubre", "November" => "Noviembre", "December" => "Diciembre"
];
$mesNombre = $meses[date("F")];

$fechaActual = $ano . "-" . $mes . "-01";

// 1. Obtener total de casas
$conocercantidad = mysqli_query($mysqliConn, "SELECT COUNT(DISTINCT id_user) FROM user WHERE level=0") or die(mysqli_error($mysqliConn));
$filaCantidad = mysqli_fetch_row($conocercantidad);
$totalCasas = (int)($filaCantidad[0] ?? 0);

// 2. Obtener total de pagados
$conocerpagados = mysqli_query($mysqliConn, "SELECT COUNT(DISTINCT id_mensualidad) FROM mensualidades WHERE fecha='$fechaActual'") or die(mysqli_error($mysqliConn));
$filaPagados = mysqli_fetch_row($conocerpagados);
$totalPagados = (int)($filaPagados[0] ?? 0);

// 3. Cálculos (Corregido: usando las variables correctas)
$porcentajepagados = 0;
$porcentajenopagados = 100; // Si no hay casas, el 100% está "pendiente" o 0 según prefieras

if ($totalCasas > 0) {
    // Usamos las variables que definimos arriba
    $porcentajepagados = round(($totalPagados * 100) / $totalCasas, 0);
    $porcentajenopagados = 100 - $porcentajepagados;
}

echo "Hasta el día de hoy en <strong>$mesNombre</strong> se llevan <strong>$totalPagados</strong> casas pagadas, de un total de <strong>$totalCasas</strong> casas.";
?>
  </div>
  
</div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <?php
          $consulta_noti = mysqli_query($mysqliConn,"SELECT id_noti,titulo,texto,fecha,noti.id_user,hora,user.nombre FROM noti inner join user on user.id_user=noti.id_user;") or die(mysqli_error($mysqliConn));
            while($arr_usuarios = mysqli_fetch_array($consulta_noti)){ 
              echo "<div class='row'>
                      <div class='col-xs-12'>
                        <div class='panel panel-primary'>
                          <div class='panel-heading'>";
                          echo "<h4 class='panel-title' id='sin-salto-h'>$arr_usuarios[1]</h4>";
                            //if si es nuevo aviso
                          echo "</div>";
                          echo "<div class='panel-body'>
                                  $arr_usuarios[2]
                                  </div>";
                          echo "<div class='panel-footer text-right'>";
                            echo "Escrito por: <b>".$arr_usuarios[6]."</b> el ";
                            $date = date_create($arr_usuarios[3]);
                            echo date_format($date, 'd/m/Y');
                            echo " a las ";
                            echo $arr_usuarios[5  ];
                          echo "</div>";
                        echo "</div>
                          </div>
                        </div>";
              /*echo "$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td>$arr_usuarios[3]</td><td>$arr_usuarios[5]</td><td>$arr_usuarios[6]</td><td class='text-center'><div class='btn-group' role='group' aria-label='...'>
                <a href='oper_user.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Editar</a></div></td></tr>";*/

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
