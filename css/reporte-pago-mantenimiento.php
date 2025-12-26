<?php

	session_start();
    
    include('configPHP/config.inc.php');
    
    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Reporte de Pagos de Mantenimientos :: Country del Lago I</title>
        <?php include("inc/head-common.php"); ?>
        <link rel="stylesheet" href="css/print.css" type="text/css" media="print"/>
    </head>
    <body>
        <div class="container">
    <div>
        <div class="row"><h2>Casas Pagadas</h2></div>
        
            <?php
                $ano = date("Y");
                  $mes = date("m"); 
                 $mes2=date("F");
                  if ($mes2=="January") $mes2="Enero";
                  if ($mes2=="February") $mes2="Febrero";
                  if ($mes2=="March") $mes2="Marzo";
                  if ($mes2=="April") $mes2="Abril";
                  if ($mes2=="May") $mes2="Mayo";
                  if ($mes2=="June") $mes2="Junio";
                  if ($mes2=="July") $mes2="Julio";
                  if ($mes2=="August") $mes2="Agosto";
                  if ($mes2=="September") $mes2="Setiembre";
                  if ($mes2=="October") $mes2="Octubre";
                  if ($mes2=="November") $mes2="Noviembre";
                  if ($mes2=="December") $mes2="Diciembre";
                 $fechaActual = $ano."-".$mes."-01";
                 echo "<div class='row'><div class='col-xs-12'></div></div>";
                $pagadas = 0;
                echo "<div class='row'>";
                $consulta_mantto = mysqli_query($mysqliConn,"select user.id_user,user.no_casa,mensualidades.fecha from user inner join mensualidades on user.id_user = mensualidades.id_user where mensualidades.fecha = '$fechaActual' order by user.no_casa;") or die(mysqli_error($mysqliConn));
                while($arr_mantto = mysqli_fetch_array($consulta_mantto)){ 
                    $pagadas = $pagadas+1;
                    echo "<div class='col-xs-2'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> $arr_mantto[1]</div>"; 
                } 
            ?>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <?php echo "<h4>Total: ".$pagadas."</h4>"; ?>
                </div>
            </div>
            <br>
            <div class="row"><h2>Casas No Pagadas</h2></div>
            <div class="row">
                <?php
          $nopagadas = 0;
            $consulta_mantto = mysqli_query($mysqliConn,"SELECT * FROM user WHERE id_user NOT IN (select user.id_user from user inner join mensualidades on user.id_user = mensualidades.id_user where mensualidades.fecha = '$fechaActual' order by no_casa) and user.level=0;") or die(mysqli_error($mysqliConn));
            while($arr_mantto = mysqli_fetch_array($consulta_mantto)){ 
              $nopagadas = $nopagadas +1;
              echo "<div class='col-xs-2'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span>$arr_mantto[1]</div>";
            } 
          ?>
        </div>
        <br>
        <div class="row">
        <div class="col-xs-12">
          <?php echo "<h4>Total: ".$nopagadas."</h4>"; ?>
        </div>
      </div>
    </div>
  </body>
</html>

