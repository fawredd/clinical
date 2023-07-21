<?php
include 'session.php';
include 'conexion.php';
include 'funciones.php';

parse_str(decryptLink(),$query_params);extract($query_params);
if(empty($check)){
	$_SESSION['mensaje']= "ACCESO RESTRINGIDO";
	$_SESSION['url']= "logout.php";
	header('Location: mensaje.php',true,303);
	exit;
}

$sql = "SELECT * FROM mm_pacientes WHERE id=".$id;
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($result->num_rows > 0) {   
	$sql = "DELETE FROM mm_pacientes WHERE id=".$id;
		if($result = $conexion->query($sql)){
			$mensajes[] = "Paciente eliminado.";
		}else{
			$mensajes[] = "No se puede eliminar el paciente por tener evoluciones cargadas en la historia clínica";
		}
}else{
	$mensajes[] = "Error. Paciente no encontrado.";
}

foreach ($mensajes as $mensaje){
	$_SESSION['mensaje'] = $mensaje;
}
mysqli_close($conexion);

$_SESSION['url']= "form_listado_pacientes.php";
header('Location: mensaje.php',true,303);
exit;
?>
