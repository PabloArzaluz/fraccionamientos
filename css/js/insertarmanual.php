<?php 
	session_start();
  	include('configPHP/conecta.inc.php');
  	include('configPHP/config.inc.php');
  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  	$link=Conecta();


    for($i=101;$i<=260;$i++){
      $consulta = "select * from user where user_login=$i";
      $inserta = mysql_query($consulta,$link) or die(mysql_error());
      if(mysql_num_rows($inserta)>0){
        
      }else{
        $inserta_usuario = mysql_query("insert into user(user_login,nombre,password,no_casa,level) values('$i','$i','$i','$i',0);",$link) or die(mysql_error());
        $id_insertado = mysql_insert_id();
        $insertar_mantto = mysql_query("insert into mantto(id_user,estatus) values($id_insertado,0);") or die(mysql_error());
      }
    }

 ?>