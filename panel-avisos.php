<?php

	session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  date_default_timezone_set('America/Mexico_City');

  $current_page_admin = "avisos";

  include("inc/config-site.php");

  if(!isset($_SESSION['id_user'])){
		header('Location:index.php');
		die();
	}

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

    <title>Country del Lago :: <?php echo $_SESSION['nombre-sitio']; ?></title>

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

  $consulta_noti = mysqli_query($mysqli,"SELECT id_noti,titulo,texto,fecha,noti.id_user,hora,user.nombre FROM noti inner join user on user.id_user=noti.id_user;") or die(mysqli_error($mysqli));

    while($arr_usuarios = mysqli_fetch_array($consulta_noti)){ 

              echo "<tr><td>$arr_usuarios[0]</td><td>$arr_usuarios[1]</td><td><span data-toggle='tooltip' title='".$arr_usuarios[2]."!'>".acortar($arr_usuarios[2],20)."</span></td><td>$arr_usuarios[3]</td><td>$arr_usuarios[5]</td><td>$arr_usuarios[6]</td><td class='text-center'><div class='btn-group' role='group' aria-label='...'>

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

