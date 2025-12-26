<br>
<button class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva Notificacion</button>
<table class="table">
<thead>
<tr><th>Titulo</th><th>Descripcion</th><th>Fecha</th><th>Hora</th><th>Autor</th></tr>
</thead>
<?php
            /*$consulta_noti = mysql_query("SELECT id_noti,titulo,texto,fecha,noti.id_user,hora,user.nombre FROM noti inner join user on user.id_user=noti.id_user;",$link) or die(mysql_error());
            while($arr_usuarios = mysql_fetch_array($consulta_noti)){ 
            	echo "<tr><td></td></tr>";
            } 
*/	
          ?>
</table>