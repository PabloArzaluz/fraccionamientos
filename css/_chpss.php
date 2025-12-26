<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  $link=Conecta();

  $passwNva =  $_POST['password_nueva1'];
  $actualizaPassword = mysql_query("update user set password='$passwNva' where id_user=".$_SESSION['id_user'].";",$link) or die(mysql_error());

  session_destroy();
  header("Location: index.php?alert=4");
?>
