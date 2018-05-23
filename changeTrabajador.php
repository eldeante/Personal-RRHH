<?php

include 'conexion.php';

$identificador_trabajador=$_POST['identificador_trabajador'];
$dni_trabajador=$_POST['dni_trabajador'];
$nombre_trabajador=$_POST['nombre_trabajador'];
$apellidos_trabajador=$_POST['apellidos_trabajador']; 
$nacimiento_trabajador=$_POST['nacimiento_trabajador']; 
$telefono_trabajador=$_POST['telefono_trabajador']; 
$ssocial_trabajador=$_POST['ssocial_trabajador']; 
$contrato_trabajador=$_POST['contrato_trabajador']; 
$inicio_trabajador=$_POST['inicio_trabajador']; 
$fin_trabajador=$_POST['fin_trabajador'];
$id_tienda=$_POST['id_tienda']; 
$observaciones_trabajador=$_POST['observaciones_trabajador']; 

//Obtenemos el id de la tienda que mandamos por POST
try
{
	$sql1 = "SELECT id_tienda FROM tienda WHERE nombre='".$id_tienda."'";
	$result1 = mysqli_query($conexionCentral,$sql1);
	$row = mysqli_fetch_array($result1);
}

catch(Exception $e)
{
	//Generamos un log
	$hoy = date("Y-m-d H:i");
	$file = fopen("logs/logs.txt","a");
	fwrite($file, "**********************************************************************************************************************"."\r\n");						  	fwrite($file, "Log generado el : " .$hoy."\r\n");  
	fwrite($file, "Se ha realizado con éxito la consulta: " .$sql1."\r\n");
	fwrite($file, "Mensaje de error: " .$e->getMessage()."\r\n");			  
	fwrite($file, "**********************************************************************************************************************"."\r\n");						
	fclose($file);
}

//Cambiamos el formato de los campos fecha
$fecha_inicio=$inicio_trabajador;
$fecha_fin=$fin_trabajador;
$fecha_nacim=$nacimiento_trabajador;
				
list($día, $mes, $anio ) = split('[/.-]', $fecha_inicio);
list($día1, $mes1, $anio1 ) = split('[/.-]', $fecha_fin);
list($día2, $mes2, $anio2 ) = split('[/.-]', $fecha_nacim);				
$fecha_inicioFinal=$anio."-".$mes."-".$día;
$fecha_finFinal=$anio1."-".$mes1."-".$día1;
$fecha_nacimFinal=$anio2."-".$mes2."-".$día2;
				
//Actualizamos los datos del trabajador
try
{
	$sql = "UPDATE trabajador SET dni='".$dni_trabajador."', nombre='".$nombre_trabajador."', apellidos='".$apellidos_trabajador."', fecha_nacimiento='".$fecha_nacimFinal."', telefono='".$telefono_trabajador."',  seguridad_social='".$ssocial_trabajador."', tipo_contrato='".$contrato_trabajador."', inicio_contrato='".$fecha_inicioFinal."', fin_contrato='".$fecha_finFinal."', id_tienda='".$row[0]."', observaciones='".$observaciones_trabajador."' WHERE id_trab='".$identificador_trabajador."'";
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


//Obtenemos el nombre de la tienda del nuevo id
try
{
	$sql2 = "SELECT nombre FROM tienda WHERE id_tienda='".$row[0]."'";
	$result2 = mysqli_query($conexionCentral,$sql2);
	$row2 = mysqli_fetch_array($result2);
}

catch(Exception $e)
{
	//Generamos un log
	$hoy = date("Y-m-d H:i");
	$file = fopen("logs/logs.txt","a");
	fwrite($file, "**********************************************************************************************************************"."\r\n");						  	fwrite($file, "Log generado el : " .$hoy."\r\n");  
	fwrite($file, "Se ha realizado con éxito la consulta: " .$sql2."\r\n");
	fwrite($file, "Mensaje de error: " .$e->getMessage()."\r\n");			  
	fwrite($file, "**********************************************************************************************************************"."\r\n");						
	fclose($file);
}

echo "<td id='tiendatrab".$identificador_trabajador."'>".$row2[0]."</td>";

//header("Location: index.php");

mysqli_close($conexionCentral);
?>