<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  

  $passwNva =  $_POST['password_nueva1'];
  $actualizaPassword = mysqli_query($mysqliConn,"update user set password='$passwNva' where id_user=".$_SESSION['id_user'].";") or die(mysqli_error($mysqliConn));

  session_destroy();
  header("Location: index.php?alert=4");
?>
