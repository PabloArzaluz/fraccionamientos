<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');
  $current_page_admin = "presupuestos";
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
<?php 
    include("inc/nav-panel-admin.php")
  ?>
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
