<?php
	session_start();
  
  include('configPHP/config.inc.php');
  
  
  date_default_timezone_set('America/Mexico_City');

  //Conocer Mes Actual
  $mes=date("F");
  if ($mes=="January") $mes="Enero";
  if ($mes=="February") $mes="Febrero";
  if ($mes=="March") $mes="Marzo";
  if ($mes=="April") $mes="Abril";
  if ($mes=="May") $mes="Mayo";
  if ($mes=="June") $mes="Junio";
  if ($mes=="July") $mes="Julio";
  if ($mes=="August") $mes="Agosto";
  if ($mes=="September") $mes="Setiembre";
  if ($mes=="October") $mes="Octubre";
  if ($mes=="November") $mes="Noviembre";
  if ($mes=="December") $mes="Diciembre";
  $ano=date("Y");

  //Recibir Datos de Usuario
  $id_usuario = $_GET['i'];
  $conocerPagosRealizados = "select * from mensualidades where id_user=$id_usuario;";
  $despliegaMensualidades = mysqli_query($conocerPagosRealizados,$link) or die(mysqli_error($mysqliConn));
  $numPagos = mysqli_num_rows($despliegaMensualidades);
?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Pablo Cortes Arzaluz">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <title>Ver Meses Pagados</title>
  <link href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" rel="stylesheet" type="text/css" />
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
  <script type='text/javascript'></script>
<script>

  $(document).ready(function(){
    $("#ok").ready(function(){
      $("#ok").removeClass("ui-btn ui-link ui-shadow ui-corner-all");
      $("#load").removeClass("ui-btn ui-link ui-shadow ui-corner-all");
      $("#listado").removeClass("ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow ui-focus");

    });
  });
  </script>
  <script type="text/javascript">
  function saludo(){
    document.getElementById.("guarda").submit();
  }</script>
  <script>
(function ($, window, document, undefined) {
    $.widget("mobile.mmp", $.mobile.widget, {
        options:{
            text:'Multiple Month Picker',
            theme:'a',
            id:'mmp',
      months: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      value: []
        },
    value: function (value) {
      if ( value === undefined ) {
        return this.options.value;
      }
   
      this.options.value = value;
      this._values = ',' + value.join(',') + ',';
      this._check();
    },
    _currentYear: (new Date()).getFullYear(),
    _values : ',',
    _check: function() {
      var that = this;
      this.element.find('input').each(function() {
        if(that._values.indexOf(',' + $(this).val() + ',') >= 0) {
          $(this).prop('checked', true).checkboxradio('refresh');
        } else {
          $(this).prop('checked', false).checkboxradio('refresh');
        }
      });
    },
        _create:function () {
            this.element.css('text-align', 'center');
      
      this.element.append('<div id="mmp-header" data-role="controlgroup" data-type="horizontal"></div>');
      this.element.children('div').append('<button id="btnPreviousYear" data-iconpos="notext" data-icon="arrow-l">Previous year</button>');
      this.element.children('div').append('<button id="yearLabel" style="width: 150px;">' + this._currentYear + '</button>');
      this.element.children('div').append('<button id="btnNextYear" data-iconpos="notext" data-icon="arrow-r">Next year</button>');
      
      for(var i=0; i<4; i++) {
        this.element.append('<fieldset id="mmp-months-row-' + i + '" data-role="controlgroup" data-type="horizontal"></fieldset>');
        for(var j=0; j<3; j++) {
          var month = this._currentYear + '-' + this._zeros(1 + j + 3*i, 2);
          this.element.find('#mmp-months-row-' + i).append('<input type="checkbox" name="' + month + '" id="' + month + '" value="' + month + '" data-wrapper-class="mmp-month" />');
          this.element.find('#mmp-months-row-' + i).append('<label for="' + month + '" style="width: text-align: center;">' + this.options.months[j + 3*i] + '</label>');
        }
      }
      
      $('<style>.mmp-month { width: 100px; }</style>').appendTo('head');
      $('<style>.mmp-month > label { text-align: center; }</style>').appendTo('head');
      
      $('body').trigger('create');
      
      var that = this;
      
      this.element.find('#btnPreviousYear').click(function() {
        that._currentYear--;
        that.element.html('');
        that._create();
          $("#ok").ready(function(){
           $("#ok").removeClass("ui-btn ui-link ui-shadow ui-corner-all");
          });
          $("#load").ready(function(){
           $("#load").removeClass("ui-btn ui-link ui-shadow ui-corner-all");
          });
          $("#listado").ready(function(){
           $("#listado").removeClass("ui-btn ui-link ui-shadow ui-corner-all");
          });
        });
      
      this.element.find('#btnNextYear').click(function() {
        that._currentYear++;
        that.element.html('');
        that._create();
        $("#ok").ready(function(){
    $("#ok").removeClass("ui-btn ui-link ui-shadow ui-corner-all");
  });
  $("#load").ready(function(){
    $("#load").removeClass("ui-btn ui-link ui-shadow ui-corner-all");
  });
      });
      
      this.element.children('fieldset').find('label').css('text-align', 'center');
      this.element.children('fieldset').find('input').click(function() {
        var value = $(this).val();
        if($(this).is(':checked')) {
          if(that._values.indexOf(',' + value + ',') < 0) {
            that._values += value + ',';
          }
        } else {
          if(that._values.indexOf(',' + value + ',') >= 0) {
            that._values = that._values.replace(',' + value + ',', ',');
          }
        }
        if(that._values == ',') {
          that.options.value = [];
        } else {
          that.options.value = that._values.substring(1, that._values.length - 1).split(',');
          that.options.value.sort();
        }
      });
      
      this._check();
        },
    _zeros: function(text, size) {
      var temp = text + '';
      while(temp.length < size) {
        temp = '0' + temp;
      }
      return temp;
    }
    });
})(jQuery, window, document);
  </script>
  <script>
  $(document).ready(function() {
    $('#mmp').mmp();

    $('#ok').click(function () {
      //alert($('#mmp').mmp('value'));
      document.getElementById("inptMeses").value= $('#mmp').mmp('value');
      document.getElementById("guarda").submit();
    });

    $('#load').ready(function () {
    <?php
    if(mysqli_num_rows($despliegaMensualidades)>0){
        if(mysqli_num_rows($despliegaMensualidades) == 1){
          $arrMensualidades = mysqli_fetch_row($despliegaMensualidades);
          $date = strtotime("$arrMensualidades[2]");
          date("Y", $date); // Year (2003)
          date("m", $date); // Month (12)
          echo "$('#mmp').mmp('value', ['".date("Y", $date)."-".date("m", $date)."']);";
        }else{
          $fechas = "";
          $counter = 0;
          while($arrMensualidades = mysqli_fetch_array($despliegaMensualidades)){ 
            $date = strtotime("$arrMensualidades[2]");
            date("Y", $date); // Year (2003)
            date("m", $date); // Month (12)
            $fechas = $fechas."'".date("Y", $date)."-".date("m", $date)."'";
            $counter ++;
            if($counter != $numPagos){
              $fechas = $fechas." , ";
            }
            /*"$('#mmp').mmp('value', ['".date("Y", $date)."-".date("m", $date)."', '2015-05', '2015-08']);";*/
         }
         echo $fechasCompletas = "$('#mmp').mmp('value', [".$fechas."]);";
        }
  }
  ?>
      
    });
  });


  </script>
