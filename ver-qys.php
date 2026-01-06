<?php
	session_start();
  include('configPHP/conecta.inc.php');
  include('configPHP/config.inc.php');
  ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
  
  $actual_page = "ver-qys";
  date_default_timezone_set('America/Mexico_City');
  include("inc/config-site.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Quejas y Sugerencias :: <?php echo $_SESSION['nombre-sitio']; ?></title>
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php 
    include("inc/nav-common.php")
  ?>
<?php
  $idqys= $_GET['id']; 
  $conocerDatosQyS = "select qys.id_qys,titulo,descripcion,qys.id_user,nombre, no_casa, fecha, hora,img from qys inner join user on qys.id_user = user.id_user where id_qys=".$_GET['id'].";";
  $iny_conocer_Datos_QYS = mysqli_query($mysqli,$conocerDatosQyS,$link) or die (mysqli_error($mysqli));
  $fdatoqys = mysqli_fetch_row($iny_conocer_Datos_QYS);
?>
 <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <ol class="breadcrumb">
          <li><a href="index.php"><?php echo $_SESSION['nombre-sitio']; ?></a></li>
          <li><a href="quejas-sugerencias.php">Quejas y Sugerencias</a></li>
          <li class="active"><?php echo $fdatoqys[1]; ?></li>
        </ol>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="panel panel-primary">
        <div class="panel-heading"><h4 class="panel-title" id="sin-salto-h"><?php echo $fdatoqys[1]; ?></h4></div>
  <div class="panel-body">
    <?php
     
      if($fdatoqys[8] == ""){
         echo $fdatoqys[2];
       }else{
        echo "$fdatoqys[2] <br><br><a href='Files/qys/".$fdatoqys[8]."' target='_blank'><img class='img-responsive' src='Files/qys/".$fdatoqys[8]."'' width='400px'></a>";
       }

      
  ?>
  </div>
  <div class='panel-footer text-right'>
  <span>Escrito por <strong><?php echo $fdatoqys[4]." [#".$fdatoqys[5]."]"; ?></strong> el 
  <?php 
    $date = new DateTime($fdatoqys[6]); 
    echo date_format($date, 'd/m/Y');
    echo " a las ".$fdatoqys[7];
    ?></span>
  </div>
  
</div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class='row'>
          <div class='col-xs-12'>
            <?php 
              if(isset($_GET['info'])){
                if($_GET['info'] == 1){
                  echo "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>Se agrego correctamente el comentario</div>";
                }
              }
             ?>
          </div>
        </div>
      </div>
    </div>
     <div class="row">
      <div class="col-xs-12">
        <div class='row'>
          <div class='col-xs-12'>
            <div class="panel panel-default">
              <div class="panel-body">
                <form name="comentario-qys" action="_oper_publicar_comentario_qys.php?id=<?php echo $idqys; ?>" method="POST">
                <textarea style="width:100%" required name="comentario"></textarea>
              </div>
              <div class="panel-footer"><button type="submit" class="btn btn-success">Publicar Comentario</button></div>
              <form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <?php
          $conocer_comentarios = "SELECT id_qys_reply,comentario,qys_reply.id_qys,qys_reply.fecha,qys_reply.hora,qys_reply.id_user,user.nombre,no_casa FROM qys_reply inner join qys on qys.id_qys = qys_reply.id_qys inner join user on qys.id_user = user.id_user where qys_reply.id_qys = $idqys order by fecha desc, hora desc;";
          $consulta_comentarios = mysqli_query($mysqli,$conocer_comentarios) or die(mysqli_error($mysqli));
            while($arr_comentarios = mysqli_fetch_array($consulta_comentarios)){ 
              echo "<div class='row'>
                      <div class='col-xs-12'>
                        <div class='panel panel-info'>";
                          
                          echo "<div class='panel-body'>
                                  $arr_comentarios[1]
                                  </div>";
                          echo "<div class='panel-footer text-right'>";
                            echo "Escrito por: <b>".$arr_comentarios[6]." [#$arr_comentarios[7]]</b> el ";
                            $date = date_create($arr_comentarios[3]);
                            echo date_format($date, 'd/m/Y');
                            echo " a las ";
                            echo $arr_comentarios[4];
                          echo "</div>";
                        echo "</div>
                          </div>
                        </div>";
              /*echo "$arr_usuarios[1]</td><td>$arr_usuarios[2]</td><td>$arr_usuarios[3]</td><td>$arr_usuarios[5]</td><td>$arr_usuarios[6]</td><td class='text-center'><div class='btn-group' role='group' aria-label='...'>
                <a href='oper_user.php?oper=edit&i=$arr_usuarios[0]' class='btn btn-success btn-xs'>Editar</a></div></td></tr>";*/

            }  
          ?>
      </div>
    </div>
  </div>
  

		<?php 
			include("inc/footer-common.php");
		 ?>
    </body>
</html>
