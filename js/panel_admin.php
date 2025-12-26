<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Country del Lago :: Panel Admin</title>
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
          <li class="active">Panel de Administracion</li>
        </ol>
      </div>
    </div>
  </div>

<br>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <ul class="nav nav-pills" role="tablist">
  <li role="presentation" class="active"><a href="avisos.php">Avisos <span class="badge">42</span></a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages <span class="badge">3</span></a></li>
</ul>
  </div>
</div>
  <div class="row">
    <div class="col-xs-12">
      <div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?php if($_SESSION['redirect'] == "avisos") echo "class='active'"; ?>><a href="#avisos" aria-controls="messages" role="tab" data-toggle="tab">Avisos</a></li>
    <li role="presentation" <?php if($_SESSION['redirect'] == "users") echo "class='active'"; ?>><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Usuarios</a></li>
    <li role="presentation" <?php if($_SESSION['redirect'] == "archivos") echo "class='active'"; ?>><a href="#archivos" aria-controls="archivos" role="tab" data-toggle="tab">Carga de Archivos</a></li>
    <li role="presentation" <?php if($_SESSION['redirect'] == "mantto") echo "class='active'"; ?>><a href="#mantto" aria-controls="mantto" role="tab" data-toggle="tab">Pago Mantenimiento</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  <div role="tabpanel" class="tab-pane<?php if($_SESSION['redirect'] == "avisos") echo " active"; ?>" id="avisos">
      <?php include("inc/notificaciones-admin.php"); ?>
    </div>
    <div role="tabpanel" class="tab-pane<?php if($_SESSION['redirect'] == "users") echo " active"; ?>" id="users">
      <?php include("inc/users-admin.php"); ?>
    </div>
    <div role="tabpanel" class="tab-pane<?php if($_SESSION['redirect'] == "archivos") echo " active"; ?>" id="archivos"></div>
    
    <div role="tabpanel" class="tab-pane<?php if($_SESSION['redirect'] == "mantto") echo " active"; ?>" id="mantto">
      <?php include("inc/mantto-admin.php"); ?>
    </div>
  </div>

</div>
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
