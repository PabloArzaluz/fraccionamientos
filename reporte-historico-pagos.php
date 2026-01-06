<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  date_default_timezone_set('America/Mexico_City');

   $current_page_admin = "reporte-historico-pagos";

  function acortar($texto,$largo) {
        if(strlen($texto) >= 20){
            return substr($texto,0,$largo).'...';
        }else{
            return $texto;
        }
    }
  
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?php echo $_SESSION['nombre-sitio']; ?> :: Reporte Historico Pagos</title>
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
          <li class="active">Panel de Administracion</li>
        </ol>
      </div>
    </div>
  </div>
<div class="container">
<?php include("inc/nav-panel-admin.php"); ?>
<br>
  <div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Reporte Historico de Pagos
          </div>
          <?php
            //conocer nombre
            //$knowNameSite = mysqli_query($mysqli,"select * from config_site;") or die(mysqli_error($mysqli));
            //$f_ConfigSite = mysqli_fetch_row($knowNameSite);

          ?>
          <div class="panel-body">
          <form class="form-horizontal" action="_reporte-historico-pagos.php" method="POST">
            <div class="row">
      <div class="col-xs-12 col-lg-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Seleccionar Casas</label>
              <div class="col-md-4 col-xs-9">
                <input type="text" class="form-control" value="Todos" name="casa" >
              </div>
            </div>
          </div>
        </div>              
      </div>
      <div class="col-xs-12 col-lg-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Fecha de Inicio</label>
              <div class="col-md-4 col-xs-9">
                <input  type="text" class="form-control" value="" placeholder="Selecciona Fecha"  name="fechainicio" id="selector-fecha1" required>
              </div>
            </div>
          </div>
        </div>              
      </div>
      <div class="col-xs-12 col-lg-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Fecha de Termino</label>
              <div class="col-md-4 col-xs-9">
                <input  type="text" class="form-control" value="" placeholder="Selecciona Fecha"  name="fechafinal" id="selector-fecha2" required>
              </div>
            </div>
          </div>
        </div>              
      </div>
      <div class="col-xs-12 col-lg-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              
              <div class="col-xs-12">
                <div class="text-right">
        <button type="submit" class="btn btn-success">Generar Reporte</button>
      </div>
              </div>
            </div>
          </div>
        </div>              
      </div>
  </div>
  </form>
        </div>

    </div>
  </div>

</div>

  <?php 
		include("inc/footer-common.php");
	?>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
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
                    format: "yyyy-mm-dd",
                    
                    language: "es",
                    autoclose: true,
                    todayHighlight: true,
                    toolbarPlacement:"top",
                    orientation: "bottom auto"
                });  
                $('#selector-fecha2').datepicker({
                    format: "yyyy-mm-dd",
                    
                    language: "es",
                    autoclose: true,
                    todayHighlight: true,
                    toolbarPlacement:"bottom"
                }); 
               
                           
            });
        </script>
    </body>
</html>
