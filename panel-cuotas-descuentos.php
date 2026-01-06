<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  date_default_timezone_set('America/Mexico_City');

   $current_page_admin = "config-site";

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
    <title><?php echo $_SESSION['nombre-sitio']; ?> :: Cuotas y Descuentos</title>
    <?php include("inc/head-common.php"); ?>
    <script type="text/javascript">
      function habilitarDscto(){
        if(document.getElementById("habilitardescuento").checked != true){
          document.getElementById("mesescobra").disabled=true;
          document.getElementById("mesesgratis").disabled=true;
        }else{
          document.getElementById("mesescobra").disabled=false;
          document.getElementById("mesesgratis").disabled=false;
        }
      }
    </script>
  </head>

  <body onLoad="habilitarDscto();">
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
            Cuotas y Descuentos
          </div>
          <?php
            //conocer nombre
            $knowDescuentos = mysqli_query($mysqli,"select * from descuentos order by datetime desc limit 1;") or die(mysqli_error($mysqli));
            $f_Descuentos = mysqli_fetch_row($knowDescuentos);

            $knowCuotas = mysqli_query($mysqli,"SELECT * FROM cuotas order by fechahora desc limit 1;;") or die(mysqli_error($mysqli));
            $f_Cuotas = mysqli_fetch_row($knowCuotas);

            if($f_Descuentos[4] ==0){
              $input_meses_paga = "";
              $input_meses_gratis = "";
              $activo = 0;
            }else{
              $input_meses_paga = $f_Descuentos[2];
              $input_meses_gratis = $f_Descuentos[3];
              $activo=1;
            }

          ?>
          <div class="panel-body">
          <form class="form-horizontal" action="_oper-cuotas-descuentos.php" method="POST">
            <div class="row">
      <div class="col-xs-12 col-lg-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Cuota Mensual</label>
              <div class="col-md-8 col-xs-9">
                <input type="number" class="form-control" name="cuota" min="0" step="1" required placeholder="Nombre" value="<?php echo $f_Cuotas[2]; ?>" required>
              </div>
            </div>
          </div>
        </div>              
      </div>

      <div class="col-xs-12 col-lg-12">
        <div class="row">
          <div class="col-xs-12">
          <hr>
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">
                <input type="checkbox" name="habilitardescuento" id="habilitardescuento" <?php if($activo==1){echo "checked"; } ?> value="1" onclick="habilitarDscto();"> 
              </label>
              <div class="col-md-8 col-xs-9">
                Descuento por pago Anticipado de Mensualidades
              </div>
            </div>
          </div>
        </div>              
      </div>
      <div class="col-xs-12 col-lg-12">
        <div class="row">
          <div class="col-xs-6">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Al pagar</label>
              <div class="col-md-8 col-xs-9">
                <div class="input-group">
                  <input type="number" min="0" step="1" class="form-control" id="mesescobra" value="<?php echo $input_meses_paga; ?>" name="mesescobra" placeholder="Numero de Meses" aria-describedby="basic-addon2">
                  <span class="input-group-addon" id="basic-addon2">mes(es)</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">se descuentan</label>
              <div class="col-md-8 col-xs-9">
                <div class="input-group">
                  <input type="number" min="0" step="1" class="form-control" value="<?php echo $input_meses_gratis; ?>" id="mesesgratis" name="mesesgratis" placeholder="Numero de Meses" aria-describedby="basic-addon2">
                  <span class="input-group-addon" id="basic-addon2">mes(es)</span>
                </div>
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
        <button type="submit" class="btn btn-success">Guardar</button>
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

    </body>
</html>
