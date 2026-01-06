<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  date_default_timezone_set('America/Mexico_City');

   $current_page_admin = "gastos-fijos";

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
    <title><?php echo $_SESSION['nombre-sitio']; ?> :: Gastos Fijos</title>
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
                                Gastos Fijos
                            </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="oper_gasto_fijo.php?agre=add" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Gasto Fijo</a>
                                    <br>
                                    <br>
                                </div>
                            </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Descripcion</th>
                                                <th>Monto</th>
                                                <th>Fecha de Modificacion</th>
                                                <th>Fecha de Creacion</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            //Conocer Gastos Fijos
                                            $QRY_GASTOS_FIJOS = mysqli_query($mysqli,"select * from gastos_fijos where activo=1;") or die(mysqli_error($mysqli));
                                            
                                            if(mysqli_num_rows($QRY_GASTOS_FIJOS) > 0){
                                                while($f_gastosfijos = mysqli_fetch_array($QRY_GASTOS_FIJOS)){
                                                    $INY_CONOCER_PRIMER_VALOR = mysqli_query($mysqli,"select * from historico_gastos_fijos where id_gastos_fijos=$f_gastosfijos[0] order by fecha_captura desc Limit 1",$link)or die(mysqli_error($mysqli));
                                                    $fPrimerValor = mysqli_fetch_row($INY_CONOCER_PRIMER_VALOR);

                                                    $INY_CONOCER_ULTIMO_VALOR = mysqli_query($mysqli,"select * from historico_gastos_fijos where id_gastos_fijos=$f_gastosfijos[0] order by fecha_captura asc Limit 1",$link)or die(mysqli_error($mysqli));
                                                    $fUltimoValor = mysqli_fetch_row($INY_CONOCER_ULTIMO_VALOR);
                                                    
                                                    echo "  <tr>
                                                                <td>$f_gastosfijos[1]</td>
                                                                <td>$fPrimerValor[2]</td>";
                                                    $date_modificacion = new DateTime($fPrimerValor[3]); 
                                                    echo "<td>".date_format($date_modificacion, 'd/m/Y g:i a')."</td>";
                                                    $date_creacion = new DateTime($fUltimoValor[3]); 
                                                    echo "<td>".date_format($date_creacion, 'd/m/Y g:i a')."</td>";
                                                                
                                                                
                                                    echo "<td><a href='oper_gasto_fijo.php?id=$f_gastosfijos[0]&agre=edit' class='btn btn-primary btn-xs'>Editar</a>
                                                            <button type='button' data-href='_eliminar_gastos_fijos.php?id=$f_gastosfijos[0]' data-toggle='modal' data-target='#confirm-delete' class='btn btn-xs btn-danger'>Eliminar</button>
                                                            </td>   </tr>";
                                                }
                                                    echo "</tbody>
                                                            </table>";
                                            }else{
                                                
                                                echo "<tr><td colspan='5'><div class='alert alert-warning' role='alert'><span class='glyphicon glyphicon-info-sign' aria-hidden='strue'></span> No se encontraron resultados</div></td>";
                                                echo "</tbody></table>";
                                            }
                                        ?>
                                            
                                       
                                </div>
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
</script>
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar Gasto Fijo</h4>
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
