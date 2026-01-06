<?php 
	session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	


    for($i=101;$i<=260;$i++){
      $consulta = "select * from user where user_login=$i";
      $inserta = mysqli_query($mysqli,$consulta) or die(mysqli_error($mysqli));
      if(mysqli_num_rows($inserta)>0){
        
      }else{
        $inserta_usuario = mysqli_query($mysqli,"insert into user(user_login,nombre,password,no_casa,level) values('$i','$i','$i','$i',0);") or die(mysqli_error($mysqli));
        $id_insertado = mysqli_insert_id($mysqli);
        $insertar_mantto = mysqli_query($mysqli,"insert into mantto(id_user,estatus) values($id_insertado,0);") or die(mysqli_error($mysqli));
      }
    }

 ?>