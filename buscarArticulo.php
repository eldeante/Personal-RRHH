<?php
include 'conexion.php';

$contador=0;
$nombre_trabajador = $_POST['nombre_trabajador'];

try
{
	$sql = "SELECT dni, nombre, apellidos, fecha_nacimiento, telefono, seguridad_social, tipo_contrato, inicio_contrato, fin_contrato, id_tienda, observaciones FROM `trabajador` WHERE activo=1";
	$result = mysqli_query($conexionCentral,$sql);
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

//header("Location: index.php");
?>
<table class="table table-condensed" id="example2">
      <thead>
        <tr>
          <th width="10%">Id</th>
          <th>DNI</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Nacimiento</th>
          <th>Teléfono</th>
          <th>SSocial</th>
          <th>Contrato</th>
          <th>Inicio</th>
		  <th>Fin</th>
		  <th>Ubicación</th>		  
		  <th>Observaciones</th>
		  <th>Acciones</th>           
        </tr>
      </thead>
      <tbody>
        <?php
          while($row = mysqli_fetch_array($result)) {
				$contador++;
				
				//Obtenemos el nombre de la tienda a partir del id_tienda
				try
				{
					$sql = "SELECT nombre FROM `tienda` WHERE id_tienda='".$row[9]."'";
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
				echo "<td scope='row' id='idtrabajador".$contador."'>$contador</td>" ;			
				echo "<td id='dnitrabajador".$contador."'>$row[0]</td>" ;
				echo "<td id='nombretrabajador".$contador."'>$row[1]</td>" ;
				echo "<td id='apellidostrabajador".$contador."'>$row[2]</td>" ;
				echo "<td id='nacimientotrabajador".$contador."'>$row[3]</td>" ;
				echo "<td id='telefonotrabajador".$contador."'>$row[4]</td>" ;
				echo "<td id='ssocialtrabajador".$contador."'>$row[5]</td>" ;
				echo "<td id='contratotrabajador".$contador."'>$row[6]</td>" ;
				echo "<td id='iniciotrabajador".$contador."'>$row[7]</td>" ;
				echo "<td id='fintrabajador".$contador."'>$row[8]</td>" ;
				echo "<td id='idtienda".$contador."'>$nombre_tienda[0]</td>" ;				
				echo "<td id='observacionestrabajador".$contador."'>$row[10]</td>" ;				
				echo "<td><button type='button' class='btn btn-default btn-xs' onclick='editTrabajador(".$contador.")'>Editar</button><button type='button' class='btn btn-default btn-xs' onclick='deleteTrabajador(".$contador.",&#39;$row[0]&#39;)'>Deshabilitar</button></td>";
				echo "</tr>";
          }
        ?>
      </tbody>
      <tfoot>
		 <th width="10%">Id</th>      
          <th>DNI</th>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>Nacimiento</th>
          <th>Teléfono</th>
          <th>SSocial</th>
          <th>Contrato</th>
          <th>Inicio</th>
		  <th>Fin</th>
		  <th>Ubicación</th>		  
		  <th>Observaciones</th>
		  <th>Acciones</th>           
      </tfoot>
    </table>
<script type="text/javascript">
      $(function () {
        $("#example2").dataTable({
	         "bSort": false,
           "bFilter": false
	       } );
      });
</script>
<?php
mysqli_close($conexionCentral);
?>