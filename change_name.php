<?php
	session_start();
	include('configPHP/conecta.inc.php');
	include('configPHP/config.inc.php');
	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
	
	$actual_page = "nombre_cambio";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="Pablo Cortes Arzaluz">
		<link rel="icon" href="../../favicon.ico">

		<title>Cambiar Nombre :: Country del Lago</title>
	
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
					<li class="active">Cambiar Nombre</li>
				</ol>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h4>Cambiar Nombre</h4>
			</div>
		</div>
		<br>
	<form action="_chpss.php" method="POST" id="frm_changename" name="frm_changename" class="form-horizontal">
	<div class="row">
			<div class="col-lg-6 col-xs-12">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="inputName" class="control-label col-md-4 col-xs-3">Nombre Actual</label>
							<div class="col-md-8 col-xs-9">
								<input type="text" class="form-control" disabled id="nombre_actual" name="nombre_actual" value="<?php echo ucwords(strtolower($_SESSION['name_user'])); ?>"  required>
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
							<label for="inputName" class="control-label col-md-4 col-xs-3">Nombre Nuevo</label>
							<div class="col-md-8 col-xs-9">
								<input type="text" class="form-control" id="nuevo_nombre" name="nuevo_nombre" autocomplete="off" placeholder="Nuevo Nombre" value="" required>
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
							<label for="inputName" class="control-label col-md-4 col-xs-3">Contraseña</label>
							<div class="col-md-8 col-xs-9">
								<input type="password" class="form-control" id="password" name="password_cambiar_nombre" autocomplete="off" placeholder="Password" value="" required>
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
							$conocerPassword = mysqli_query($mysqli,"select password from user where id_user=".$_SESSION['id_user'].";") or die(mysqli_error($mysqli));
							$pass = mysqli_fetch_row($conocerPassword);
						?>
							<a href="#" onclick="validarNombre('<?php echo $pass[0]; ?>');" class="btn btn-success">Cambiar Contraseña</a>
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
