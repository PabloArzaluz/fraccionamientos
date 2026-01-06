<?php

	session_start();

	$actual_page = "quejas";

	include('configPHP/conecta.inc.php');

  	include('configPHP/config.inc.php');

  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  	

   date_default_timezone_set('America/Mexico_City');

   include("inc/config-site.php");

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



		<title>Quejas y Sugerencias :: <?php echo $_SESSION['nombre-sitio']; ?></title>

	

		<!-- Bootstrap core CSS -->

		<link href="css/bootstrap.min.css" rel="stylesheet">

		<link href="css/style_web.css" rel="stylesheet">

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

					<li><a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a></li>

					<li class="active">Quejas y Sugerencias</li>

				</ol>

			</div>

		</div>

	</div>

	<div class="container">

		<div class="row">

			<div class="col-xs-12">

				<h4>Quejas y Sugerencias</h4>

			</div>

		</div>

	

	<div class="row">

		<div class="col-lg-9 col-xs-12">

			<p>El proposito de esta seccion es compartir opiniones sobre nuestro Fraccionamiento, y dar puntos de vista para mejorar aspectos importantes</p>

		</div>

		<div class="col-lg-3 col-xs-12 text-right"><a href="nuevo-qys.php?oper=add" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Tema</a></div>

	</div>

<br>

	<?php 

		$conocerTotalQyS = "select qys.id_qys,titulo, descripcion, user.nombre, qys.fecha, qys.hora, visitas,no_casa,img from qys inner join user on user.id_user= qys.id_user where status=1 order by qys.fecha desc,qys.hora desc;";

		$iny_Total_QyS = mysqli_query($mysqli,$conocerTotalQyS) or die(mysqli_error($mysqli));

		echo "<div class='row'>

		<div class='table-responsive'>

		<table class='table'>

			<thead>

				<tr>

					<th>

					Tema  

					</th>

					<th>

					Fecha Creacion

					</th>

					<th>

						 Autor / Casa

					</th>

					<th>

						Fecha Hora Ultima Respuesta

					</th>

					<th>

						Total de Respuestas

					</th>

				</tr>

			</thead>

			<tbody>";

		while($arr_qys = mysqli_fetch_array($iny_Total_QyS)){ 

			echo "<tr>

					<td>

						<a href='ver-qys.php?id=$arr_qys[0]'><span class='font-big'>$arr_qys[1]";

							if($arr_qys[8] != ""){

								echo "  <span class='glyphicon glyphicon-picture' aria-hidden='true'></span>";

							}

						echo "</span><br>

						</a

					</td>

					<td>

						";

						$date = new DateTime($arr_qys[4]); 

						echo date_format($date, 'd/m/Y');



						$hora = date_create($arr_qys[5]);

               echo date_format($hora, ' h:i:s a');



					echo"</td>

					<td>

						$arr_qys[3] - # $arr_qys[7]

					</td>";

					$conoceridUltimaRespuesta = "SELECT MAX(id_qys_reply) FROM qys_reply where id_qys=$arr_qys[0]";

					$iny_conocerIdUltimaRespuesta = mysqli_query($mysqli,$conoceridUltimaRespuesta) or die(mysqli_error($mysqli));



					$filaid_Ultima = mysqli_fetch_row($iny_conocerIdUltimaRespuesta);



					if($filaid_Ultima[0] != ""){

						

						

						$conocerDatosultimas = "select fecha,hora from qys_reply where id_qys_reply = ".$filaid_Ultima[0].";";

					$inyConocerDatosUltimas = mysqli_query($mysqli,$conocerDatosultimas) or die(mysqli_error($mysqli));



					$filaDatosUltima = mysqli_fetch_row($inyConocerDatosUltimas);

					echo "<td>";

					$fecha = date_create($filaDatosUltima[0]);

               echo date_format($fecha, 'd/m/Y');

               echo " ";

               $hora = date_create($filaDatosUltima[1]);

               echo date_format($hora, ' h:i:s a');



					echo "</td>";



					$ContarTotalRespuestas = "select count(id_qys_reply) from qys_reply where id_qys = $arr_qys[0];";

					$inyContarTotalRespuestas = mysqli_query($mysqli,$ContarTotalRespuestas) or die(mysqli_error($mysqli));



					$filaTotalRespuestas = mysqli_fetch_row($inyContarTotalRespuestas);

					echo "<td>$filaTotalRespuestas[0]</a></td>";

					}else{

						echo "<td>No hay respuestas aun</td><td>No hay respuestas aun</td>";

					}





					

				echo "</tr>";

		}

		echo "</tbody>

		</table>

		</div>

		</div>";

	?>

	</div>

	</div>  

	



		<?php 

			include("inc/footer-common.php");

		 ?>

		</body>

</html>

