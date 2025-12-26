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
  <li role="presentation" class="active"><a href="panel-estatus-mantenimiento.php">Estatus Mantenimiento</a></li>
  <li role="presentation"><a href="panel-comprobantes-gastos.php">Comprobantes de Gastos </a></li>
  <li role="presentation"><a href="panel-quejas-sugerencias.php">Quejas y Sugerencias </a></li>
  <li role="presentation"><a href="panel-presupuestos.php">Presupuestos </a></li>
  <li role="presentation"><a href="panel-usuarios.php">Usuarios </a></li>
</ul>
  </div>
</div>
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
<table class="table">
<thead>
<tr><th>Nombre</th><th>No. Casa</th><th class="text-center">Estado Mes Actual (<?php echo $mes."-".$ano; ?>)</th><th>Ver Otros Meses</th></tr>
</thead>
<?php
            $consulta_usuarios = mysqli_query($mysqliConn,"select * from user where level=0 order by no_casa;") or die(mysqli_error($mysqliConn));

            while($arr_usuarios = mysqli_fetch_array($consulta_usuarios)){ 
              
              $conocer_estado_mantto = mysqli_query($mysqliConn,"select * from mantto where id_user=$arr_usuarios[0];") or die(mysqli_error($mysqliConn));
              if(mysqli_num_rows($conocer_estado_mantto)>0){
                $row_mantto=mysqli_fetch_array($conocer_estado_mantto);
                if($row_mantto[2] == 0){
            echo "<tr class='danger'><td>$arr_usuarios[2]</td><td>$arr_usuarios[4]</td><td class='text-center'><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='hidden' name='oper' value='upd'><input type='checkbox' name='stat' aria-label='...' onchange='this.form.submit()'> No Pagado</form></td><td><a href='ver-meses-pagados.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Ver y Pagar</a></td></tr>";
                  }else{
                    echo "<tr class='success'><td>$arr_usuarios[2]</td><td>$arr_usuarios[4]</td><td class='text-center'><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='oper' value='upd'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='checkbox' name='stat' aria-label='...' checked onchange='this.form.submit()'> Pagado</form></td><td><a href='ver-meses-pagados.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Ver y Pagar</a></td></tr>";
                  }
                }else{
                  echo "<tr class='danger'><td>$arr_usuarios[2]</td><td>$arr_usuarios[4]</td><td class='text-center'><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='oper' value='ins'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='checkbox' name='stat' aria-label='...' onchange='this.form.submit()'> No Registrado</td></form><td><a href='ver-meses-pagados.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Ver y Pagar</a></td></tr>";
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
