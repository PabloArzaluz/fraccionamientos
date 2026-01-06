<?php

  session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  if(!isset($_SESSION['id_user'])){
		header('Location:index.php');
		die();
	}

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

    <title><?php echo $_SESSION['nombre-sitio']; ?> :: <?php echo $operacion; ?> Pago Diverso</title>

    <?php include("inc/head-common.php"); ?>



    <script type="text/javascript">

    function verify_ext(form, file) { 

        extensiones_permitidas = new Array(".jpg", ".pdf"); 

         aviso = ""; 

         if (!file || document.getElementById("descripcionInpt").value == "" || document.getElementById("tituloInpt").value == "") { 

            aviso = "<div class='alert alert-danger' role='danger'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Ningun Archivo Seleccionado, o algunos campos estan vacios </div>"; 

         }else{ 

            extension = (file.substring(file.lastIndexOf("."))).toLowerCase(); 

            permitida = false; 

            for (var i = 0; i < extensiones_permitidas.length; i++) { 

               if (extensiones_permitidas[i] == extension) { 

               permitida = true; 

               break; 

               } 

            } 

            if (!permitida) { 

               aviso = "<div class='alert alert-danger' role='danger'><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> Archivo Invalido. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join()+"</div>"; 

              }else{ 

              document.getElementById('extensionInput').value=extension ; 

              form.submit(); 

               return 1; 

              } 

         } 

         document.getElementById("div_info").innerHTML = aviso;

         return 0; 

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

          <li><a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a></li>

          <li><a href="panel-pagos-diversos.php">Panel de Administracion</a></li>

          <li class="active"><?php echo $operacion; ?> Pago Diverso</li>

        </ol>

      </div>

    </div>

  </div>

<div class="container">

  <div class="row">

    <div class="col-xs-12">

      <h4><?php echo $operacion; ?> Pago Diverso</h4><br>

    </div>

  </div>

  <?php 

    if($operacion == "Agregar"){

      $descripcion = "";

      $monto = "";

      $fecha = "";

      $typeOper = "add";

    }elseif($operacion == "Editar"){

      $id_gastov = $_GET['id'];

      $typeOper = "edit&i=".$id_gastov;

      $conocerDatosNoti = mysqli_query($mysqli,"select * from gastos_variables where id_gastos_variables=$id_gastov;") or die(mysqli_error($mysqli));

      $filaGastosv = mysqli_fetch_row($conocerDatosNoti);



      $descripcion = $filaGastosv[1];

      $monto = $filaGastosv[2];

      $fecha = $filaGastosv[4];



      

    }



    $conocerUsuariosNormales = "select id_user,nombre,no_casa from user where level=0 order by no_casa asc;";

    $INY_CONOCER_USUARIOS_NORMALES = mysqli_query($mysqli,$conocerUsuariosNormales,$link)or die(mysqli_error($mysqli));



  ?>

  <form action="_oper_pagos_diversos.php?oper=<?php echo $typeOper;?> " method="POST" name="frm_User" class="form-horizontal" enctype="multipart/form-data">

    <div class="row">

      <div class="col-lg-6 col-xs-12">

        <div class="row">

          <div class="col-xs-12">

            <div class="form-group">

              <label for="inputName" class="control-label col-md-4 col-xs-3">Casa / Habitante</label>

              <div class="col-md-8 col-xs-9">

                  <select class="form-control" id="sel1" required name="usuario" required>

                  <option value="">Seleccionar un Usuario</option>

                  <?php

                    while($fUsuarios = mysqli_fetch_array($INY_CONOCER_USUARIOS_NORMALES)){

                      echo "<option ";

                      if(isset($_GET['user'])){

                        if($_GET['user'] == $fUsuarios[0]){

                          echo "selected ";

                        }

                      }

                      echo "value='".$fUsuarios[0]."'>".$fUsuarios[2]." [".$fUsuarios[1]."]</option>";

                    }

                  ?>

                </select>

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

              <label for="inputName" class="control-label col-md-4 col-xs-3">Tipo de Pago</label>

              <div class="col-md-8 col-xs-9">

                  <select class="form-control" id="sel1" required name="tipoPago" required>

                  <option value="">Selecciona un Tipo de Pago</option>

                  <option value="1">Pago de Saldo Inicial</option>

                  

                </select>

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

              <label for="inputName" class="control-label col-md-4 col-xs-3">Descripcion</label>

              <div class="col-md-8 col-xs-9">

                <input name="descripcion" id="tituloInpt" class="form-control" type="text" required placeholder="Descripcion de Pago" />

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

                    <input type="number" step="0.01" data-number-to-fixed="2" value="<?php echo $monto; ?>" name="monto" required placeholder="Monto" class="form-control" aria-label="Monto">

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <!--<div class="row">

      <div class="col-lg-6 col-xs-12">

        <div class="row">

          <div class="col-xs-12">

            <div class="form-group">

              <label for="inputName" class="control-label col-md-4 col-xs-3">Fecha</label>

              <div class="col-md-8 col-xs-9">

                                 

                    <input  type="text" class="form-control" value="<?php echo $fecha; ?>" placeholder="Selecciona Fecha"  name="fecha" id="selector-fecha1" required>

                

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    -->

    <div class="col-lg-6 col-xs-12 text-right">

      <div id="div_info"></div>

      <input type="submit" value="Guardar" name="subirBtn" class="btn btn-success" />

      <a href="panel-saldos-iniciales.php" class='btn btn-danger'>Cancelar</a>

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

