<?php
  session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  include("inc/config-site.php");
  if($_GET['agre'] == "add"){
    $operacion = "Agregar";
  }elseif ($_GET['agre'] == "edit") {
    $operacion = "Editar";
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?php echo $_SESSION['nombre-sitio']; ?> :: <?php echo $operacion; ?> Gasto Fijo</title>
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
          <li><a href="panel-gastos-fijos.php">Panel de Administracion</a></li>
          <li class="active"><?php echo $operacion; ?> Gasto Fijo</li>
        </ol>
      </div>
    </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h4><?php echo $operacion; ?> Gasto Fijo</h4><br>
    </div>
  </div>
  <?php 
    if($operacion == "Agregar"){
      $descripcion = "";
      $monto = "";
      $fecha = "";
      $typeOper = "add";
    }elseif($operacion == "Editar"){
      $id_gastof = $_GET['id'];
      $typeOper = "edit&i=".$id_gastof;
      $conocerDatosNoti = mysqli_query($mysqli,"select gastos_fijos.id_gastos_fijos,descripcion,monto from gastos_fijos inner join historico_gastos_fijos on gastos_fijos.id_gastos_fijos = historico_gastos_fijos.id_gastos_fijos where gastos_fijos.id_gastos_fijos = $id_gastof and activo=1 order by fecha_captura desc Limit 1") or die(mysqli_error($mysqli));
      $filaGastosf = mysqli_fetch_row($conocerDatosNoti);

      $descripcion = $filaGastosf[1];
      $monto = $filaGastosf[2];
      

      
    }
  ?>
  <form action="_oper_gasto_fijo.php?oper=<?php echo $typeOper;?> " method="POST" name="frm_User" class="form-horizontal" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Descripcion de Gasto</label>
              <div class="col-md-8 col-xs-9">
                <input name="descripcion" id="tituloInpt" class="form-control" autocomplete="off" value= "<?php echo $descripcion; ?>" type="text" required placeholder="Descripcion de Gasto" />
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
              <label for="inputName" class="control-label col-md-4 col-xs-3">Monto</label>
              <div class="col-md-8 col-xs-9">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                    <input type="number" step="0.01" data-number-to-fixed="2" autocomplete="off" value="<?php echo $monto; ?>" name="monto" required placeholder="Monto" class="form-control" aria-label="Monto">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-6 col-xs-12 text-right">
      <div id="div_info"></div>
      <input type="submit" value="Guardar" name="subirBtn" class="btn btn-success" />
      <a href="panel-gastos-fijos.php" class='btn btn-danger'>Cancelar</a>
      </div>
    </div>
  </div>
              
      
   <div class="row">
    <div class="col-xs-12 col-lg-6">
      <div class="text-right">
        
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
                $('#selector-fecha2').datepicker({
                    format: "yyyy/mm/dd",
                    
                    language: "es",
                    autoclose: true,
                    todayHighlight: true,
                    toolbarPlacement:"bottom"
                }); 
                $('#selector-fecha3').datepicker({
                     format: "yyyy/mm/dd",
                    
                    language: "es",
                    autoclose: true,
                    todayHighlight: true,
                    toolbarPlacement:"bottom"
                    });

                
                $('#selector-fecha4').datepicker({
                    format: "yyyy/mm/dd",
                    
                    language: "es",
                    autoclose: true,
                    todayHighlight: true,
                    toolbarPlacement:"bottom"
                });
                           
            });
        </script>
    </body>
</html>
