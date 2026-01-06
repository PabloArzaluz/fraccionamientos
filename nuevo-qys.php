<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  if($_GET['oper'] == "add"){
    $operacion = "Nuevo";
  }elseif ($_GET['oper'] == "edit") {
    $operacion = "Editar";
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Country del Lago :: <?php echo $operacion; ?> Aviso</title>
    <?php include("inc/head-common.php"); ?>
    <script type="text/javascript">
    function verify_ext(form, file) { 
        extensiones_permitidas = new Array(".jpg", ".pdf"); 
        aviso = ""; 

        if(!document.getElementById("archivo").value.length==0){
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
            
            //document.getElementById('archivo').value=extension ;
            form.submit();
            return 1; 
          } 
          
       }else{
        if (document.getElementById("descripcionInpt").value == "" || document.getElementById("tituloInpt").value == "") { 
            aviso = "<div class='alert alert-danger' role='danger'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>Algunos campos estan vacios </div>"; 
            return 0;
          }else{
            
            form.submit();
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
          <li><a href="index.php">Country del Lago</a></li>
          <li class="active"><?php echo $operacion; ?> Tema</li>
        </ol>
      </div>
    </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h4><?php echo $operacion; ?> Tema de Queja y/o Sugerencia</h4><br>
    </div>
  </div>
  <?php 
    if($operacion == "Nuevo"){
      $tituloAviso = "";
      $tituloDescripcion = "";
      $typeOper = "add";
    }elseif($operacion == "Editar"){
      $id_noti = $_GET['i'];
      $typeOper = "edit&i=".$id_noti;
      $conocerDatosNoti = mysqli_query($mysqli,"select * from noti where id_noti=$id_noti;") or die(mysqli_error($mysqli));
      $filaDatosNoti = mysqli_fetch_row($conocerDatosNoti);
      $tituloAviso = $filaDatosNoti[1]	;
      $tituloDescripcion = $filaDatosNoti[2];
    }
  ?>
  <form action="_oper_qys.php?oper=<?php echo $typeOper; ?>" method="POST" name="frm-new-qys" class="form-horizontal" enctype="multipart/form-data">
  <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Titulo</label>
              <div class="col-md-8 col-xs-9">
                <input type="name" class="form-control" name="titulo-qys" placeholder="Titulo" id="tituloInpt" value="<?php  echo $tituloAviso?>" required>
              </div>
            </div>
          </div>
        </div>              
      </div>
  </div>
  <div class="row">
      <div class="col-xs-12 col-lg-6">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Descripcion</label>
              <div class="col-md-8 col-xs-9">
                <textarea rows="10" cols="50" class="form-control" name="descripcion-qys" id="descripcionInpt" placeholder="Descripcion" required><?php echo $tituloDescripcion ?></textarea>
              </div>
            </div>
          </div>
        </div>              
      </div>
  </div>
  <div class="row">
      <div class="col-xs-12 col-lg-6">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Subir Foto</label>
              <div class="col-md-8 col-xs-9">
                <input class="form-control" name="archivo" type="file" id="archivo" />
              </div>
            </div>
          </div>
        </div>              
      </div>
  </div>
  <br>
  <div id="div_info"></div>
   <div class="row">
    <div class="col-xs-12 col-lg-6">
      <div class="text-right">
        <?php if($operacion == "Editar") echo "<a href='_oper_aviso.php?oper=del&i=$id_noti' class='btn btn-danger'>Eliminar</a>"; ?>
        <input type="button" value="Guardar" onclick="verify_ext(this.form, this.form.archivo.value)" name="subirBtn" class="btn btn-success" />
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
