<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
	include("inc/config-site.php");
	
  $passwNva =  $_POST['password_nueva1'];
  $actualizaPassword = mysqli_query($mysqli,"update user set password='$passwNva' where id_user=".$_SESSION['id_user'].";") or die(mysqli_error($mysqli));

  session_destroy();
  header("Location: index.php?alert=4");
?>
