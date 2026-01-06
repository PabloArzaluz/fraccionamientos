<br><a href="oper_user.php?oper=add"><button class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Usuario</button></a><br><br>
      <div class="table-responsive">
      <table class="table table-bordered table-condensed table-responsive">
        <thead>
          <tr><th>Usuario</th><th>Nombre Completo</th><th>Contraseña</th><th>No. Casa</th><th>Nivel</th><th>Acciones</th></tr>
        </thead>
        <tbody>
          <?php
            $consulta_usuarios = mysqli_query($mysqli,"select id_user,user_login,nombre,password,no_casa,level from user order by user_login;") or die(mysqli_error($mysqli));
            while($arr_usuarios = mysqli_fetch_array($consulta_usuarios)){ 
              echo "<tr><td>$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td>$arr_usuarios[3]</td><td>$arr_usuarios[4]</td><td>$arr_usuarios[5]</td><td class='text-center'><div class='btn-group' role='group' aria-label='...'>
  <a href='oper_user.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Editar</a></div></td></tr>";
            } 
          ?>
        </tbody>
      </table>
      </div>