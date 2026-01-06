<?php 

	 session_start();

  	include('configPHP/conecta.inc.php');

  	include('configPHP/config.inc.php');

  	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

  	

    date_default_timezone_set('America/Mexico_City');

    include("inc/config-site.php");

  	if(!isset($_SESSION['id_user'])){
      header('Location:index.php');
      die();
    }

    $id_pagos_diversos = $_GET['id'];

    

    //Eliminar Pagos Diversos

    $eliminar_pagos_diversos = "delete from pagos_diversos where id_pagos_diversos = $id_pagos_diversos;";

    $iny_eliminar_pagos_diversos = mysqli_query($mysqli,$eliminar_pagos_diversos) or die(mysqli_error($mysqli));



    header("Location: panel-pagos-diversos.php");

 ?>