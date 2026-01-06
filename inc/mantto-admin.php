<br>
<div class="row">
  <div class="col-xs-4">
  <select class="form-control">
      <option value="">Enero</option>
    </select>
  </div>
  <div class="col-xs-6 text-right">
  <?php
  echo $hoy = date("F j, Y, g:i a");
    //$conmenact = mysqli_query($mysqli,"select ")
  ?>
    <a href="agregar_mensualidad.php" class="btn btn-success"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Agregar Mensualidad</a>
  </div>
</div><br>
<table class="table">
<thead>
<tr><th>Nombre</th><th>No. Casa</th><th>Estado Actual</th></tr>
</thead>
<?php
            $consulta_usuarios = mysqli_query($mysqli,"select * from user where level=0 order by no_casa;") or die(mysqli_error($mysqli));

            while($arr_usuarios = mysqli_fetch_array($consulta_usuarios)){ 
            	
            	$conocer_estado_mantto = mysqli_query($mysqli,"select * from mantto where id_user=$arr_usuarios[0];") or die(mysqli_error($mysqli));
            	if(mysqli_num_rows($conocer_estado_mantto)>0){
            		$row_mantto=mysqli_fetch_array($conocer_estado_mantto);
            		if($row_mantto[2] == 0){
						echo "<tr class='danger'><td>$arr_usuarios[2]</td><td>$arr_usuarios[4]</td><td><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='hidden' name='oper' value='upd'><input type='checkbox' name='stat' aria-label='...' onchange='this.form.submit()'> No Pagado</form></td></tr>";
              		}else{
              			echo "<tr class='success'><td>$arr_usuarios[2]</td><td>$arr_usuarios[4]</td><td><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='oper' value='upd'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='checkbox' name='stat' aria-label='...' checked onchange='this.form.submit()'> Pagado</form></td></tr>";
              		}
               	}else{
              		echo "<tr class='danger'><td>$arr_usuarios[2]</td><td>$arr_usuarios[4]</td><td><form id='cambiarvalor$arr_usuarios[0]' method='post' action='_mantto.php'><input type='hidden' name='oper' value='ins'><input type='hidden' name='user' value='$arr_usuarios[0]'><input type='checkbox' name='stat' aria-label='...' onchange='this.form.submit()'> No Registrado</td></form></tr>";
              	}
            } 

          ?>
</table>