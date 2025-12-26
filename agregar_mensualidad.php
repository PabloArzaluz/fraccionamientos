<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Country del Lago :: Agregar Mensualidad</title>
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
          <li><a href="panel_admin.php">Panel de Administracion</a></li>
          <li class="active">Agregar Mensualidad</li>
        </ol>
      </div>
    </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h4>Agregar Mensualidad</h4><br>
    </div>
  </div>
  
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
