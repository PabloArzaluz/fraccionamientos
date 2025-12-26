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
  <li role="presentation"><a href="panel-presupuestos.php">Presupuestos </a></li>
  <li role="presentation" class="active"><a href="panel-usuarios.php">Usuarios </a></li>
</ul>
  </div>
</div>
  <div class="row">
    <div class="col-xs-12">
<br><a href="oper_user.php?oper=add"><button class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Usuario</button></a><br><br>
      <div class="table-responsive">
      <table class="table table-bordered table-condensed table-responsive">
        <thead>
          <tr><th>Usuario</th><th>Nombre Completo</th><th>Contraseña</th><th>No. Casa</th><th>Nivel</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
            $consulta_usuarios = mysqli_query($mysqliConn,"select id_user,user_login,nombre,password,no_casa,level from user order by user_login;") or die(mysqli_error($mysqliConn));
            while($arr_usuarios = mysqli_fetch_array($consulta_usuarios)){ 
              echo "<tr><td>$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td>$arr_usuarios[3]</td><td>$arr_usuarios[4]</td><td>$arr_usuarios[5]</td><td class='text-center'><div class='btn-group' role='group' aria-label='...'>
  <a href='oper_user.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Editar</a></div></td></tr>";
            } 
          ?>
        </tbody>
      </table>
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
