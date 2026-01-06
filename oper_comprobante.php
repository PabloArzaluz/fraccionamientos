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

  if($_GET['agre'] == "add"){

    $operacion = "Agregar";

  }elseif ($_GET['oper'] == "edit") {

    $operacion = "Editar";

  }

?>

<!DOCTYPE html>

<html lang="es">

  <head>

    <title><?php echo $_SESSION['nombre-sitio']; ?> :: <?php echo $operacion; ?> Aviso</title>

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

          <li><a href="panel-comprobantes-gastos.php">Panel de Administracion</a></li>

          <li class="active"><?php echo $operacion; ?> Comprobante</li>

        </ol>

      </div>

    </div>

  </div>

<div class="container">

  <div class="row">

    <div class="col-xs-12">

      <h4><?php echo $operacion; ?> Comprobante</h4><br>

    </div>

  </div>

  <?php 

    if($operacion == "Agregar"){

      $tituloAviso = "";

      $tituloDescripcion = "";

      $typeOper = "add";

    }elseif($operacion == "Editar"){

      $id_noti = $_GET['i'];

      $typeOper = "edit&i=".$id_noti;

      $conocerDatosNoti = mysqli_query($mysqli,"select * from noti where id_noti=$id_noti;") or die(mysqli_error($mysqli));

      $filaDatosNoti = mysqli_fetch_row($conocerDatosNoti);

      $tituloAviso = $filaDatosNoti[1]  ;

      $tituloDescripcion = $filaDatosNoti[2];

    }

  ?>

  <form action="_oper_comprobante.php?oper=<?php echo $typeOper;?> " method="POST" name="frm_User" class="form-horizontal" enctype="multipart/form-data">

	<div class="row">
		<div class="col-lg-6 col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="tituloInpt" class="control-label col-md-4 col-xs-3">Titulo comprobante</label>
						<div class="col-md-8 col-xs-9">
							<input name="titulo" id="tituloInpt" class="form-control" type="text" />
						</div>
					</div>
					<div class="form-group">
						<label for="descripcionInpt" class="control-label col-md-4 col-xs-3">Descripcion</label>
						<div class="col-md-8 col-xs-9">
							<textarea name="descripcion" id="descripcionInpt" class="form-control" cols="100"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="selector-fecha1" class="control-label col-md-4 col-xs-3">Fecha</label>
						<div class="col-md-8 col-xs-9">
						<input  type="text" class="form-control" value="" placeholder="Selecciona Fecha"  name="fecha" id="selector-fecha1" required>
						</div>
					</div>
					<div class="form-group">
						<input class="form-control" name="archivo" type="file" id="archivo" />
						<br>
						<div id="div_info"></div>
						<input type="button" value="Guardar" onclick="verify_ext(this.form, this.form.archivo.value)" name="subirBtn" class="btn btn-success" />
						<a href="panel-comprobantes-gastos.php" class='btn btn-danger'>Cancelar</a>
					</div>
				</div>
			</div>
		</div>              
    </div>
</div>

   <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="text-right">

        <?php if($operacion == "Editar") echo "<a href='_oper_aviso.php?oper=del&i=$id_noti' class='btn btn-danger'>Eliminar</a>"; ?> 

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
