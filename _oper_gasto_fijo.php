<?php 
    session_start();
    include('configPHP/conecta.inc.php');
    include('configPHP/config.inc.php');
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
    
    date_default_timezone_set('America/Mexico_City');

    $oper = $_GET['oper'];
   
    $fechacaptura = date("Y-m-d G:i:s"); 
    
    $descripcion = $_POST['descripcion'];
    $monto = $_POST['monto'];
    

    $user = $_SESSION['id_user'];
       
    if($oper == 'add'){
      $INSERTAR_GASTO_FIJO = "insert into gastos_fijos(descripcion, activo) values('$descripcion',1);";
      $INY_INSERTAR_GASTO_FIJO = mysqli_query($mysqli,$INSERTAR_GASTO_FIJO) or die(mysqli_error($mysqli));

      $INY_CONOCER_ID_GASTO_FIJO = mysqli_query($mysqli,"SELECT MAX(id_gastos_fijos) AS id FROM gastos_fijos;") or die(mysqli_error($mysqli));
      $f_ultimo_id = mysqli_fetch_row($INY_CONOCER_ID_GASTO_FIJO);

      $f_ultimo_id[0];

      $INSERTAR_HISTORICO_GASTO = "insert into historico_gastos_fijos(id_gastos_fijos,monto,fecha_captura) values($f_ultimo_id[0],'$monto','$fechacaptura');";
      $INY_HISTORICO_GASTO = mysqli_query($mysqli,$INSERTAR_HISTORICO_GASTO) or die(mysqli_error($mysqli));
      header('Location: panel-gastos-fijos.php');
    }
    if($oper=='edit'){
      $id_fijos = $_GET['i'];
      
      $ACTUALIZAR_DESCRIPCION_GASTOS_FIJOS = "update gastos_fijos set descripcion='$descripcion' where id_gastos_fijos=$id_fijos;";
      $INY_ACTUALIZAR_DESCRIPCION_GASTOS_FIJOS = mysqli_query($mysqli,$ACTUALIZAR_DESCRIPCION_GASTOS_FIJOS) or die(mysqli_error($mysqli));

      $INSERTAR_GASTO_FIJO_ULTIMO = "insert into historico_gastos_fijos(id_gastos_fijos,monto,fecha_captura) values($id_fijos,'$monto','$fechacaptura');";
      $INY_INSERTAR_GASTO_FIJO_ULTIMO = mysqli_query($mysqli,$INSERTAR_GASTO_FIJO_ULTIMO) or die(mysqli_error($mysqli));
      header('Location: panel-gastos-fijos.php');

      
    }

   ?>