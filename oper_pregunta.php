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

    <title><?php echo $_SESSION['nombre-sitio']; ?> :: <?php echo $operacion; ?> Pregunta</title>

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

          <li><a href="panel-avisos.php">Panel de Administracion</a></li>

          <li class="active"><?php echo $operacion; ?> Pregunta</li>

        </ol>

      </div>

    </div>

  </div>

<div class="container">

  <div class="row">

    <div class="col-xs-12">

      <h4><?php echo $operacion; ?> Pregunta</h4><br>

    </div>

  </div>

  <?php 

    if($operacion == "Agregar"){
		$idEncuesta = $_GET['i'];
    	$tituloAviso = "";

      $tituloDescripcion = "";

      $typeOper = "add";

	  $pregunta = "";

      $respuesta1 = "";
	  $respuesta2 = "";
	  $respuesta3 = "";
	  $respuesta4 = "";
	
    }elseif($operacion == "Editar"){

      $id_Preguntas = $_GET['i'];

      $typeOper = "edit&i=".$id_Preguntas;
	  $idEncuesta = $_GET['i'];
      $conocerDatosPreg = mysqli_query($mysqli,"select * from preguntasencuestas where idPreguntas=$id_Preguntas;") or die(mysqli_error($mysqli));

      $filaDatosPreg = mysqli_fetch_row($conocerDatosPreg);

      $pregunta = $filaDatosPreg[2]	;

      $respuesta1 = $filaDatosPreg[3];
	  $respuesta2 = $filaDatosPreg[4];
	  $respuesta3 = $filaDatosPreg[5];
	  $respuesta4 = $filaDatosPreg[6];

    }

  ?>

  <form action="_oper_preguntas.php?oper=<?php echo $typeOper; ?>" method="POST" name="frm_User" class="form-horizontal">

  <div class="row">
		<div class="col-xs-12 col-lg-6">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
					    <label for="inputName" class="control-label col-md-4 col-xs-3">Pregunta</label>
						<div class="col-md-8 col-xs-9">
							<textarea rows="5" cols="54" class="form-control" name="pregunta" placeholder="Pregunta" required><?php echo $pregunta ?></textarea>
				        </div>
					</div>
				</div>
	        </div>              
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="inputName" class="control-label col-md-4 col-xs-3">Respuesta1</label>
			            <div class="col-md-8 col-xs-9">
				            <input type="name" class="form-control" name="respuesta1" placeholder="Respuesta1" value="<?php  echo $respuesta1?>" required>
			            </div>
					</div>
				</div>
		    </div>              
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="inputName" class="control-label col-md-4 col-xs-3">Respuesta2</label>
			            <div class="col-md-8 col-xs-9">
				            <input type="name" class="form-control" name="respuesta2" placeholder="Respuesta2" value="<?php  echo $respuesta2?>" required>
			            </div>
					</div>
				</div>
		    </div>              
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="inputName" class="control-label col-md-4 col-xs-3">Respuesta3</label>
			            <div class="col-md-8 col-xs-9">
				            <input type="name" class="form-control" name="respuesta3" placeholder="Respuesta3" value="<?php  echo $respuesta3?>">
			            </div>
					</div>
				</div>
		    </div>              
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="inputName" class="control-label col-md-4 col-xs-3">respuesta4</label>
			            <div class="col-md-8 col-xs-9">
				            <input type="name" class="form-control" name="respuesta4" placeholder="Respuesta4" value="<?php  echo $respuesta4?>" >
			            </div>
					</div>
				</div>
		    </div>              
	    </div>
	</div>
	
	<?php
		
			echo "<input type='hidden' name='idEncuesta' value='$idEncuesta'>";
		
	?>
   	<div class="row">
	    <div class="col-xs-12 col-lg-6">
		    <div class="text-right">
				<?php 
					/*if($operacion == "Editar") 
						echo "<a href='_oper_aviso.php?oper=del&i=$id_Preguntas' class='btn btn-danger'>Eliminar</a>"; */
				?> 
				<a href='oper_encuesta.php?oper=edit&i=<?php echo $idEncuesta; ?>' class='btn btn-danger'>Cancelar</a>
				<button type="submit" class="btn btn-success">Guardar</button>
		    </div>
		</div>
	</div>



</form>

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

