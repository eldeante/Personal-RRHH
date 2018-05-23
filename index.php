<?php 

include 'conexion.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Personal Tiendas Kira</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
     <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

	<link type="text/css" rel="stylesheet" href="css/autocomplete.css"></link>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- *********************************************FUNCIONES PARA AÑADIR, EDITAR Y ELIMINAR******************************************************************** -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

    <!-- AUTOCOMPLETE -->    
    <!-- <script src="js/jquery-1.4.2.min.js"></script> -->
    <script src="js/autocomplete.jquery.js"></script> 
    
	<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
		$("#tableExTrabajadores").dataTable();		
      });
	  	  
    </script>

    <script type="text/javascript">
      
	  $(document).ready(function() {
        
		$('.autocomplete').autocomplete();

		//Buscador	
	  	$('#ipad').keyup(function(){
        //Obtenemos el value del input
        var nombre = $(this).val();        
        var dataString = nombre;
			
		var parametros = {
        "nombre_trabajador"   : dataString                                                     
        };
		
        //Le pasamos el valor del input al ajax
        $.ajax({
				type: "post",
				url: "buscarArticulo.php",
				data: parametros,
				success: function(response)
				{
					$("#tablaArticulos").html(response).show();
					$('#tablaArticulos').css('display','block');
				}			
            });
        });              
      });    

	  <!-- TRABAJADOR -->
	  
	  function addTrabajador(){
          
		  //Comprobamos que los campos no estén vacios
		  //if( ($('#nombre_trabajador').val()=="") || ($('#apellidos_trabajador').val()=="") || ($('#dni_trabajador').val()=="") || ($('#contrato_trabajador').val()=="") || ($('#fechaNacimiento_trabajador').val()=="") || ($('#telefono_trabajador').val()=="") || ($('#seguridadSocial_trabajador').val()=="") || ($('#inicio_trabajador').val()=="") || ($('#fin_trabajador').val()==""))
		  //{
			  //alert ("NO PUEDE HABER CAMPOS VACÍOS");
		  //}	

		  //else
		  //{
				var parametros = {
				"identificador_trabajador"  : $('#identificador_trabajador').val(),
				"dni_trabajador"   : $('#dni_trabajador').val(),
				"nombre_trabajador"         : $('#nombre_trabajador').val(),
				"apellidos_trabajador"      : $('#apellidos_trabajador').val(),
				"nacimiento_trabajador"      : $('#fechaNacimiento_trabajador').val(),				
				"telefono_trabajador"      : $('#telefono_trabajador').val(),
				"ssocial_trabajador"      : $('#seguridadSocial_trabajador').val(),				
				"contrato_trabajador"      : $('#contrato_trabajador').val(),
				"inicio_trabajador"      : $('#inicio_trabajador').val(),
				"fin_trabajador"      : $('#fin_trabajador').val(),
				"id_tienda"      : $('#id_tienda').val(),				
				"observaciones_trabajador"      : $('#observaciones_trabajador').val(),				
			  };
			
			  $.ajax({
				data:  parametros,
				url:   'addTrabajador.php',
				type:  'post',
				
				success:  function (response) {
				  document.location.href = 'index.php';
			  }
			  });  
		  //}
        }
		
		function editTrabajador(t){
        var fila = '#trabajador'+t;
        var idtrab = $('#idtrabajador'+t).html();
        var dnitrab = $('#dnitrabajador'+t).html();		
        var nomtrab = $('#nombretrabajador'+t).html();
        var apetrab = $('#apellidostrabajador'+t).html();
        var nacimientotrab = $('#nacimientotrabajador'+t).html();
        var telftrab = $('#telefonotrabajador'+t).html();
        var sstrab = $('#ssocialtrabajador'+t).html();
        var conttrab = $('#contratotrabajador'+t).html();
        var initrab = $('#iniciotrabajador'+t).html();
        var fintrab = $('#fintrabajador'+t).html();
        var tiendatrab = $('#idtienda'+t).html();
        var obsvaciontrab = $('#observacionestrabajador'+t).html();        
		
		
		var parametros = {
				"identificador_trabajador"  : t,
			    "id_tienda"  : tiendatrab,
		};
		  
			$.ajax({
            data:  parametros,
            url:   'editTrabajador.php',
            type:  'post',
            
            success:  function (response) {
			var result = "<td scope='row' id='idtrab"+t+"'><input size='10' type='text' class='form-control input-sm' id='idtrabInput"+t+"' value='"+idtrab+"' width='50' disabled></td>" 
				+ "<td id='dnitrab"+t+"'><input type='text' class='form-control input-sm' id='dnitrabInput"+t+"' value='"+dnitrab+"'></td>"				
				+ "<td id='nomtrab"+t+"'><input type='text' class='form-control input-sm' id='nomtrabInput"+t+"' value='"+nomtrab+"'></td>"
				+ "<td id='apetrab"+t+"'><input type='text' class='form-control input-sm' id='apetrabInput"+t+"' value='"+apetrab+"'></td>"			
				+ "<td id='nacimientotrab"+t+"'><input type='text' class='form-control input-sm' id='nacimientotrabInput"+t+"' value='"+nacimientotrab+"'></td>"			
				+ "<td id='telftrab"+t+"'><input type='text' class='form-control input-sm' id='telftrabInput"+t+"' value='"+telftrab+"'></td>"
				+ "<td id='sstrab"+t+"'><input type='text' class='form-control input-sm' id='sstrabInput"+t+"' value='"+sstrab+"'></td>"			
				+ "<td id='conttrab"+t+"'><input type='text' class='form-control input-sm' id='conttrabInput"+t+"' value='"+conttrab+"'></td>"
				+ "<td id='initrab"+t+"'><input type='text' class='form-control input-sm' id='initrabInput"+t+"' value='"+initrab+"'></td>"
				+ "<td id='fintrab"+t+"'><input type='text' class='form-control input-sm' id='fintrabInput"+t+"' value='"+fintrab+"'></td>"				
				+ response
				+ "<td id='obsvaciontrab"+t+"'><input type='text' class='form-control input-sm' id='obsvaciontrabInput"+t+"' value='"+obsvaciontrab+"'></td>"			
				+ "<td><button type='button' class='btn btn-default btn-xs' onclick='changeTrabajador("+t+")'>Guardar</button></td>" ;				
			  $(fila).html(result);
			  $(fila).show();				  
          }
          });		  			        			
      }
	  
	    function changeTrabajador(t){
        var fila = '#trabajador'+t;
        var idtrab = $('#idtrabInput'+t).val();
        var dnitrab = $('#dnitrabInput'+t).val();		
        var nomtrab = $('#nomtrabInput'+t).val();
        var apetrab = $('#apetrabInput'+t).val();
        var nacimientotrab = $('#nacimientotrabInput'+t).val();
        var telftrab = $('#telftrabInput'+t).val();
        var sstrab = $('#sstrabInput'+t).val();
        var conttrab = $('#conttrabInput'+t).val();
        var initrab = $('#initrabInput'+t).val();
        var fintrab = $('#fintrabInput'+t).val();
        var tiendatrab = $('#tiendatrabSelect'+t+' option:selected').html();
        var obsvaciontrab = $('#obsvaciontrabInput'+t).val();
		
        var parametros = {
            "identificador_trabajador"   : idtrab,
            "dni_trabajador" : dnitrab,			
            "nombre_trabajador" : nomtrab,
            "apellidos_trabajador"       : apetrab,
			"nacimiento_trabajador"      : nacimientotrab,				
			"telefono_trabajador"      : telftrab,
			"ssocial_trabajador"      : sstrab,				
			"contrato_trabajador"      : conttrab,
			"inicio_trabajador"      : initrab,
			"fin_trabajador"      : fintrab,
			"id_tienda"      : tiendatrab,				
			"observaciones_trabajador"      : obsvaciontrab			
          };
                               
          $.ajax({
            data:  parametros,
            url:   'changeTrabajador.php',
            type:  'post',
            
            success:  function (response) {
              var result = "<td scope='row' id='idtrab"+t+"'>"+idtrab+"</td>"             
			+ "<td id='dnitrab"+t+"'>"+dnitrab+"</td>"
			+ "<td id='nomtrab"+t+"'>"+nomtrab+"</td>"
            + "<td id='apetrab"+t+"'>"+apetrab+"</td>"
            + "<td id='nacimientotrab"+t+"'>"+nacimientotrab+"</td>"
            + "<td id='telftrab"+t+"'>"+telftrab+"</td>"
            + "<td id='sstrab"+t+"'>"+sstrab+"</td>"
            + "<td id='conttrab"+t+"'>"+conttrab+"</td>"
            + "<td id='initrab"+t+"'>"+initrab+"</td>"
            + "<td id='fintrab"+t+"'>"+fintrab+"</td>"
            + response
            + "<td id='obsvaciontrab"+t+"'>"+obsvaciontrab+"</td>"									
            + "<td><button type='button' class='btn btn-default btn-xs' onclick='editTrabajador("+t+")'>Editar</button><button type='button' class='btn btn-default btn-xs'  onclick='deleteTrabajador("+t+","+idtrab+")'>Deshabilitar</button></td>" ;
			
			$(fila).html(result).show();
			document.location.href = 'index.php';			
			}
          });    
      }	  
		
	  function deleteTrabajador(t,id){
        var fila = '#trabajador'+t;
		
        var parametros = {
            "identificador_trabajador"   : t, 
            "id_trabajador"   : id,			
          };
                               
          $.ajax({
            data:  parametros,
            url:   'deleteTrabajador.php',
            type:  'post',
            
            success:  function (response) {
				document.location.href = 'index.php';
			}
          });    
      }

	  function updateTrabajador(t,id){
        var fila = '#trabajador'+t;
		
        var parametros = {
            "identificador_trabajador"   : t, 
            "id_trabajador"   : id,			
          };
                               
          $.ajax({
            data:  parametros,
            url:   'updateTrabajador.php',
            type:  'post',
            
            success:  function (response) {
				document.location.href = 'index.php';
			}
          });    
      }	  
	  		
	  //Funciones para los botones
      $('#seeExtrabajadores').on('hide.bs.modal', function (e) {
      window.location.reload("true");});
	
    </script> 
    
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><strong>Personal Kira</strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">                 
				<li><a href="#" data-toggle="modal" data-target="#seeExtrabajadores">ExTrabajadores</a></li>        
			</ul>	  
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <div class="row">
         <div class="col-md-3" style="margin-top: 40px">
          <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#addTrabajador">A&ntilde;adir trabajador <i class="glyphicon glyphicon-user"></i></button>
         </div>
         </div>         
        </div>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12" id="#contenido">
          <h2>Personal</h2>
          <table class="table table-condensed" id="example1">
      <thead>
        <tr>
          <th>Id</th>
          <th>DNI</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Nacimiento</th>
          <th>Teléfono</th>
          <th>SSocial</th>
          <th>Contrato</th>
          <th>Cont_Inicio</th>
		  <th>Cont_Final</th>
		  <th>Ubicación</th>		  
		  <th>Observaciones</th>
		  <th>Acciones</th>           
        </tr>
      </thead>
      <tbody>
        <?php
		  $contador=0;
          
		  try
		  {
		  	$query1 =  mysqli_query($conexionCentral, "SELECT id_trab, dni, nombre, apellidos, fecha_nacimiento, telefono, seguridad_social, tipo_contrato, inicio_contrato, fin_contrato, id_tienda, observaciones FROM `trabajador` WHERE activo=1");
			  
			  while($row = mysqli_fetch_array($query1))
			  {
				$contador++;
				
				//Obtenemos el nombre de la tienda a partir del id_tienda
				try
				{
					$sql = "SELECT nombre FROM `tienda` WHERE id_tienda='".$row[10]."'";
					$result = mysqli_query($conexionCentral,$sql);
					$nombre_tienda = mysqli_fetch_array($result);

				}

				catch(Exception $e)
				{
					//Generamos un log
					$hoy = date("Y-m-d H:i");
					$file = fopen("logs/logs.txt","a");
					fwrite($file, "**********************************************************************************************************************"."\r\n");						  	fwrite($file, "Log generado el : " .$hoy."\r\n");  
					fwrite($file, "Se ha realizado con éxito la consulta: " .$sql."\r\n");
					fwrite($file, "Mensaje de error: " .$e->getMessage()."\r\n");			  
					fwrite($file, "**********************************************************************************************************************"."\r\n");						
					fclose($file);
				}
				
				//Si la fecha de fin de contrato cumple el mes que viene ponemos la fila en rojo
				$mes_actual = date('m');
				$mes_finContrato = new DateTime(''.$row[9].'');

				if ($mes_finContrato->format('m')==$mes_actual)
				{
				  echo "<tr class='danger' id='trabajador$contador'> ";
				} 
				
				else
				{
				  echo "<tr id='trabajador$contador'> ";
				}
				
				//Cambiamos el formato de los campos fecha
				$fecha_inicio=$row[8];
				$fecha_fin=$row[9];
				$fecha_nacim=$row[4];
				
				list($anio, $mes, $día ) = split('[/.-]', $fecha_inicio);
				list($anio1, $mes1, $día1 ) = split('[/.-]', $fecha_fin);
				list($anio2, $mes2, $día2 ) = split('[/.-]', $fecha_nacim);				
				$fecha_inicioFinal=$día."/".$mes."/".$anio;
				$fecha_finFinal=$día1."/".$mes1."/".$anio1;
				$fecha_nacimFinal=$día2."/".$mes2."/".$anio2;
				
				//Creamos las filas a mostrar en la tabla
				echo "<td scope='row' id='idtrabajador".$contador."'>$row[0]</td>" ;			
				echo "<td id='dnitrabajador".$contador."'>$row[1]</td>" ;
				echo "<td id='nombretrabajador".$contador."'>$row[2]</td>" ;
				echo "<td id='apellidostrabajador".$contador."'>$row[3]</td>" ;
				echo "<td id='nacimientotrabajador".$contador."'>$fecha_nacimFinal</td>" ;
				echo "<td id='telefonotrabajador".$contador."'>$row[5]</td>" ;
				echo "<td id='ssocialtrabajador".$contador."'>$row[6]</td>" ;
				echo "<td id='contratotrabajador".$contador."'>$row[7]</td>" ;
				echo "<td id='iniciotrabajador".$contador."'>$fecha_inicioFinal</td>" ;
				echo "<td id='fintrabajador".$contador."'>$fecha_finFinal</td>" ;
				echo "<td id='idtienda".$contador."'>$nombre_tienda[0]</td>" ;				
				echo "<td id='observacionestrabajador".$contador."'>$row[11]</td>" ;				
				echo "<td><button type='button' class='btn btn-default btn-xs' onclick='editTrabajador(".$contador.")'>Editar</button><button type='button' class='btn btn-default btn-xs' onclick='deleteTrabajador(".$contador.",&#39;$row[0]&#39;)'>Deshabilitar</button></td>";
				echo "</tr>";			
			  }
		  }
		  
		  catch(Exception $e)
		  {
			  //Generamos un log
			  $hoy = date("Y-m-d H:i");
			  $file = fopen("logs/logs.txt","a");
			  fwrite($file, "**********************************************************************************************************************"."\r\n");						  			  fwrite($file, "Log generado el : " .$hoy."\r\n");  
			  fwrite($file, "Se ha realizado con éxito la consulta: " .$query1."\r\n");
			  fwrite($file, "Mensaje de error: " .$e->getMessage()."\r\n");			  
			  fwrite($file, "**********************************************************************************************************************"."\r\n");						
			  fclose($file);			  
		  }
		  
        ?>
      </tbody>
      <tfoot>
          <th>Id</th>
          <th>DNI</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Nacimiento</th>
          <th>Teléfono</th>
          <th>SSocial</th>
          <th>Contrato</th>
          <th>Cont_Inicio</th>
		  <th>Cont_Final</th>
		  <th>Ubicación</th>		  
		  <th>Observaciones</th>
		  <th>Acciones</th> 
      </tfoot>
    </table>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; kira <?= date("Y") ?></p>
      </footer>
    </div> <!-- /container -->

