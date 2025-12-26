<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();
  if($_GET['oper'] == "add"){
    $operacion = "Agregar";
  }elseif ($_GET['oper'] == "edit") {
    $operacion = "Editar";
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Country del Lago :: <?php echo $operacion; ?> Aviso</title>
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
          <li><a href="index.php">Country del Lago</a></li>
          <li><a href="panel-avisos.php">Panel de Administracion</a></li>
          <li class="active"><?php echo $operacion; ?> Aviso</li>
        </ol>
      </div>
    </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h4><?php echo $operacion; ?> Aviso</h4><br>
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
      $conocerDatosNoti = mysql_query("select * from noti where id_noti=$id_noti;",$link) or die(mysql_error());
      $filaDatosNoti = mysql_fetch_row($conocerDatosNoti);
      $tituloAviso = $filaDatosNoti[1]	;
      $tituloDescripcion = $filaDatosNoti[2];
    }
  ?>
  <form action="_oper_aviso.php?oper=<?php echo $typeOper; ?>" method="POST" name="frm_User" class="form-horizontal">
  <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Titulo Aviso</label>
              <div class="col-md-8 col-xs-9">
                <input type="name" class="form-control" name="titulo-aviso" placeholder="Titulo Aviso" value="<?php  echo $tituloAviso?>" required>
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
                <textarea rows="10" cols="50" class="form-control" name="descripcion-aviso" placeholder="Descripcion" required><?php echo $tituloDescripcion ?></textarea>
              </div>
            </div>
          </div>
        </div>              
      </div>
  </div>
   <div class="row">
    <div class="col-xs-12 col-lg-6">
      <div class="text-right">
        <?php if($operacion == "Editar") echo "<a href='_oper_aviso.php?oper=del&i=$id_noti' class='btn btn-danger'>Eliminar</a>"; ?> <button type="submit" class="btn btn-success">Guardar</button>
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