</head>
<body>  
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div id="mmp" ></div>

      </div>
      <br>
      
    </div>
    <div class="row">
      <div class="col-xs-12 text-center">
      <!--<a href="#" class="" id="load">Load</a>-->
        <br><form data-ajax="false" id="guarda" action="guardaMesesPagados.php" method="POST" name="guarda">
        <button type="button" id="ok" class="btn btn-success btn-xs">Guardar Registros</button>
        <button type="button" id="load" class="btn btn-danger btn-xs" onclick="location.href='panel-estatus-mantenimiento.php'" >Cancelar</button>
        <input type="hidden" id="inptMeses"name="meses">
        <input type="hidden" id="inptUsuario"name="usuario" value="<?php echo $id_usuario; ?>">
        </form>
        
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-8 col-xs-offset-2 col-sm-6  col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-2 col-lg-offset-5 text-center">
        <h4 class="text-center">Historial</h4>
        <div class="divScroll" style="overflow:scroll; height:180px; width:200px;">
         <?php 
         $fechas1 = "";
          $conocerPagosold = mysqli_query($mysqliConn,"select * from mensualidades where id_user=$id_usuario order by fecha desc;") or die(mysqli_error($mysqliConn));
          while($arrayMonths = mysqli_fetch_array($conocerPagosold)){ 
            $date1 = strtotime("$arrayMonths[2]");
            date("Y", $date1); // Year (2003)
            date("m", $date1); // Month (12)
            $mes=date("F",$date1);
            if ($mes=="January") $mes="Enero";
            if ($mes=="February") $mes="Febrero";
            if ($mes=="March") $mes="Marzo";
            if ($mes=="April") $mes="Abril";
            if ($mes=="May") $mes="Mayo";
            if ($mes=="June") $mes="Junio";
            if ($mes=="July") $mes="Julio";
            if ($mes=="August") $mes="Agosto";
            if ($mes=="September") $mes="Septiembre";
            if ($mes=="October") $mes="Octubre";
            if ($mes=="November") $mes="Noviembre";
            if ($mes=="December") $mes="Diciembre";
            //echo  $fechas1."".date("Y", $date1)."-".date("m", $date1)."<br>";
            echo $mes." - ".date("Y", $date1)."<br>";
         }
         ?>
        </div>
      </div>
    </div>
  </div>
 </body>
 </html>

  