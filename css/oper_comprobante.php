<?php
  session_start();
  
  include('configPHP/config.inc.php');
  
  
  if($_GET['agre'] == "add"){
    $operacion = "Agregar";
  }elseif ($_GET['oper'] == "edit") {
    $operacion = "Editar";
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?php echo $nombre_fraccionamiento; ?> :: <?php echo $operacion; ?> Aviso</title>
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
          <li><a href="index.php"><?php echo $nombre_fraccionamiento; ?></a></li>
          <li><a href="panel-avisos.php">Panel de Administracion</a></li>
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
      $conocerDatosNoti = mysqli_query($mysqliConn,"select * from noti where id_noti=$id_noti;") or die(mysqli_error($mysqliConn));
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
              <label for="inputName" class="control-label col-md-4 col-xs-3">Titulo comprobante</label>
              <div class="col-md-8 col-xs-9">
                <input name="titulo" type="text" />
                </div>
                <br><br>
            <label class="control-label col-md-4 col-xs-3">Descripcion</label>
              <div class="col-md-8 col-xs-9">
                <textarea name="descripcion" cols="100"></textarea>
                </div>
                <br><br>
                
                <input name="archivo" type="file" id="archivo" />
                <br>
                <input type="submit" value="Guardar" name="subirBtn" class="btn btn-success" />
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
