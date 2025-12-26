<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();
  $actual_page = "notificaciones";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Cambiar Contraseña :: Country del Lago</title>
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
    function validarPassword(contrasena){
      var contraActual = contrasena;
      if(document.getElementById("password_anterior").value == contraActual && document.getElementById("password_nueva1").value == document.getElementById("password_nueva2").value){
        alert("La contraseña se cambiara, vuelva a iniciar sesion");
        document.getElementById("frm_changepassword").submit();
      }else{
        document.getElementById("errordiv").style.display = "inline";
      }
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
          <li><a href="index.php">Country del Lago</a></li>
          <li class="active">Cambiar Contraseña</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h4>Cambiar Contraseña</h4>
      </div>
    </div>
    <br>
  <form action="_chpss.php" method="POST" id="frm_changepassword" name="frm_changepassword" class="form-horizontal">
  <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Contraseña Anterior</label>
              <div class="col-md-8 col-xs-9">
                <input type="password" class="form-control" id="password_anterior" name="password_anterior" placeholder="Contraseña Anterior" autocomplete="off" value="" required>
              </div>
            </div>
          </div>
        </div>              
      </div>
  </div>
  <br>
  <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="inputName" class="control-label col-md-4 col-xs-3">Contraseña Nueva</label>
              <div class="col-md-8 col-xs-9">
                <input type="password" class="form-control" id="password_nueva1" name="password_nueva1" autocomplete="off" placeholder="Contraseña Nueva" value="" required>
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
              <label for="inputName" class="control-label col-md-4 col-xs-3">Repetir Contraseña</label>
              <div class="col-md-8 col-xs-9">
                <input type="password" class="form-control" id="password_nueva2" name="password_nueva2" autocomplete="off" placeholder="Repetir Contraseña" value="" required>
              </div>
            </div>
          </div>
        </div>              
      </div>
  </div>
  <div class="row" id="errordiv" style="display:none;">
    <div class="col-lg-6 col-xs-12">
      <div class="alert alert-danger" role="alert"><strong>Datos Incorrectos</strong></div>
    </div>
  </div>
  
  <div class="row" >
      <div class="col-lg-6 col-xs-12">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group text-right">
            <?php 
              $conocerPassword = mysql_query("select password from user where id_user=".$_SESSION['id_user'].";",$link) or die(mysql_error());
              $pass = mysql_fetch_row($conocerPassword);
            ?>
              <a href="#" onclick="validarPassword('<?php echo $pass[0]; ?>');" class="btn btn-success">Cambiar Contraseña</a>
            </div>
          </div>
        </div>              
      </div>
  </div>
  </form>
  </div>
  

		<?php 
			include("inc/footer-common.php");
		 ?>
    </body>
</html>
