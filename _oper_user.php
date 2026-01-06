<?php 

	session_start();

  	include('configPHP/conecta.inc.php');

  	include('configPHP/config.inc.php');

  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  	



  	$oper = $_GET['oper'];



  	if($oper == "add"){

  		$login_user = $_POST['login-user'];
  		$password = $_POST['password-user'];
  		$no_casa = $_POST['nocasa-user'];
  		$nombre_user = $_POST['name-user'];
  		$level_user = $_POST['nivel-user'];
    	$direccion = $_POST['direccion'];
		$name_dueno = $_POST['name-dueno'];
		$no_coches = $_POST['no-coches'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];

  		$inserta_usuario = mysqli_query($mysqli,"insert into user(user_login,nombre,password,no_casa,level,direccion,nombre_dueno,no_coches,telefono,email) 
                                      values(
                                        '$login_user',
                                        '$nombre_user',
                                        '$password',
                                        '$no_casa',
                                        $level_user,
                                        '$direccion',
                                        '$name_dueno',
                                        '$no_coches',
                                        '$telefono',
                                        '$email'
                                    );") or die(mysqli_error($mysqli));
      	$id_insertado = mysqli_insert_id($mysqli);
    	$insertar_mantto = mysqli_query($mysqli,"insert into mantto(id_user,estatus) values($id_insertado,0);") or die(mysqli_error($mysqli));
		$_SESSION['redirect'] = "users";

  		header("Location: panel-usuarios.php");

  	}elseif ($oper == "edit") {

  		$id_user = $_GET['i'];

  		$login_user = $_POST['login-user'];

  		$password = $_POST['password-user'];

  		$no_casa = $_POST['nocasa-user'];

  		$nombre_user = $_POST['name-user'];

  		$level_user = $_POST['nivel-user'];

      $direccion = $_POST['direccion'];

      $name_dueno = $_POST['name-dueno'];

      $no_coches = $_POST['no-coches'];

      $telefono = $_POST['telefono'];

      $email = $_POST['email'];



      $actualiza_usuario = mysqli_query($mysqli,"update user set 

                                          user_login='$login_user',

                                          nombre='$nombre_user',

                                          password='$password',

                                          no_casa='$no_casa',

                                          level='$level_user',

                                          direccion = '$direccion',

                                          nombre_dueno = '$name_dueno',

                                          no_coches = '$no_coches',

                                          telefono='$telefono',

                                          email='$email'

                                      where id_user=$id_user;") or die(mysqli_error($mysqli));

  		$_SESSION['redirect'] = "users";

  		header("Location: panel-usuarios.php");

  	}elseif($oper=="del"){

  		$id_user = $_GET['i'];

      	$borrar_pagos = mysqli_query($mysqli,"delete from mantto where id_user=$id_user;") or die(mysqli_error($mysqli));

  		$borrar_usuario = mysqli_query($mysqli,"delete from user where id_user=$id_user") or die(mysqli_error($mysqli));

  		$_SESSION['redirect'] = "users";

  		header("Location: panel-usuarios.php");

  	}



	/*$id = $_POST['user'];

	$operacion = $_POST['oper'];



	if(!isset($_POST['stat'])){

		$stat = 0;

	}else{

		$stat = 1;

	}

	

	if($operacion == "upd"){

		$cambioestado = mysqli_query($mysqli,"update mantto set estatus=$stat where id_user=$id;",$link) or die (mysqli_error($mysqli));

	}elseif($operacion == "ins"){

		$insertaestado = mysqli_query($mysqli,"insert into mantto(id_user,estatus) values($id,$stat);") or die(mysqli_error($mysqli));

	}

	

	header("Location: panel_admin.php");*/

 ?>