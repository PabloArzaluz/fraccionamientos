<?php

	session_start();

	ini_set("error_reporting", E_ALL & ~E_DEPRECATED);

	include_once("configPHP/conecta.inc.php");

	include_once("configPHP/config.inc.php");

	

	setlocale(LC_ALL, 'es_MX.UTF-8');

    function acortar($texto,$largo) {

        if(strlen($texto) >= 30){

            return substr($texto,0,$largo).'...';

        }else{

            return $texto;

        }

    }

?>



<!DOCTYPE html>

<html lang="es">

  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title>Reporte de Historico de Pagos - <?php echo $_SESSION['nombre-sitio']; ?></title>



    <link href="css/invoice_horizontal.css" rel="stylesheet">

    <style type="text/css">

        table.tabla{

            

            width:100%;

        }



    </style>

  </head>



  <body>

<?php 

  $fecha_inicial = $_POST['fechainicio'];

  $fecha_final = $_POST['fechafinal'];

  $casas = "0";

	   $query_conocer_usuarios = "select user.id_user, nombre, no_casa from user where level=0 or level=2 order by no_casa;";

    $iny_conocer_usuarios = mysqli_query($mysqli,$query_conocer_usuarios) or die(mysqli_error($mysqli));

?>

<div class="wrapper">

    <table class="header">

        <tr>

            <td width="50%" nowrap>

                <p><h2><?php echo $_SESSION['nombre-sitio']; ?></h2></p>

            </td>

            <td width="50%" align="center">

                <span class="title">Reporte Historico de Pagos</span><br /><br><br>

            </td>

        </tr>

    </table>

    <?php 

      //Generar Arreglo de meses



      $fechassindia = array(); 

      $fechascondia = array(); 

      for($i=$fecha_inicial;$i<=$fecha_final;$i = date("Y-m-d", strtotime($i ."+ 1 month"))){

        

        $ano = date("Y", strtotime($i));

        $mes = date("m", strtotime($i));

        $fechassindia[] = $mes."-".$ano;

        $fechascondia[] = $ano."-".$mes."-01";

      }

    ?>

    <table class="items" >

        <tr>

            <td width="100%">

            <table class="tabla">

            <thead>

                <tr>

                    <th>No Casa / Nombre</th>

                    <?php

                      for($i=0;$i<count($fechassindia);$i++){

                        echo "<th style='font-weight:normal;font-size:7pt;padding:0;margin:0;border-collapse:inherit;'>$fechassindia[$i]</th>";

                      }

                    ?>

                    <th>Pagadas/Total</th>

                </tr>

            </thead>

            <tbody>

            <?php

                

                while ($fMens = mysqli_fetch_array($iny_conocer_usuarios)) {

                    echo "<tr class='tr-reporte'>";

                    echo "<td class='td-reporte'><b>".$fMens[2]."</b><br>".$fMens[1]."</td>";

                    $contarPagadas = 0;

                    for($i=0;$i<count($fechascondia);$i++){

                        

                        $conocer_pago_mes_usuario = "select * from mensualidades where id_user=$fMens[0] and fecha='$fechascondia[$i]';";

                        $iny_conocer_pago_mes_usuario = mysqli_query($mysqli,$conocer_pago_mes_usuario) or die(mysqli_error($mysqli));

                        

                        if(mysqli_num_rows($iny_conocer_pago_mes_usuario)>0){

                          echo "<td style='text-align:center;padding:0;margin:0;background-color:gray;border-collpase:inherit;'>X</td>";

                          $contarPagadas = $contarPagadas+1;

                        }else{

                          echo "<td></td>";

                        }

                        //echo "<td style='font-weight:normal;font-size:7pt;'>$fechascondia[$i]</td>";

                      }

                      echo "<td class='textcenter'>".$contarPagadas." / ".count($fechascondia)."</td>";

                    

                    /*if($fila_pedidos[5] == 1){

                        $pago = "Efectivo";

                    }

                    if($fila_pedidos[5] == 2){

                        $pago = "Tarjeta";

                    }

                    if($fila_pedidos[5] == 3){

                        $pago = "Cheque";

                    }

                    if($fila_pedidos[5] == 4){

                        $pago = "Deposito";

                    }

                    if($fila_pedidos[5] == 5){

                        $pago = "Transferencia";

                    }

                    $iny_conocer_total = mysqli_query($mysqli,"select truncate(sum(valor_inicio * precio),2) as resultado from menu inner join producto on producto.id_producto = menu.id_producto where id_pedido=".$fila_pedidos[0].";",$link) or die (mysqli_error($mysqli));

                    $fila_conocer_total = mysqli_fetch_row($iny_conocer_total);

                    echo "<td class='td-reporte textcenter'>".$pago."<br>Total: $".$fila_conocer_total[0]."</td>";

                    echo "<td>";

                    $qry_productos = "select valor_inicio,nombre_producto,unidad_medida,precio from menu inner join producto on producto.id_producto=menu.id_producto where id_pedido =".$fila_pedidos[0].";";

                    $iny_conocer_productos = mysqli_query($mysqli,$qry_productos) or die(mysqli_error($mysqli));

                    

                        while($row_menus = mysqli_fetch_array($iny_conocer_productos)){

                        echo rtrim(rtrim(number_format($row_menus[0], 2), '0'), '.')." - ".$row_menus[1];;

                        

                            if($row_menus[2] == 1){

                                echo " [Kilogramo]";

                            }

                            if($row_menus[2] == 2){

                                echo " [Orden]";

                            }

                            if($row_menus[2] == 3){

                                echo " [Pieza]";  

                            }

                            if($row_menus[2] == 4){

                                echo " [Litro]";  

                            }

                            

                           echo "<br>";

                        }

                        */

                       





                    

                    

                    

                    echo "</tr>";

                    /*

                    echo "<div style='width:31%;position:relative;float:left; padding:5px;font-size:7pt;'>";

                    $qry_dias = "select distinct fecha_entrega_cliente as dias from pedido inner join menu on menu.id_pedido = pedido.id_pedido where menu.id_producto = ".$fila_conocer_platillos_solicitados[0]." order by dias asc";

                    $iny_conocer_dias = mysqli_query($mysqli,$qry_dias) or die(mysqli_error($mysqli));

                    $iny_nombre_producto = mysqli_query($mysqli,"select nombre_producto from producto where id_producto=".$fila_conocer_platillos_solicitados[0].";") or die(mysqli_error($mysqli));

                    $nombre_producto = mysqli_fetch_row($iny_nombre_producto);

                    echo "<h4 class='text-center'><span class='top' title='".$nombre_producto[0]."' data-original-title='Tooltip on right'>".acortar($nombre_producto[0],30)."</span></h4>

                            <table style='width:100%;border:1px solid #ccc;'>

                            <thead>

                            <tr style='border-bottom:1px solid #ccc;'><th>Dia</th>";

                    $dias = array(); 

                    while($r_dias = mysqli_fetch_array($iny_conocer_dias)){

                        echo "<th class='text-center'>".date("d", strtotime($r_dias[0])) ."</th>";

                        $dias[] = $r_dias[0];

                    }

                    echo "</tr></thead><tbody><tr><td style='border-right:0;'>Ordenes</td>";

                    $suma_total = 0;

                    foreach ($dias as $roww) {

                        $qry = "select SUM(valor_inicio) from menu inner join pedido on menu.id_pedido =pedido.id_pedido where id_producto = ".$fila_conocer_platillos_solicitados[0]." and fecha_entrega_cliente='".$roww."'";

                        $iny_cantidad_dias= mysqli_query($mysqli,$qry) or die(mysqli_error($mysqli));

                        $f_cantidad_total = mysqli_fetch_row($iny_cantidad_dias);

                        echo "<td class='textcenter' style='border-right:0;'>".rtrim(rtrim(number_format($f_cantidad_total[0], 2), '0'), '.')."</td>";

                        $suma_total += $f_cantidad_total[0];

                    }

                    echo "</tr>";

                    echo "</tr><th>Total</th><td";

                    echo " colspan='".count($dias)."' class='textcenter' style='border-top:0;border-bottom:0;border-right:0;'>";

                    echo "<span class='badge'>".$suma_total."</span></td></tr>

                    </tbody></table></div>";

                    */

                }

                

             ?>

             </tbody>

            </table> 

            </td>

           

            

        </tr>

    </table>

    <br>

    <br>

    <br>

</div>

<p align="center"><a href="reporte-historico-pagos.php"><< Volver</a> | <a href="#" onClick="window.print()"> Imprimir</a> </p>



</body>

</html>