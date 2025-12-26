<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');
  $current_page_admin = "mantto"
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?php echo $nombre_fraccionamiento; ?> :: Panel Admin</title>
    <?php include("inc/head-common.php"); ?>
    <script type="text/javascript">
      function pagaAdeudo(usuario){
        alert(usuario);
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
<br>
<?php
  //Conocer Mes Actual
  $mes=date("F");
  if ($mes=="January") $mes="Enero";
  if ($mes=="February") $mes="Febrero";
  if ($mes=="March") $mes="Marzo";
  if ($mes=="April") $mes="Abril";
  if ($mes=="May") $mes="Mayo";
  if ($mes=="June") $mes="Junio";
  if ($mes=="July") $mes="Julio";
  if ($mes=="August") $mes="Agosto";
  if ($mes=="September") $mes="Setiembre";
  if ($mes=="October") $mes="Octubre";
  if ($mes=="November") $mes="Noviembre";
  if ($mes=="December") $mes="Diciembre";
  $ano=date("Y");
?>

</div>
</div>
<div class="row">
  <div class="col-xs-10">
    
  </div>
  <div class="col-xs-2 text-right">
    <!--<a href="reporte-pago-mantenimiento.php" class="btn btn-default" role="button">Generar Reporte Mensual</a>-->
    <div class="btn-toolbar" role="toolbar">
      <div class="btn-group">
        <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reportes <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="reporte-pago-mantenimiento.php">Mensual</a></li>
          <li><a href="#">Deudores Historicos</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /btn-toolbar -->
  </div>
</div>

<div class="row">
<div class="col-xs-12">
<table class="table">
<thead>
<tr><th>Nombre</th><th>No. Casa</th><th class="text-center">Estado Mes Actual (<?php echo $mes."-".$ano; ?>)</th><th>Adeudo Previo</th><th>Ver Otros Meses</th></tr>
</thead>
<?php
            $ano = date("Y"); 
             $mes = date("m");
             $fechaActual = $ano."-".$mes."-01";
            $consulta_usuarios = mysqli_query($mysqliConn,"select id_user,nombre,no_casa,adeudo from user where level=0 order by no_casa;") or die(mysqli_error($mysqliConn));

            while($arr_usuarios = mysqli_fetch_array($consulta_usuarios)){ 
              
              $conocer_estado_mantto = mysqli_query($mysqliConn,"select * from mensualidades where id_user=$arr_usuarios[0] order by fecha desc;") or die(mysqli_error($mysqliConn));
              if(mysqli_num_rows($conocer_estado_mantto)>0){
                $row_mantto=mysqli_fetch_array($conocer_estado_mantto);
                if($row_mantto[2] >= $fechaActual){
                  echo "<tr class='success'><td>$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td class='text-center'><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='oper' value='upd'><input type='hidden' name='user' value='$arr_usuarios[0]'>Pagado</form></td><td><input type='checkbox' name='stat' aria-label='...' onchange='pagaAdeudo($arr_usuarios[0])'>".$arr_usuarios[3]."</td><td><a href='ver-meses-pagados.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Pagar Otros Meses</a></td></tr>";
                    //echo "<tr class='danger'><td>$arr_usuarios[2]</td><td>$arr_usuarios[4]</td><td class='text-center'><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='hidden' name='oper' value='upd'><input type='checkbox' name='stat' aria-label='...' onchange='this.form.submit()'> No Pagado</form></td><td><a href='ver-meses-pagados.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Ver y Pagar</a></td></tr>";
                  }else{
                    echo "<tr class='danger'><td>$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td class='text-center'><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='oper' value='ins'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='checkbox' name='stat' aria-label='...' onchange='this.form.submit()'> Presenta Retraso</td></form><td>Adeudo</td><td><a href='ver-meses-pagados.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Pagar Otros Meses</a></td></tr>";
                  }
                }else{
                  echo "<tr class='danger'><td>$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td class='text-center'><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='oper' value='ins'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='checkbox' name='stat' aria-label='...' onchange='this.form.submit()'> Ningun Pago Registrado</td></form><td>Adeudo</td><td><a href='ver-meses-pagados.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Pagar Otros Meses</a></td></tr>";
                }
            } 

          ?>
</table>
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
