<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  $actual_page = "encuestas";
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



    <title>Encuestas :: <?php echo $_SESSION['nombre-sitio']; ?></title>

	

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

          <li><a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a></li>

          <li class="active">Encuestas</li>

        </ol>

      </div>

    </div>

  </div>

  <div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php
				$consulta_noti = mysqli_query($mysqli,"SELECT * FROM encuestas where status=1 order by fechahora desc;") or die(mysqli_error($mysqli));
				while($arr_usuarios = mysqli_fetch_array($consulta_noti)){ 
					echo "<div class='row'>

                      <div class='col-xs-12'>

                        <div class='panel panel-primary'>

                          <div class='panel-heading'>";

                          echo "<h4 class='panel-title' id='sin-salto-h'>$arr_usuarios[4]</h4>";

                            //if si es nuevo aviso

                          echo "</div>";

                          echo "<div class='panel-body'>";
                          echo "<h4>".$arr_usuarios[5]."</h4>";
                          //Validar que se tengan respuestas en Encuesta
                          $idUsuario = $_SESSION['id_user'];
                          $conocerEncuestaRealizada = "SELECT * FROM respuestasencuestas WHERE idEncuestas = $arr_usuarios[0] and idUsuario = $idUsuario";
                          $iny_conocerEncuestaRealizada = mysqli_query($mysqli,$conocerEncuestaRealizada,$link);
                          $f_conocerEncuestaRealizada = mysqli_fetch_row($iny_conocerEncuestaRealizada);
                          if($f_conocerEncuestaRealizada > 0){
                            //Ya hay respuestas ingresadas
                            echo '<div class="alert alert-warning" role="alert">
                            Ya se registro su respuesta.
                            </div>';
                            echo '<a href="#">Ver Resultados</a>';
                        }else{
                          echo "<a href='responder_encuesta.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-md'>CONTESTAR ENCUESTA</a>";
                        }
						  
                                  echo "

                                  </div>";

                          echo "<div class='panel-footer text-right'>";

                            echo "Fecha Encuesta: <b>".$arr_usuarios[2]."</b> ";

                            

                           

                            

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

