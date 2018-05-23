<?php

include 'conexion.php';

$identificador_trabajador=$_POST['identificador_trabajador'];  
$id_tienda=$_POST['id_tienda'];  

//header("Location: index.php");

//Tiendas
try
{
	$sql = "SELECT id_tienda,nombre FROM tienda WHERE activo=1";
	$result = mysqli_query($conexionCentral,$sql);
	$row = mysqli_fetch_array($result);
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
	
mysqli_close($conexionCentral);

//Combobox Tiendas
echo "<td id='tiendatrab".$identificador_trabajador."'><select type='text' class='form-control input-sm' id='tiendatrabSelect".$identificador_trabajador."'>";
echo "<option value='-1'>".$id_tienda."</option>";
while($row = mysqli_fetch_array($result)) {
  echo "<option value='$row[0]'>$row[1]</option>";
}
echo "</select></td>";
?>