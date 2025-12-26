<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?php echo $nombre_fraccionamiento; ?> :: Panel Admin</title>
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
          <li class="active">Panel de Administracion</li>
        </ol>
      </div>
    </div>
  </div>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <ul class="nav nav-pills" role="tablist">
  <li role="presentation"><a href="panel-avisos.php">Avisos</a></li>
  <li role="presentation"><a href="panel-estatus-mantenimiento.php">Estatus Mantenimiento</a></li>
  <li role="presentation"><a href="panel-comprobantes-gastos.php">Comprobantes de Gastos </a></li>
  <li role="presentation"><a href="panel-quejas-sugerencias.php">Quejas y Sugerencias </a></li>
  <li role="presentation" class="active"><a href="panel-presupuestos.php">Presupuestos </a></li>
  <li role="presentation"><a href="panel-usuarios.php">Usuarios </a></li>
</ul>
  </div>
</div>
  <div class="row">
    <div class="col-xs-12">


    </div>
  </div>

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