<!-- ***********************************************MODAL PARA LOS BOTONES************************************************************************************** -->
    
<!-- Modal TRABAJADOR-->
<div class="modal fade" id="addTrabajador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">A&ntilde;adir Trabajador <i class="glyphicon glyphicon-user"></i></h4>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
  
  <div class="form-group">
    <label for="inputDNI" class="col-sm-2 control-label">DNI</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="dni_trabajador"placeholder="DNI">
    </div>
  </div>

  <div class="form-group">
    <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nombre_trabajador"placeholder="Nombre">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputApellido" class="col-sm-2 control-label">Apellido</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="apellidos_trabajador" placeholder="Apellidos">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputFechaNacimiento" class="col-sm-2 control-label">Nacimiento</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fechaNacimiento_trabajador" placeholder="Fecha Nacimiento (DD-MM-YY)">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputTelefono" class="col-sm-2 control-label">Teléfono</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="telefono_trabajador" placeholder="Teléfono">
    </div>
  </div>

  <div class="form-group">
    <label for="inputSeguridadSocial" class="col-sm-2 control-label">SSocial</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="seguridadSocial_trabajador" placeholder="Seguridad Social">
    </div>
  </div>

  <div class="form-group">
    <label for="inputContrato" class="col-sm-2 control-label">Contrato</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="contrato_trabajador" placeholder="Tipo Contrato">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputInicio" class="col-sm-2 control-label">Inicio</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inicio_trabajador" placeholder="Inicio (DD-MM-YY)">
    </div>
  </div>

  <div class="form-group">
    <label for="inputFin" class="col-sm-2 control-label">Fin</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fin_trabajador" placeholder="Fin (DD-MM-YY)">
    </div>
  </div>

  <div class="form-group">
    <label for="selectUbicacionTrabajador" class="col-sm-2 control-label">Ubicación</label>
    <div class="col-sm-10">
      <select type="text"  class="form-control" id="id_tienda">
        <option value="-1"> Ubicación</option>
      <?php

		  try
		  {
			  $query1 =  mysqli_query($conexionCentral, "SELECT * FROM tienda WHERE activo=1");
			  
			  while($row = mysqli_fetch_array($query1))
			  {
				echo "<option value='".$row[0]."'>".$row[1]."</option>" ;
			  }
		  }
	  
	  	  catch(Exception $e)
		  {
			  //Generamos un log
			  $hoy = date("Y-m-d H:i");
			  $file = fopen("logs/logs.txt","a");
			  fwrite($file, "**********************************************************************************************************************"."\r\n");						  			  fwrite($file, "Log generado el : " .$hoy."\r\n");  
			  fwrite($file, "Se ha realizado con éxito la consulta: " .$query1."\r\n");
			  fwrite($file, "Mensaje de error: " .$e->getMessage()."\r\n");			  
			  fwrite($file, "**********************************************************************************************************************"."\r\n");						
			  fclose($file);			  
		  }
	  
        ?>
      </select>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputObservaciones" class="col-sm-2 control-label">Observación</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="observaciones_trabajador" placeholder="Observación">
    </div>
  </div>
  
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" type="submit" onclick="addTrabajador()">Guardar Trabajador</button>
      </div>
      </form>
    </div><!-- /modal-contebt -->
  </div><!-- /modal-dialog -->
