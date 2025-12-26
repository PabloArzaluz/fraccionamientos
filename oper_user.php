<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  if($_GET['oper'] == "add"){
    $operacion = "Agregar";
  }elseif ($_GET['oper'] == "edit") {
    $operacion = "Editar";
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Country del Lago :: <?php echo $operacion; ?> Usuario</title>
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
          <li><a href="index.php">Country del Lago</a></li>
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
    }elseif($operacion == "Editar"){
      
      $id_user = $_GET['i'];
      $typeOper = "edit&i=".$id_user;
      $conocerDatosUser = mysqli_query($mysqliConn,"select * from user where id_user=$id_user;") or die(mysqli_error($mysqliConn));
      $filaDatosUser = mysqli_fetch_row($conocerDatosUser);
      $loginUser  = $filaDatosUser[1];
      $password   = $filaDatosUser[3];
      $noCasa = $filaDatosUser[4];
      $nameUser = $filaDatosUser[2];
      $userLevel = $filaDatosUser[5];
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
      <div class="text-right">
        <?php if($operacion == "Editar") echo "<a href='_oper_user.php?oper=del&i=$id_user' class='btn btn-danger'>Eliminar</a>"; ?> <button type="submit" class="btn btn-success">Guardar</button>
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
    </body>
</html>
