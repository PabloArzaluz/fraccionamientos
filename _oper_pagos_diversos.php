<?php 
    session_start();
    include('configPHP/conecta.inc.php');
    include('configPHP/config.inc.php');
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
    
    date_default_timezone_set('America/Mexico_City');

    $oper = $_GET['oper'];
    $fechahoracaptura = date("Y-m-d G:i:s"); 
    
    $descripcion = $_POST['descripcion'];
    $monto = $_POST['monto'];
    $tipo = $_POST['tipoPago'];

    $hora = date("G:i:s"); 
    $usuario = $_POST['usuario'];
    $usuarioCaptura = $_SESSION['id_user'];
       
    if($oper == 'add'){
      echo $INSERTAR_PAGO_DIVERSO = "insert into pagos_diversos(id_user,monto,descripcion,id_user_captura,fechahoracaptura,tipo) 
                                  values(
                                    $usuario,
                                    '$monto',
                                    '$descripcion',
                                    $usuarioCaptura,
                                    '$fechahoracaptura',
                                    $tipo
                                );";

      $INY_INSERTAR_PAGO_DIVERSO = mysqli_query($mysqli,$INSERTAR_PAGO_DIVERSO) or die(mysqli_error($mysqli));
      header('Location: panel-pagos-diversos.php');
    }
?>