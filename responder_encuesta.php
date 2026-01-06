<?php

	session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  include("inc/config-site.php");

  if($_GET['oper'] == "add"){

    $operacion = "Agregar";

  }elseif ($_GET['oper'] == "edit") {

    $operacion = "Editar";

  }

?>

<!DOCTYPE html>

<html lang="es">

  <head>

    <title><?php echo $_SESSION['nombre-sitio']; ?> :: <?php //echo $operacion; ?> Responder Encuesta</title>

    <?php include("inc/head-common.php"); ?>

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
          <li><a href="encuestas.php">Encuestas</a></li>
          <li class="active"><?php //echo $operacion; ?> Responder Encuesta</li>
        </ol>
      </div>
    </div>
  </div>
	<?php
		//Validar que usuario ya respondio encuestas
		$idUsuario = $_SESSION['id_user'];
		$idUsuario = $_SESSION['id_user'];
		$idEncuesta = $_GET['i'];
		$conocerRespuestasEncuestas = mysqli_query($mysqli,"select * from respuestasencuestas where idUsuario=$idUsuario and idEncuestas = $idEncuesta;") or die(mysqli_error($mysqli));
		
		if(mysqli_num_rows($conocerRespuestasEncuestas) > 0){
			echo '<div class="container">
		<div class="row">
			<div class="col-xs-12">
			<div class="alert alert-warning" role="alert">
			Esta Encuesta ya se respondio. <a href="encuestas.php">Regresar a Encuestas</a>
		  </div>	
			</div>
		</div>
		</div>';
			//Si hay Respuestas REgistradas, por lo tanto se da por hecho que el usuario ya registro sus respuestas, se muetra la opcion de los resultados
	?>

	<?php
	//Fin de Mostrar resultados
		}else{
			
			//No hay respuestas registradas, por lo tanto se muestran las preguntas a responder
			$consultaInfoEncuesta = mysqli_query($mysqli,"SELECT * FROM encuestas where status=1 and idEncuesta = $idEncuesta;") or die(mysqli_error($mysqli));
			$f_InfoEncuesta = mysqli_fetch_row($consultaInfoEncuesta);
			
			
	?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h3>Titulo: <?php echo $f_InfoEncuesta[4]; ?> </h3><br>
				<h4>Descripcion: <?php echo $f_InfoEncuesta[5]; ?> </h4><br>
			</div>
		</div>
		<form action="_registrarRespuestasEncuesta.php" method="POST" name="frm_User" class="">
			<input type="hidden" name="idencuesta" value="<?php echo $idEncuesta; ?>">
		<div class="row">
				<div class="col-xs-12 col-lg-6">
			<?php
				$conocerPreguntas = mysqli_query($mysqli,"select * from preguntasencuestas where idEncuesta = $idEncuesta;") or die(mysqli_error($mysqli));
				if(mysqli_num_rows($conocerPreguntas) > 0){
					$contadorPreguntas = 1;
					while($arr_Preguntas = mysqli_fetch_array($conocerPreguntas)){ 
						
						echo '
						<div class="row col-5">
						<h4 class="fw-bold text-center mt-3"></h4>
						
						  <p class="fw-bold">'.$arr_Preguntas[2].'</p>
						  ';
						//Respuestas Validar si tienen texto y mostrarlas
							$respuesta1 = $arr_Preguntas[3];
							$respuesta2 = $arr_Preguntas[4];
							$respuesta3 = $arr_Preguntas[5];
							$respuesta4 = $arr_Preguntas[6];
							
							if(!empty($respuesta1)){
								echo '
								<div class="form-check mb-2">
								<input class="form-check-input" type="radio" name="pregunta['.$arr_Preguntas[0].']" id="radioExample1" value="'.$arr_Preguntas[3].'" required />
								<label class="form-check-label" for="radioExample1">
									'.$arr_Preguntas[3].'
								</label>
							  </div>
								';
							}
							if(!empty($respuesta2)){
								echo '
								<div class="form-check mb-2">
								<input class="form-check-input" type="radio" name="pregunta['.$arr_Preguntas[0].']" id="radioExample2" value="'.$arr_Preguntas[4].'" required />
								<label class="form-check-label" for="radioExample2">
									'.$arr_Preguntas[4].'
								</label>
							  </div>
								';
							}
							if(!empty($respuesta3)){
								echo '
								<div class="form-check mb-2">
								<input class="form-check-input" type="radio" name="pregunta['.$arr_Preguntas[0].']" id="radioExample3" value="'.$arr_Preguntas[5].'" required />
								<label class="form-check-label" for="radioExample3">
									'.$arr_Preguntas[5].'
								</label>
							  </div>
								';
							}
							if(!empty($respuesta4)){
								echo '
								<div class="form-check mb-2">
								<input class="form-check-input" type="radio" name="pregunta['.$arr_Preguntas[0].']" id="radioExample4" value="'.$arr_Preguntas[6].'" required />
								<label class="form-check-label" for="radioExample4">
									'.$arr_Preguntas[6].'
								</label>
							  </div>
								';
							}

						 echo '				
					  </div>
					  <hr>
						';
						$contadorPreguntas++;
					}
			?>
			<div class="text-right">
						<div class="text-end">
							<button type="submit" class="btn btn-primary">Enviar Respuestas</button>
						</div>
					</div>
			<?php
				}else{
					echo '<div class="alert alert-warning" role="alert">
					No hay preguntas registradas en esta encuesta. <a href="encuestas.php">Regresar a Encuestas</a>
				  </div>';
				}
			?>
			
					

					
				</div>
			</div>
			<br>
		</form>
	</div>
	<?php
		//Fin de ingresar respuestas
		}
	?>



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

