<?php
include 'session.php';
include 'conexion.php';
$sql = "SELECT * FROM mm_mensajes WHERE id=".$_GET['id'];
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($result->num_rows > 0) {   
	$sql = "DELETE FROM mm_mensajes WHERE id=".$_GET['id'];
		if($result = $conexion->query($sql)){
			$mensajes[] = "Mensajes eliminado.";
		}else{
			$mensajes[] = "Error al intentar eliminar mensaje. ERROR: " . $conexion->error;
		}
}else{
	$mensajes[] = "Error. Mensaje no encontrado.";
}

foreach ($mensajes as $mensaje){
	$_SESSION['mensaje'] = $mensaje;
}
mysqli_close($conexion);

$_SESSION['url']= "panel-control.php";
header('Location: mensaje.php',true,303);
exit;
?>
