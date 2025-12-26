<?php
	session_start();
  $actual_page = "inicio";
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

    <title>Country del Lago</title>
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <?php 
  	include("inc/nav-common.php")
  ?>
  <?php 
    if(isset($_GET['alert'])){
   ?>
   <div class="container">
  	<div class="row">
  		<div class="col-xs-12">
  			<?php if($_GET['alert'] == 1){ ?>
        <div class="alert alert-danger" ><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Error de usuario o contraseña</div><br>
        <?php } ?>
        <?php if($_GET['alert'] == 3){ ?>
        <div class="alert alert-success" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Sesion Cerrada Exitosamente</div><br>
        <?php } ?>
        <?php if($_GET['alert'] == 4){ ?>
        <div class="alert alert-success" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ¡Contraseña cambiada exitosamente!, por favor vuelva a iniciar sesion</div><br>
        <?php } ?>
  		</div>
  	</div>
  </div>
  <?php } ?>

    <div class="container">
    	<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
    <div class="thumbnail">
      <img src="img/letreroentok.jpg" alt="...">
      <div class="caption">
        <h3>Country del Lago</h3>
        <p>Pagina para administracion y control</p>
        
      </div>
    </div>
  </div>
    </div> 	 


		<?php 
			include("inc/footer-common.php");
		 ?>
    </body>
</html>