</div><!-- /modal -->
</div><!-- /modal -->


<!-- ***********************************************MODAL PARA LOS MENU************************************************************************************** -->

<!-- Modal EXTRABAJADOR-->
<div class="modal fade" id="seeExtrabajadores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ExTrabajadores <i class="glyphicon glyphicon-user"></i></h4>
      </div>
      <div class="modal-body" id="bodyExTrabajadores">
      <table class="table table-condensed" id="tableExTrabajadores">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Teléfono</th>
          <th>Contrato</th>
          <th>Cont_Inicio</th>
		  <th>Cont_Final</th>
		  <th>Ubicación</th>		  
		  <th>Observaciones</th>
		  <th>Acciones</th>		  
        </tr>
      </thead>
      <tbody>
        <?php
				
		  try
		  {		  
			  $query1 =  mysqli_query($conexionCentral, "SELECT * FROM trabajador WHERE activo=0");
			  
			  while($row = mysqli_fetch_array($query1)) 
			  {				
		  
				//Obtenemos el nombre de la tienda a partir del id_tienda
				try
				{
					$sql = "SELECT nombre FROM `tienda` WHERE id_tienda='".$row[10]."'";
					$result = mysqli_query($conexionCentral,$sql);
					$nombre_tienda = mysqli_fetch_array($result);

				}

				catch(Exception $e)
				{
					//Generamos un log
					$hoy = date("Y-m-d H:i");
					$file = fopen("logs/logs.txt","a");
					fwrite($file, "**********************************************************************************************************************"."\r\n");						  	fwrite($file, "Log generado el : " .$hoy."\r\n");  
					fwrite($file, "Se ha realizado con éxito la consulta: " .$sql."\r\n");
					fwrite($file, "Mensaje de error: " .$e->getMessage()."\r\n");			  
					fwrite($file, "**********************************************************************************************************************"."\r\n");						
					fclose($file);
				}		  
		  
				//Creamos las filas a mostrar en la tabla
				echo "<tr class='danger' id='trabajador$contador'> ";
				echo "<td scope='row' id='idtrabajador".$contador."'>$row[0]</td>" ;			
				echo "<td id='nombretrabajador".$contador."'>$row[2]</td>" ;
				echo "<td id='apellidostrabajador".$contador."'>$row[3]</td>" ;
				echo "<td id='telefonotrabajador".$contador."'>$row[5]</td>" ;
				echo "<td id='contratotrabajador".$contador."'>$row[7]</td>" ;
				echo "<td id='iniciotrabajador".$contador."'>$row[8]</td>" ;
				echo "<td id='fintrabajador".$contador."'>$row[9]</td>" ;
				echo "<td id='idtienda".$contador."'>$nombre_tienda[0]</td>" ;				
				echo "<td id='observacionestrabajador".$contador."'>$row[11]</td>" ;
				echo "<td><button type='button' class='btn btn-default btn-xs' onclick='updateTrabajador(".$contador.",&#39;$row[0]&#39;)'>Dar de Alta</button></td>" ;				
				echo "</tr>";				
			  }
		  }
	  
	  	  catch(Exception $e)
		  {
			  //Generamos un log
			  $hoy = date("Y-m-d H:i");
			  $file = fopen("logs/logs.txt","a");
			  fwrite($file, "**********************************************************************************************************************"."\r\n");						  			  fwrite($file, "Log generado el : " .$hoy."\r\n");  
			  fwrite($file, "Se ha realizado con éxito la consulta: " .$query1."\r\n");
			  fwrite($file, "Mensaje de error: " .$e->getMessage()."\r\n");			  
			  fwrite($file, "**********************************************************************************************************************"."\r\n");						
			  fclose($file);
		  }
		
        ?>
      </tbody>
      <tfoot>
          <th>Id</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Teléfono</th>
          <th>Contrato</th>
          <th>Cont_Inicio</th>
		  <th>Cont_Final</th>
		  <th>Ubicación</th>		  
		  <th>Observaciones</th>
		  <th>Acciones</th>		  		  
      </tfoot>
    </table>
      </div>
      <div class="modal-footer"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /modal-contebt -->
  </div><!-- /modal-dialog -->
</div><!-- /modal -->

  </body>
</html>
