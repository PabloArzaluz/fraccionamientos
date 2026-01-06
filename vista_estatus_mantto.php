<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  $actual_page = "notificaciones";
  date_default_timezone_set('America/Mexico_City');
  include("inc/config-site.php");
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



    <title>Avisos :: <?php echo $_SESSION['nombre-sitio']; ?></title>

	

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

    <!-- Inicio Menu Comun-->
    <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a>
        </div>
        <center>
            <div class="navbar-collapse collapse" id="navbar-main">
                <?php if(isset($_SESSION['id_user'])){ ?><ul class="nav navbar-nav">
                    <li <?php if(isset($actual_page) && $actual_page == "notificaciones") echo "class='active'"; ?>><a href="#">Reporte de Estatus de Pago Mantenimientos</a>
                    </li>
                </ul><?php } ?>

                <?php if(!isset($_SESSION['id_user'])){ ?><form action="verifyLogin.php" method="POST" class="navbar-form navbar-right" role="search">

                    <div class="form-group">

                        <input type="text" class="form-control" name="email_country_login" placeholder="Usuario">

                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" name="password_country_login" placeholder="Contraseña">

                    </div>

                    <div class="form-group">

                        

                    </div>

                    

                    <button type="submit" class="btn btn-success">Entrar</button>

                </form>

                <?php }else{ ?>
                    <div class="navbar-right">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?php echo ucwords(strtolower($_SESSION['name_user'])); ?></b> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <li><a href="logout.php">Cerrar Sesion</a>
                            </li>                
                        </ul>
                    </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </center>
    </div>
    </div>

    <!--Fin Menu Comun-->



 <div class="container">

    <div class="row">

      <div class="col-xs-12">

        <ol class="breadcrumb">

          <li><a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a></li>

          <li class="active">Reporte de Pago de Mantenimiento</li>

        </ol>

      </div>

    </div>

  </div>

  <div class="container">

    <div class="row">

      <div class="col-xs-12">

        <div class="panel panel-default">

        <div class="panel-heading"><h4 class="panel-title" id="sin-salto-h">Pago de Mantenimiento</h4> </div>

  <div class="panel-body">

    <?php



     $ano = date("Y");

  $mes = date("m"); 

 $mes2=date("F");

  if ($mes2=="January") $mes2="Enero";

  if ($mes2=="February") $mes2="Febrero";

  if ($mes2=="March") $mes2="Marzo";

  if ($mes2=="April") $mes2="Abril";

  if ($mes2=="May") $mes2="Mayo";

  if ($mes2=="June") $mes2="Junio";

  if ($mes2=="July") $mes2="Julio";

  if ($mes2=="August") $mes2="Agosto";

  if ($mes2=="September") $mes2="Setiembre";

  if ($mes2=="October") $mes2="Octubre";

  if ($mes2=="November") $mes2="Noviembre";

  if ($mes2=="December") $mes2="Diciembre";

 $fechaActual = $ano."-".$mes."-01";

    $conocercantidad = mysqli_query($mysqli,"select COUNT(DISTINCT id_user) from  user where level=0 or level=2;") or die(mysqli_error($mysqli));

    $cantidad = mysqli_fetch_row($conocercantidad);
    //Validar la cantidad de casas
    if($cantidad[0] > 1){
      
      $conocerpagados = mysqli_query($mysqli,"select count(DISTINCT id_mensualidad) from mensualidades inner join user on mensualidades.id_user = user.id_user where fecha='$fechaActual';") or die(mysqli_error($mysqli));
      $cantidadpagados = mysqli_fetch_row($conocerpagados);
      $porcentajepagados = round(($cantidadpagados[0] * 100 ) / $cantidad[0],0);
      $porcentajenopagados = 100 - $porcentajepagados ;
     
    ?> 
      
    <?php
    }else{
      echo "No hay casas registradas aún";
    }
?>
   <!-- Inicio Reporte -->

   <?php
                $ano = date("Y");
                  $mes = date("m"); 
                 $mes2=date("F");
                  if ($mes2=="January") $mes2="Enero";
                  if ($mes2=="February") $mes2="Febrero";
                  if ($mes2=="March") $mes2="Marzo";
                  if ($mes2=="April") $mes2="Abril";
                  if ($mes2=="May") $mes2="Mayo";
                  if ($mes2=="June") $mes2="Junio";
                  if ($mes2=="July") $mes2="Julio";
                  if ($mes2=="August") $mes2="Agosto";
                  if ($mes2=="September") $mes2="Setiembre";
                  if ($mes2=="October") $mes2="Octubre";
                  if ($mes2=="November") $mes2="Noviembre";
                  if ($mes2=="December") $mes2="Diciembre";
                 $fechaActual = $ano."-".$mes."-01";
                 echo "<div class='row'><div class='col-xs-12'></div></div>";
                $pagadas = 0;
                echo "<div class='row'>";
                $consulta_mantto = mysqli_query($mysqli,"select user.id_user,user.no_casa,mensualidades.fecha from user inner join mensualidades on user.id_user = mensualidades.id_user where mensualidades.fecha = '$fechaActual' order by user.no_casa;") or die(mysqli_error($mysqli));
                while($arr_mantto = mysqli_fetch_array($consulta_mantto)){ 
                    $pagadas = $pagadas+1;
                    echo "<div class='col-xs-2'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> $arr_mantto[1]</div>"; 
                } 
            ?>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <?php echo "<h4>Total: ".$pagadas."</h4>"; ?>
                </div>
            </div>
            <br>
            <div class="row"><h2>Casas No Pagadas</h2></div>
            <div class="row">
                <?php
          $nopagadas = 0;
            $consulta_mantto = mysqli_query($mysqli,"SELECT * FROM user WHERE id_user NOT IN (select user.id_user from user inner join mensualidades on user.id_user = mensualidades.id_user where mensualidades.fecha = '$fechaActual' order by no_casa) and user.level=0;") or die(mysqli_error($mysqli));
            while($arr_mantto = mysqli_fetch_array($consulta_mantto)){ 
              $nopagadas = $nopagadas +1;
              echo "<div class='col-xs-2'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>$arr_mantto[1]</div>";
            } 
          ?>
        </div>
        <br>
        <div class="row">
        	<div class="col-xs-12">
          		<?php echo "<h4>Total: ".$nopagadas."</h4>"; ?>
        	</div>
      	</div>
		  <br>
		  
  <!--Fin Reporte-->
  </div>

  

</div>

      </div>

    </div>

    <div class="row">

      <div class="col-xs-12">



      </div>

    </div>

  </div>

  



		<?php 

			include("inc/footer-common.php");

		 ?>

    </body>

</html>

