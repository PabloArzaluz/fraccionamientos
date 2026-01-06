<?php
	//conocer nombre
   $knowNameSite = mysqli_query($mysqli,"select * from config_site;") or die(mysqli_error($mysqli));
   $f_ConfigSite = mysqli_fetch_row($knowNameSite);

   $_SESSION['nombre-sitio'] = $f_ConfigSite[1];

   date_default_timezone_set('America/Mexico_City');

?>
