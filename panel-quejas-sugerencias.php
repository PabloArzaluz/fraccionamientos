<?php

	session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  date_default_timezone_set('America/Mexico_City');

  include("inc/config-site.php");

  $current_page_admin = "qys";

  if(!isset($_GET['status'])){

    $status = "1";

  }else{

    $status = $_GET['status'];

  }

?>

<!DOCTYPE html>

<html lang="es">

  <head>

    <title><?php echo $_SESSION['nombre-sitio']; ?> :: Panel Admin</title>

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

<?php 

    include("inc/nav-panel-admin.php")

  ?>

  <div class="row">

    <div class="col-xs-12">

  <br>

  <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Estado: </label>

            <div class="col-md-8 col-xs-9">

              <select class="form-control" id="sel1" required name="nivel-user" onchange="if (this.value) window.location.href= 'panel-quejas-sugerencias.php?status='+this.value">

                <option value="1" <?php if($status == '1') echo "selected"; ?>>Activos</option>

                <option value="2" <?php if($status == '2') echo "selected"; ?>>Cerrados</option>

              </select>

            </div>

          </div>

        </div>

      </div>

      

    </div>

  </div><br>

  <?php 

    $conocerTemas = "select qys.id_qys,titulo, qys.id_user,fecha,hora, nombre, no_casa from qys inner join user on qys.id_user = user.id_user where status=$status order by qys.fecha desc,qys.hora desc;";

    $iny_conocer_qys = mysqli_query($mysqli,$conocerTemas) or die(mysqli_error($mysqli));

  ?>

  <div class="row">

    <div class="col-xs-12">

      <div class="table-responsive">

        <table class="table">

          <thead>

            <tr><th>Titulo</th><th>Autor</th><th>Fecha de Apertura</th><?php if($status == 2) echo "<th>Razon de Cierre</th>";?><th></th><th></th></tr>

          </thead>

          <tbody>

            <?php

              if(mysqli_num_rows($iny_conocer_qys) > 0){

                while($arr_qys = mysqli_fetch_array($iny_conocer_qys)){ 

                  echo "

                  <tr>

                    <td>$arr_qys[1]</td>

                    <td>$arr_qys[5] [#$arr_qys[6]]</td><td>";

                    $date = date_create($arr_qys[3]);

                    echo date_format($date, 'd/m/Y');

                    echo " $arr_qys[4]";

                    echo "</td>";



                    if($status == 2){

                      echo "<td></td>";

                      echo "<td><a href='_change_status_qys.php?id=$arr_qys[0]&status=1' class='btn btn-default btn-xs'>Reabrir</a></td>";  

                    }else{

                      echo "<td><a href='_change_status_qys.php?id=$arr_qys[0]&status=2' class='btn btn-default btn-xs'>Cerrar</a></td>";  

                    }

                    

					echo "<td>";
					if($_SESSION['level_user'] == 1 )
						echo "<button type='button' data-href='_eliminar_qys.php?id=$arr_qys[0]' data-toggle='modal' data-target='#confirm-delete' class='btn btn-xs btn-danger'>Eliminar</button>";
					echo "</td>

                  </tr>

                  ";

                }

              }else{

                echo "<tr><td>No hay ningun resultado</td></tr>";



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

  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-sm">

            <div class="modal-content">

            

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title" id="myModalLabel">Eliminar Tema</h4>

                </div>

            

                <div class="modal-body">

                     <p> Este procedimiento es irreversible</p>

                    <p>¿Aun asi deseas proceder?</p>

                    </div>

                

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                    <a class="btn btn-danger btn-ok">Eliminar</a>

                </div>

            </div>

        </div>

    </div>



  <script type="text/javascript">

    

        $('#confirm-delete').on('show.bs.modal', function(e) {

            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

            

            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');

        });

    

</script>



    </body>

</html>

