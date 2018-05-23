<?php

include 'conexion.php';

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

try
{
	$sql = "INSERT INTO `trabajador` (dni, nombre, apellidos, fecha_nacimiento, telefono, seguridad_social, tipo_contrato, inicio_contrato, fin_contrato, id_tienda, observaciones) VALUES ('$dni_trabajador', '$nombre_trabajador', '$apellidos_trabajador', '$fecha_nacimFinal', '$telefono_trabajador', '$ssocial_trabajador', '$contrato_trabajador', '$fecha_inicioFinal', '$fecha_finFinal', '$id_tienda', '$observaciones_trabajador')";
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

mysqli_close($conexionCentral);
?>