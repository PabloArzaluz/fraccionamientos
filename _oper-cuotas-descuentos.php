<?php 
    session_start();
    include('configPHP/conecta.inc.php');
    include('configPHP/config.inc.php');
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
    
    date_default_timezone_set('America/Mexico_City');

    //$oper = $_GET['oper'];
   
    $fechacaptura = date("Y-m-d G:i:s"); 
    
    $cuota = $_POST['cuota'];
    
    if(isset($_POST['habilitardescuento'])){
      if(!isset($_POST['mesescobra']) || $_POST['mesescobra'] == 0 || $_POST['mesescobra'] =="" || !isset($_POST['mesesgratis']) || $_POST['mesesgratis'] == 0 || $_POST['mesesgratis'] == ""){
        $descuento = 0;
      }else{
        $descuento = 1;
        $mesescobra = $_POST['mesescobra'];
        $mesesgratis = $_POST['mesesgratis'];
      }
      
    }else{
      $descuento = 0;
      $INY_ACTUALIZAR_DESACTIVAR = mysqli_query($mysqli,"SELECT MAX(id_descuento) AS id FROM descuentos;",$link)or die(mysqli_error($mysqli));
      $fidLast = mysqli_fetch_row($INY_ACTUALIZAR_DESACTIVAR);
      
      $ACTUALIZAR_ESTATUS = "update descuentos set activo=0 where id_descuento=$fidLast[0];";
      $INY_ACTUALIZAR_ESTATUS = mysqli_query($mysqli,$ACTUALIZAR_ESTATUS) or die(mysqli_error($mysqli));
    }


    $user = $_SESSION['id_user'];
    
    $INSERTAR_CUOTA = "insert into cuotas(descripcion,monto,fechahora) values('Mensualidad',$cuota,'$fechacaptura');";
    $INY_INSERTAR_CUOTA = mysqli_query($mysqli,$INSERTAR_CUOTA,$link)or die(mysqli_error($mysqli));

    if($descuento == 1){
      $INSERTAR_DESCUENTO = "insert into descuentos(descripcion,meses_paga,meses_descuento,activo,datetime) values('Descuento',$mesescobra,$mesesgratis,$descuento,'$fechacaptura');";  
      $INY_INSERTAR_DESCUENTO = mysqli_query($mysqli,$INSERTAR_DESCUENTO,$link)or die(mysqli_error($mysqli));
    }
    header('Location: panel-cuotas-descuentos.php');
    /* 
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
      

      
    }
  */
   ?>