<div class="row">
  <div class="col-xs-12">
    <ul class="nav nav-pills" role="tablist">
      <li role="presentation" <?php if($current_page_admin == "avisos"){ echo "class='active'"; }?>><a href="panel-avisos.php">Avisos</a></li>
      <li role="presentation" <?php if($current_page_admin == "mantto"){ echo "class='active'"; }?>><a href="panel-estatus-mantenimiento.php">Estatus Mantenimiento</a></li>
      <li role="presentation" <?php if($current_page_admin == "comprobantes"){ echo "class='active'"; }?>><a href="panel-comprobantes-gastos.php">Comprobantes de Gastos </a></li>
      <li role="presentation" <?php if($current_page_admin == "qys"){ echo "class='active'"; }?>><a href="panel-quejas-sugerencias.php">Quejas y Sugerencias </a></li>
      <li role="presentation" <?php if($current_page_admin == "presupuestos"){ echo "class='active'"; }?>><a href="panel-presupuestos.php">Presupuestos </a></li>
      <?php if($_SESSION['level_user'] == 1 ){?>
      <li role="presentation" <?php if($current_page_admin == "usuarios"){ echo "class='active'"; }?>><a href="panel-usuarios.php">Usuarios </a></li>
      <?php } ?>
    </ul>
  </div>
</div>