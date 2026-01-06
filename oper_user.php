<?php

	session_start();

  include('configPHP/conecta.inc.php');

  include('configPHP/config.inc.php');

  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  

  include("inc/config-site.php");

  if($_GET['oper'] == "add"){

    $operacion = "Agregar";

  }elseif ($_GET['oper'] == "edit") {

    $operacion = "Editar";

  }

?>

<!DOCTYPE html>

<html lang="es">

  <head>

    <title><?php echo $_SESSION['nombre-sitio']; ?> :: <?php echo $operacion; ?> Usuario</title>

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

          <li><a href="panel-usuarios.php">Panel de Administracion</a></li>

          <li class="active"><?php echo $operacion; ?> Usuario</li>

        </ol>

      </div>

    </div>

  </div>

<div class="container">

  <div class="row">

    <div class="col-xs-12">

      <h4><?php echo $operacion; ?> Usuario</h4><br>

    </div>

  </div>

  <?php 

    if($operacion == "Agregar"){

      $loginUser = "";

      $password = "";

      $noCasa = "";

      $nameUser = "";

      $userLevel = "0";

      $typeOper = "add";

      $direccion = "";

      $NOMBRE_DUENO = "";

      $NO_COCHES = "";

      $TELEFONO = "";

      $EMAIL = "";

    }elseif($operacion == "Editar"){

      

      $id_user = $_GET['i'];

      $typeOper = "edit&i=".$id_user;

      $conocerDatosUser = mysqli_query($mysqli,"select * from user where id_user=$id_user;") or die(mysqli_error($mysqli));

      $filaDatosUser = mysqli_fetch_row($conocerDatosUser);

      $loginUser  = $filaDatosUser[1];

      $password   = $filaDatosUser[3];

      $noCasa = $filaDatosUser[4];

      $nameUser = $filaDatosUser[2];

      $userLevel = $filaDatosUser[5];

      $direccion = $filaDatosUser[7];

      $NOMBRE_DUENO = $filaDatosUser[8];

      $NO_COCHES = $filaDatosUser[9];

      $TELEFONO = $filaDatosUser[10];

      $EMAIL = $filaDatosUser[11];

    }

  ?>

  <form action="_oper_user.php?oper=<?php echo $typeOper; ?>" method="POST" name="frm_User" class="form-horizontal">

  <div class="row">

      <div class="col-lg-6 col-xs-12">

        <div class="row">

          <div class="col-xs-12">

            <div class="form-group">

              <label for="inputName" class="control-label col-md-4 col-xs-3">Usuario</label>

              <div class="col-md-8 col-xs-9">

                <input type="name" class="form-control" name="login-user" placeholder="Usuario" value="<?php  echo $loginUser?>" required>

              </div>

            </div>

          </div>

        </div>              

      </div>

  </div>

  <div class="row">

      <div class="col-xs-12 col-lg-6">

        <div class="row">

          <div class="col-xs-12">

            <div class="form-group">

              <label for="inputName" class="control-label col-md-4 col-xs-3">Contraseña</label>

              <div class="col-md-8 col-xs-9">

                <input type="name" class="form-control" name="password-user" placeholder="Contraseña" value="<?php echo $password ?>" required>

              </div>

            </div>

          </div>

        </div>              

      </div>

  </div>

  <div class="row">

      <div class="col-xs-12 col-lg-6">

        <div class="row">

          <div class="col-xs-12">

            <div class="form-group">

              <label for="inputName" class="control-label col-md-4 col-xs-3">Numero de Casa</label>

              <div class="col-md-8 col-xs-9">

                <input type="name" class="form-control" name="nocasa-user" placeholder="Numero de Casa" value="<?php echo $noCasa ?>" required>

              </div>

            </div>

          </div>

        </div>              

      </div>

  </div>

  <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Nombre Completo</label>

            <div class="col-md-8 col-xs-9">

              <input type="name" class="form-control" name="name-user" placeholder="Nombre Completo" value="<?php echo $nameUser; ?>" required>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

   <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Nivel de Usuario</label>

            <div class="col-md-8 col-xs-9">

              <select class="form-control" id="sel1" required name="nivel-user">

                <option value="0" <?php if($userLevel == 0) echo "selected"; ?>>Usuario Normal</option>

                <option value="2" <?php if($userLevel == 2) echo "selected"; ?>>Supervisor</option>

                <option value="1" <?php if($userLevel == 1) echo "selected"; ?>>Administrador</option>

              </select>

            </div>

          </div>

        </div>

      </div>

   </div>

  </div>

  <hr>

  <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Direccion</label>

            <div class="col-md-8 col-xs-9">

              

              <textarea class="form-control"  name="direccion"><?php echo $direccion; ?></textarea>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Nombre Dueño</label>

            <div class="col-md-8 col-xs-9">

              <input type="name" class="form-control" name="name-dueno" placeholder="Nombre Dueño" value="<?php echo $NOMBRE_DUENO; ?>" >

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Numero de Coches</label>

            <div class="col-md-8 col-xs-9">

              <input type="number" class="form-control" name="no-coches" placeholder="Numero de Coches" value="<?php echo $NO_COCHES; ?>"  >

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Numeros de Telefono</label>

            <div class="col-md-8 col-xs-9">

              <input type="name" class="form-control" name="telefono" placeholder="Numeros de Telefono" value="<?php echo $TELEFONO; ?>"  >

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 col-lg-6">

      <div class="row">

        <div class="col-xs-12">

          <div class="form-group">

            <label for="inputName" class="control-label col-md-4 col-xs-3">Email</label>

            <div class="col-md-8 col-xs-9">

              <input type="name" class="form-control" name="email" placeholder="Correo Electronico" value="<?php echo $EMAIL; ?>"  >

            </div>

          </div>

        </div>

      </div>

      <div class="text-right">

        <?php if($operacion == "Editar") echo "<a href='_oper_user.php?oper=del&i=$id_user' class='btn btn-danger'>Eliminar</a>"; ?> <button type="submit" class="btn btn-success">Guardar</button>

      </div>

    </div>

  </div>

<br>

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

    </body>

</html>

