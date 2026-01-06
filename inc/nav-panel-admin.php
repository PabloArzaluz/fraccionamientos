<div class="row">
	<div class="col-xs-12">
		<ul class="nav nav-pills" role="tablist">
		<!-- AVISOS -->
		<?php if($_SESSION['level_user'] == 1 || $_SESSION['level_user'] == 2 ){?>
		    <li role="presentation" <?php if($current_page_admin == "avisos"){ echo "class='active'"; }?>><a href="panel-avisos.php">Avisos</a></li>
		<?php } ?> 
		<!--MANTENIMIENTO -->
			<li role="presentation" class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Mantenimiento <span class="caret"></span></a>
		        <ul class="dropdown-menu">
				    <li role="presentation" <?php if($current_page_admin == "mantto"){ echo "class='active'"; }?>><a href="panel-estatus-mantenimiento.php">Estatus Mantenimiento</a></li>
			        <li <?php if($current_page_admin == "pagos-diversos"){ echo "class='active'"; }?>><a href="panel-pagos-diversos.php">Pagos Diversos</a></li>
		        </ul>
		    </li>
		<!-- CONTROL DE GASTOS -->
		<?php if($_SESSION['level_user'] == 1 ){?>
		    <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Control de Gastos <span class="caret"></span></a>
		        <ul class="dropdown-menu">
			        <li <?php if($current_page_admin == "comprobantes-gastos"){ echo "class='active'"; }?>><a href="panel-comprobantes-gastos.php" >Carga de Comprobantes de Gastos</a></li>
			        <li <?php if($current_page_admin == "estados-cuenta"){ echo "class='active'"; }?>><a href="panel-estados-cuenta.php">Carga de Estados de Cuenta</a></li>
			        <li <?php if($current_page_admin == "gastos-variables"){ echo "class='active'"; }?>><a href="panel-gastos-variables.php">Captura de Gastos Variables</a></li>
		        </ul>
		    </li>
		<?php } ?>
		<!-- PRESUPUESTOS -->
		    <li role="presentation" <?php if($current_page_admin == "presupuestos"){ echo "class='active'"; }?>><a href="panel-presupuestos.php">Presupuestos </a></li>
		<!-- QUEJAS Y SUJERENCIAS -->
		    <li role="presentation" <?php if($current_page_admin == "qys"){ echo "class='active'"; }?>><a href="panel-quejas-sugerencias.php">Quejas y Sugerencias </a></li>
		<!-- USUARIOS -->
		    <?php if($_SESSION['level_user'] == 1 ){?>
		    <li role="presentation" <?php if($current_page_admin == "usuarios"){ echo "class='active'"; }?>><a href="panel-usuarios.php">Usuarios </a></li>
		    <?php } ?>
		<!-- configuraciones generales -->
		<?php if($_SESSION['level_user'] == 1 ){?>
			<li role="presentation" class="dropdown">	
        		<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configuraciones Grales. <span class="caret"></span></a>
			    <ul class="dropdown-menu">
					<li <?php if($current_page_admin == "config-site"){ echo "class='active'"; }?>><a href="panel-configuracion-sitio.php" >Datos de Sitio</a></li>
					<li <?php if($current_page_admin == "gastos-fijos"){ echo "class='active'"; }?>><a href="panel-gastos-fijos.php">Gastos Fijos</a></li>
					<li <?php if($current_page_admin == "cuotas-descuentos"){ echo "class='active'"; }?>><a href="panel-cuotas-descuentos.php">Cuotas y Descuentos</a></li>
			        <li <?php if($current_page_admin == "saldos-iniciales"){ echo "class='active'"; }?>><a href="panel-saldos-iniciales.php">Carga de Saldos Iniciales</a></li>
			    </ul>
		    </li>
		<?php } ?>
		<!-- reportes -->
		    <li role="presentation" class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reportes<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li <?php if($current_page_admin == "reporte-historico-pagos"){ echo "class='active'"; }?>><a href="reporte-historico-pagos.php" >Historico de Pagos</a></li>
					<li <?php if($current_page_admin == "reporte-ingresos-egresos"){ echo "class='active'"; }?>><a href="reporte-ingresos-egresos.php" >Ingresos y Egresos Mensuales</a></li>
					<!--<li <?php if($current_page_admin == "gastos fijos"){ echo "class='active'"; }?>><a href="panel-estados-cuenta.php">Cuotas y Gastos Fijos</a></li>-->
				</ul>
			</li>
			<?php if($_SESSION['level_user'] == 1 ){?>
		    <li role="presentation" <?php if($current_page_admin == "encuestas"){ echo "class='active'"; }?>><a href="panel-encuestas.php">Encuestas </a></li>
		    <?php } ?>
		</ul>
	</div>
</div>