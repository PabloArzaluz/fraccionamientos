<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  include("inc/config-site.php");
  
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?php echo $_SESSION['nombre-sitio']; ?> :: Ver Usuario</title>
    <?php include("inc/head-common.php"); ?>
  </head>

  <body>
  <?php 
  	include("inc/nav-common.php")
  ?>
  
<div class="container">
  
  <?php 
    
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

  ?>
  <div class="row">
  <div class="col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
        <a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a> / <a href="panel-usuarios.php">Panel de Administracion</a> /  Ver Usuario
        <div class="pull-right">
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                Operaciones
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="oper_user.php?oper=edit&i=<?php echo $id_user; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>
                </li>
                <!--<li><a href="#" data-href='' data-toggle='modal' data-target='#confirm-delete' ><i class="fa fa-minus-circle"></i> Eliminar </a>
                </li>
                <li class="divider"></li>
                <li><a href=""><i class="fa fa-pencil-square fa-fw"></i> Capturar Cocina</a>
                </li>
                
                
                <li class="divider"></li>
                <li><a href=""><i class="fa fa-print"></i> Imprimir</a>
                </li>-->
                    </ul>
                </div>
            </div>
          </div>
        <div class="panel-body">
            <form action="_oper_user.php?oper=<?php echo $typeOper; ?>" method="POST" name="frm_User" class="form-horizontal">
  <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Usuario</label>
              <div class="col-md-8 col-xs-9">
                <input type="name" class="form-control" name="login-user" placeholder="Usuario" value="<?php  echo $loginUser?>" required disabled>
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
                <input type="name" class="form-control" name="password-user" placeholder="Contraseña" value="<?php echo $password ?>" required disabled>
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
                <input type="name" class="form-control" name="nocasa-user" placeholder="Numero de Casa" value="<?php echo $noCasa ?>" required disabled>
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
              <input type="name" class="form-control" name="name-user" placeholder="Nombre Completo" value="<?php echo $nameUser; ?>" required disabled>
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
              <select class="form-control" id="sel1" required name="nivel-user" disabled>
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
              
              <textarea class="form-control" name="direccion" required disabled><?php echo $NOMBRE_DUENO; ?></textarea>
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
              <input type="name" class="form-control" name="name-dueno" placeholder="Nombre Dueño" value="<?php echo $NOMBRE_DUENO; ?>" required disabled>
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
              <input type="name" class="form-control" name="no-coches" placeholder="Numero de Coches" value="<?php echo $NO_COCHES; ?>" required disabled>
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
              <input type="name" class="form-control" name="telefono" placeholder="Numeros de Telefono" value="<?php echo $TELEFONO; ?>" required disabled>
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
              <input type="name" class="form-control" name="email" placeholder="Correo Electronico" value="<?php echo $EMAIL; ?>" required disabled>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
      </div>
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
