<?php 
	session_start();
  	
  	include('configPHP/config.inc.php');
  	
  	


    for($i=101;$i<=260;$i++){
      $consulta = "select * from user where user_login=$i";
      $inserta = mysqli_query($consulta,$link) or die(mysqli_error($mysqliConn));
      if(mysqli_num_rows($inserta)>0){
        
      }else{
        $inserta_usuario = mysqli_query($mysqliConn,"insert into user(user_login,nombre,password,no_casa,level) values('$i','$i','$i','$i',0);") or die(mysqli_error($mysqliConn));
        $id_insertado = mysqli_insert_id($mysqli);
        $insertar_mantto = mysqli_query($mysqliConn,"insert into mantto(id_user,estatus) values($id_insertado,0);") or die(mysqli_error($mysqliConn));
      }
    }

 ?>