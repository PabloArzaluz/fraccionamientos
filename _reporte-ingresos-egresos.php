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
    <title>Reporte de Ingresos Egresos - <?php echo $_SESSION['nombre-sitio']; ?></title>
    <link href="css/invoice_horizontal.css" rel="stylesheet">
    <style type="text/css">
        table.tabla{
            width:100%;
        }
    </style>

  </head>



  <body>

<?php 

  //$fecha_inicial = $_POST['fechainicio'];

  $mes = $_GET['mes'];

  $casas = "0";

	   $query_conocer_usuarios = "select user.id_user, nombre, no_casa from user where level=0 order by no_casa;";

    $iny_conocer_usuarios = mysqli_query($mysqli,$query_conocer_usuarios) or die(mysqli_error($mysqli));

?>

<div class="wrapper">

    <table class="header">

        <tr>

            <td width="50%" nowrap>

                <p><h2><?php echo $_SESSION['nombre-sitio']; ?></h2></p>

            </td>

            <td width="50%" align="center">

                <span class="title">Reporte Ingresos Egresos</span><br /><br><br>

            </td>

        </tr>

    </table>

    <?php 
        $mesSeparate = explode("-", $mes);
            if($mesSeparate[1] == 1)
                $mesEspanol = "Enero";

                                if($mesSeparate[1] == 2)

                                    $mesEspanol = "Febrero";

                                if($mesSeparate[1] == 3)

                                    $mesEspanol = "Marzo";

                                if($mesSeparate[1] == 4)

                                    $mesEspanol = "Abril";

                                if($mesSeparate[1] == 5)

                                    $mesEspanol = "Mayo";

                                if($mesSeparate[1] == 6)

                                    $mesEspanol = "Junio";

                                if($mesSeparate[1] == 7)

                                    $mesEspanol = "Julio";

                                if($mesSeparate[1] == 8)

                                    $mesEspanol = "Agosto";

                                if($mesSeparate[1] == 9)

                                    $mesEspanol = "Septiembre";

                                if($mesSeparate[1] == 10)

                                    $mesEspanol = "Octubre";

                                if($mesSeparate[1] == 11)

                                    $mesEspanol = "Noviembre";

                                if($mesSeparate[1] == 12)

                                    $mesEspanol = "Diciembre";

     ?>

    <table class="items" >

        <tr>

            <td width="100%">

            <table class="tabla">

            <thead>

                <tr>

                    <th>Fecha</th>

                    <th>Nombre</th>

                    <th>Descripcion</th>

                    <th>Egresos</th>

                    <th>Ingresos</th>

                </tr>

            </thead>

            <tbody>

                <tr class="tr-reporte">

                    <td></td>

                    <td>
                        Cuotas de Mantenimiento Percibidas en Mes 
                        <?php
                            echo "<b>".$mesEspanol." del ".$mesSeparate[0]." (68 casas) (Costo Mantenimiento sin recargo: $800.00)</b>";
                            $cuotasSinRecargo = 54400;
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="textcenter" style="font-weight:bold;">
                        <?php 
                            $mesPlusOne = $mesSeparate[1]+1;
                            $FechaInicialMesSeleccionado = date('Y-m-01', strtotime($mes))." 00:00:00";
                            $FechaFinalMesSeleccionado = date('Y-m-t', strtotime($mes))." 00:00:00";
                            $CONOCER_TOTAL_MESES_CUOTAS = "select * from pagos_mantto where datetimecobro >= '$FechaInicialMesSeleccionado' and datetimecobro <'$FechaFinalMesSeleccionado'";
                                
                            $INY_CONOCER_TOTAL_MESES_CUOTAS = mysqli_query($mysqli,$CONOCER_TOTAL_MESES_CUOTAS) or die(mysqli_error($mysqli));

                            $totalMensualidades = 0;

                            if(mysqli_num_rows($INY_CONOCER_TOTAL_MESES_CUOTAS) > 0){

                                while($f_totalMesesCuotas = mysqli_fetch_array($INY_CONOCER_TOTAL_MESES_CUOTAS)){

                                    $CONOCER_MONTOS = "select monto from cuotas where id_cuota= $f_totalMesesCuotas[2];";

                                    $INY_CONOCER_MONTOS = mysqli_query($mysqli,$CONOCER_MONTOS,$link)or die(mysqli_error($mysqli));

                                    $fMonto = mysqli_fetch_row($INY_CONOCER_MONTOS);

                                    $totalMensualidades += $fMonto[0];

                                }
                                /*echo "$ ".number_format($totalMensualidades, 2);*/
                                echo "$ ".number_format($cuotasSinRecargo, 2);

                            }else{

                                //No hay mensualidades registradas en este mes

                                echo "$ ".number_format($totalMensualidades, 2);

                            }

                        ?>

                    </td>

                </tr>
                <!--<tr class="tr-reporte">
                    <td></td>
                    <td>
                        Otras cuotas de manteniemiento
                            <?php
                                //echo "<b>".$mesEspanol." del ".$mesSeparate[0]." (9 casas) ($150.00)</b>";
                                //$cuotasOtraCantidad_1 = 1350;
                            ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="textcenter" style="font-weight:bold;">

                        <?php 
                                /*echo "$ ".number_format($totalMensualidades, 2);*/
                                //echo "$ ".number_format($cuotasOtraCantidad_1, 2);
                        ?>
                    </td>
                </tr>-->
                <!--<tr class="tr-reporte">
                    <td></td>
                    <td>
                        Cuotas con Recargo por cargo extemporaneo
                            <?php
                                echo "<b>".$mesEspanol." del ".$mesSeparate[0]." (0 casas) ($850.00)</b>";
                                $cuotasOtraCantidad_1 = 0;
                            ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="textcenter" style="font-weight:bold;">

                        <?php 
                                /*echo "$ ".number_format($totalMensualidades, 2);*/
                                echo "$ ".number_format($cuotasOtraCantidad_1, 2);
                        ?>
                    </td>
                </tr>
                </tr>-->
                <!--<tr class="tr-reporte">
                    <td></td>
                    <td>
                        Otras cuotas de manteniemiento
                            <?php
                                //echo "<b>".$mesEspanol." del ".$mesSeparate[0]." (0 casas) ($500.00)</b>";
                                //$cuotasOtraCantidad_2 = 0;
                            ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="textcenter" style="font-weight:bold;">

                        <?php 
                                /*echo "$ ".number_format($totalMensualidades, 2);*/
                                //echo "$ ".number_format($cuotasOtraCantidad_2, 2);
                        ?>
                    </td>
                </tr>-->
                <!--<tr class="tr-reporte">
                    <td></td>
                    <td>
                        Aportacion Extraordinaria para Juegos (2 casas)
                            <?php
                                echo "<b>".$mesEspanol." del ".$mesSeparate[0]."  </b>";
                            ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td class="textcenter" style="font-weight:bold;">

                        <?php 
                                /*echo "$ ".number_format($totalMensualidades, 2);*/
                                echo "$ ".number_format(600, 2);
                        ?>
                    </td>
                </tr>
                        -->
                    <td colspan="5">
                        Gastos Fijos
                    </td>
                </tr
                <?php
                    $CONOCER_GASTOS_FIJOS = "select gastos_fijos.id_gastos_fijos,descripcion, monto from gastos_fijos inner join historico_gastos_fijos on gastos_fijos.id_gastos_fijos = historico_gastos_fijos.id_gastos_fijos where activo=1;";
                    $INY_CONOCER_GASTOS_FIJOS = mysqli_query($mysqli,$CONOCER_GASTOS_FIJOS,$link)or die(mysqli_error($mysqli));
                    $sumaGastosFijos = 0;

                    if(mysqli_num_rows($INY_CONOCER_GASTOS_FIJOS) > 0){
                        while($f_gastosFijos = mysqli_fetch_array($INY_CONOCER_GASTOS_FIJOS)){
                            echo "
                                <tr>
                                    <td></td>
                                    <td>
                                        $f_gastosFijos[1]
                                    </td>
                                    <td></td>
                                    <td class='textcenter' style='color:red;font-weight:bold;'>";
                                        echo "$ ".number_format($f_gastosFijos[2], 2);
                                        $sumaGastosFijos += $f_gastosFijos[2];
                                echo "</td>
                                    <td></td>
                                </tr>
                            ";
                        }
                    }else{
                        echo "<tr><td></td><td colspan='4'>No hay Gastos Fijos</td></tr>";
                        $sumaGastosFijos = 0;   
                    }
                ?>
                <tr>
                    <td colspan="5">Gastos Variables</td>
                </tr>
                <?php
                    $CONOCER_GASTOS_VARIABLES = "select * from gastos_variables where fecha >= '$FechaInicialMesSeleccionado' and fecha <'$FechaFinalMesSeleccionado';";
                    $INY_CONOCER_GASTOS_VARIABLES = mysqli_query($mysqli,$CONOCER_GASTOS_VARIABLES,$link)or die(mysqli_error($mysqli));
                    $sumaGastosVariables = 0;

                    if(mysqli_num_rows($INY_CONOCER_GASTOS_VARIABLES) > 0){

                        while($f_gastosVariables = mysqli_fetch_array($INY_CONOCER_GASTOS_VARIABLES)){
                            echo "
                                <tr>

                                    <td></td>

                                    <td>

                                        $f_gastosVariables[1]

                                    </td>

                                    <td></td>

                                    <td class='textcenter' style='color:red;font-weight:bold;'>";

                                        echo "$ ".number_format($f_gastosVariables[2], 2);

                                        $sumaGastosVariables += $f_gastosVariables[2];
                                echo "</td>

                                    <td></td>

                                </tr>

                            ";

                        }

                    }else{

                        echo "<tr><td></td><td colspan='4'>No hay Gastos Variables</td></tr>";

                        $sumaGastosVariables = 0;   



                    }

                ?>

                <tr>
                    <td colspan="5">
                        Otros Ingresos
                    </td>
                </tr>
                <?php
                    $CONOCER_OTROS_PAGOS = "select pagos_diversos.id_pagos_diversos,nombre,no_casa, monto,tipo,fechahoracaptura from pagos_diversos inner join user where pagos_diversos.id_user = user.id_user and fechahoracaptura >= '$FechaInicialMesSeleccionado' and fechahoracaptura < '$FechaInicialMesSeleccionado';";
                    $INY_CONOCER_OTROS_PAGOS = mysqli_query($mysqli,$CONOCER_OTROS_PAGOS,$link)or die(mysqli_error($mysqli));

                    $sumaOtrosPagos = 0;

                    if(mysqli_num_rows($INY_CONOCER_OTROS_PAGOS) > 0){

                        while($f_otrosPagos = mysqli_fetch_array($INY_CONOCER_OTROS_PAGOS)){

                            echo "

                                <tr>

                                    <td class='textcenter'>";

                            $fecha = date_create($f_otrosPagos[5]);

                            echo date_format($fecha, 'd/m/Y');

                            echo "  </td>

                                    <td>

                                        $f_otrosPagos[1] [$f_otrosPagos[2]]

                                    </td>";

                            if($f_otrosPagos[4] == 1){

                                echo "<td class='textcenter'>Pago de Saldo Inicial</td>";

                            }

                            echo "<td></td>";

                            echo "  <td class='textcenter' style='color:black;font-weight:bold;'>";

                                        echo "$ ".number_format($f_otrosPagos[2], 2);

                                        $sumaOtrosPagos += $f_otrosPagos[2];

                                echo "</td>

                                    

                                </tr>

                            ";

                        }

                    }else{

                        //echo "<tr><td></td><td colspan='4'>No hay Otros Pagos</td></tr>";
                        //$sumaOtrosPagos = 0;   
                        $IngresosAnticipadosOtros = 4150.04;
                        echo "<tr><td></td><td>Ingreso por Mantenimientos Anticipados, mantenimientos anteriores, venta de Tags y otros apoyos</td>
                        <td></td>
                        <td></td>
                    
                        <td class='textcenter' style='font-weight:bold;'>$".number_format($IngresosAnticipadosOtros, 2)."</td>
                        </tr>";
                        
                        //echo "<tr><td></td><td>Apoyo: Proyecto Camaras Internas (Cuota $300)</td>
                        //<td></td>
                        //<td></td>
                    
                        //<td class='textcenter' style='font-weight:bold;'>$3,900.00</td>
                        //</tr>";
                        $sumaOtrosPagos = 3150;


                    }

                ?>
                <tr><td colspan="5">&nbsp;</td></tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="textright"><b>Total</b></td>
                    <td class="textcenter" style="font-weight:bold;font-size:9pt;color:red;">
                        <?php 
                            $totalEgresos = $sumaGastosVariables+$sumaGastosFijos;
                            echo "$ ".number_format($totalEgresos, 2);                        
                        ?>
                    </td>
                    <td class="textcenter" style="font-weight:bold;font-size:9pt;color:black;">
                        <?php 
                            $totalIngresos = $totalMensualidades+$sumaOtrosPagos;
                            //echo "$ ".number_format($totalIngresos, 2);
                            echo "$ ".number_format(58550.04, 2);
                        ?>
                    </td>
                </tr>
            </tbody>
            </table> 
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
</div>
<p align="center"><a href="reporte-ingresos-egresos.php"><< Volver</a> | <a href="#" onClick="window.print()"> Imprimir</a> </p>
</body>
</html>