<?php

  session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  include("inc/config-site.php");

  if(!isset($_SESSION['id_user'])){
		header('Location:index.php');
		die();
	}

  if($_GET['oper'] == "add"){

    $operacion = "Agregar";

  }elseif ($_GET['oper'] == "edit") {

    $operacion = "Editar";

  }

?>

<!DOCTYPE html>

<html lang="es">

  <head>

    <title><?php echo $_SESSION['nombre-sitio']; ?> :: <?php echo $operacion; ?> Encuesta</title>

    <?php include("inc/head-common.php"); ?>

    <script type="text/javascript">

    function verify_ext(form, file) { 

        extensiones_permitidas = new Array(".jpg", ".pdf",".jpeg"); 

         aviso = ""; 

         if (!file || document.getElementById("descripcionInpt").value == "" || document.getElementById("tituloInpt").value == "") { 

            aviso = "<div class='alert alert-danger' role='danger'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Ningun Archivo Seleccionado, o algunos campos estan vacios </div>"; 

         }else{ 

            extension = (file.substring(file.lastIndexOf("."))).toLowerCase(); 

            permitida = false; 

            for (var i = 0; i < extensiones_permitidas.length; i++) { 

               if (extensiones_permitidas[i] == extension) { 

               permitida = true; 

               break; 

               } 

            } 

            if (!permitida) { 

               aviso = "<div class='alert alert-danger' role='danger'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Archivo Invalido. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join()+"</div>"; 

              }else{ 

              document.getElementById('extensionInput').value=extension ; 

              form.submit(); 

               return 1; 

              } 

         } 

         document.getElementById("div_info").innerHTML = aviso;

         return 0; 

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

          <li><a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a></li>

          <li><a href="panel-encuestas.php">Panel de Administracion</a></li>

          <li class="active"><?php echo $operacion; ?> Encuesta</li>

        </ol>

      </div>

    </div>

  </div>

<div class="container">

  <div class="row">

    <div class="col-xs-12">

      <h4><?php echo $operacion; ?> Encuesta</h4><br>

    </div>

  </div>

  <?php 

    if($operacion == "Agregar"){

	$tituloEncuesta = "";
  $descripcionEncuesta = "";

      $estatusEncuesta = "1";

      $typeOper = "add";

    }elseif($operacion == "Editar"){

      $id_encuesta = $_GET['i'];

      $typeOper = "edit&i=".$id_encuesta;

      $conocerDatosEncuesta = mysqli_query($mysqli,"select * from encuestas where idEncuesta=$id_encuesta;") or die(mysqli_error($mysqli));

      $filaDatosEncuesta = mysqli_fetch_row($conocerDatosEncuesta);

      $estatusEncuesta = $filaDatosEncuesta[3]  ;

      $tituloEncuesta = $filaDatosEncuesta[4];
      $descripcionEncuesta = $filaDatosEncuesta[5];

    }

  ?>

  <form action="_oper_encuestas.php?oper=<?php echo $typeOper;?> " method="POST" name="frm_User" class="form-horizontal" enctype="multipart/form-data">
	
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<div class="row">
				<div class="col-xs-12">
        			<div class="form-group">
						<label for="tituloInpt" class="control-label col-md-4 col-xs-3">Estado de Encuesta</label>
						<div class="col-md-8 col-xs-9">
							<select class="form-control" name="statusEncuesta" id="statusEncuesta">
								<option <?php if($estatusEncuesta == 1)echo "selected"; ?> value="1">Activa</option>
								<option <?php if($estatusEncuesta == 0)echo "selected"; ?> value="0">Inactiva</option>
              				</select>
						</div>
					</div>
					<div class="form-group">
						<label for="tituloInpt" class="control-label col-md-4 col-xs-3">Titulo Encuesta</label>
						<div class="col-md-8 col-xs-9">
							<input name="titulo" id="tituloInpt" class="form-control" value="<?php echo $tituloEncuesta; ?>" required type="text" />
						</div>
					</div>
          <div class="form-group">
						<label for="descripcionInpt" class="control-label col-md-4 col-xs-3">Descripcion de Encuesta</label>
						<div class="col-md-8 col-xs-9">
							<input name="descripcion" id="tituloInpt" class="form-control" value="<?php echo $descripcionEncuesta; ?>"  type="text" />
						</div>
					</div>
        		    <div class="form-group">
						<br>
						<div id="div_info"></div>
						<input type="submit" value="Guardar" name="subirBtn" class="btn btn-success" />
						<a href="panel-encuestas.php" class='btn btn-danger'>Cancelar</a>
					</div>
				</div>
			</div>
			<hr>
			<?php
				if($operacion == "Editar"){
			?>
			<div class="row">
				<div class="col-xs-12">
				<a href="oper_pregunta.php?oper=add&i=<?php echo $id_encuesta; ?>" class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva Pregunta</a>
				<br><br>
				<table class="table table-condensed table-bordered">
					<thead>
						<tr><th>ID</th><th>Pregunta</th><th>Respuesta1</th><th>Respuesta2</th><th>Respuesta3</th><th>Respuesta4</th><th>Acciones</th></tr>
					</thead>
					<?php
  						$consulta_noti = mysqli_query($mysqli,"SELECT idPreguntas,pregunta, respuesta1, respuesta2, respuesta3, respuesta4 FROM preguntasencuestas where idEncuesta = $id_encuesta;") or die(mysqli_error($mysqli));
              //Funcion Cnocer Cantidad Respuestas
              function ConocerCantidadRespuestas($idEncuestaF,$idPregEncuestF,$respuestaF){
                global $link;
                $conocerCantRespF = "SELECT COUNT(respuesta) FROM respuestasencuestas WHERE idEncuestas=$idEncuestaF and idPreguntasEncuestas=$idPregEncuestF and respuesta='$respuestaF';";
                $iny_conocerCantRespF = mysqli_query($mysqli,$conocerCantRespF,$link);
                $f_conocerCantRespF = mysqli_fetch_row($iny_conocerCantRespF);
                if($f_conocerCantRespF[0] > 0){
                  return "Respuestas:".$f_conocerCantRespF[0];
                }
                
              }
						while($arr_usuarios = mysqli_fetch_array($consulta_noti)){ 
							//Conocer Preguntas
							
							echo "<tr><td>$arr_usuarios[0]</td><td>$arr_usuarios[1]</td>";
              //respuesta1
              echo "<td><strong>$arr_usuarios[2]</strong> <br><i>".ConocerCantidadRespuestas($id_encuesta,$arr_usuarios[0],$arr_usuarios[2])."</i></td>";

              //respuesta2
              echo "<td><strong>$arr_usuarios[3]</strong> <br><i>".ConocerCantidadRespuestas($id_encuesta,$arr_usuarios[0],$arr_usuarios[3])."</i></td>";
              //respuesta3
              echo "<td><strong>$arr_usuarios[4]</strong> <br><i> ".ConocerCantidadRespuestas($id_encuesta,$arr_usuarios[0],$arr_usuarios[4])."</i></td>";
              //respuesta4
              echo "<td><strong>$arr_usuarios[5]</strong> <br><i>".ConocerCantidadRespuestas($id_encuesta,$arr_usuarios[0],$arr_usuarios[5])."</i></td>";
							
							echo "<td class='text-center'><div class='btn-group' role='group' aria-label='...'>
							<a href='oper_pregunta.php?oper=edit&i=$arr_usuarios[0]&idE=$id_encuesta' class='btn btn-success btn-xs'>Editar</a></div></td></tr>";
						} 
					?>
				</table>
			</div>
			<?php
				}
			?>
		</div>
		</div>              
    </div>
</div>

   <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="text-right">

        <?php if($operacion == "Editar") echo "<a href='_.php?oper=del&i=$id_encuesta' class='btn btn-danger'>Eliminar</a>"; ?> 

      </div>

    </div>

  </div>

<input type="hidden" id="extensionInput" name="extension">

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
	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function () {
			$('#selector-fecha1').datepicker({
				format: "yyyy/mm/dd",
				language: "es",
				autoclose: true,
				todayHighlight: true,
				toolbarPlacement:"top",
				orientation: "bottom auto"
			});  
		});
	</script>
    </body>

</html>
