<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?php echo $nombre_fraccionamiento; ?> :: Avisos</title>
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
  <li role="presentation" class="active"><a href="panel-avisos.php">Avisos</a></li>
  <li role="presentation"><a href="panel-estatus-mantenimiento.php">Estatus Mantenimiento</a></li>
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
<a href="oper_aviso.php?oper=add" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Aviso</a>
<br><br>
<table class="table table-condensed table-bordered">
<thead>
<tr><th>Titulo</th><th>Descripcion</th><th>Fecha</th><th>Fecha</th><th>Hora</th><th>Autor</th><th>Accion</th></tr>
</thead>
<?php
  $consulta_noti = mysqli_query($mysqliConn,"SELECT id_noti,titulo,texto,fecha,noti.id_user,hora,user.nombre FROM noti inner join user on user.id_user=noti.id_user;") or die(mysqli_error($mysqliConn));
    while($arr_usuarios = mysqli_fetch_array($consulta_noti)){ 
              echo "<tr><td>$arr_usuarios[0]</td><td>$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td>$arr_usuarios[3]</td><td>$arr_usuarios[5]</td><td>$arr_usuarios[6]</td><td class='text-center'><div class='btn-group' role='group' aria-label='...'>
  <a href='oper_aviso.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Editar</a></div></td></tr>";
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
