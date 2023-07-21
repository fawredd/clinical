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

$sql = "SELECT * FROM mm_usuarios WHERE id=".$id;
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($result->num_rows > 0) {   
	$sql = "DELETE FROM mm_usuarios WHERE id=".$id;
	if($result = $conexion->query($sql)){
		$mensajes[] = "Usuario eliminado.";
	}else{
		$mensajes[] = "Error al intentar eliminar usuario. ERROR: " . $conexion->error;
	}
}else{
	$mensajes[] = "Error. Usuario no encontrado.";
}

foreach ($mensajes as $mensaje){
	$_SESSION['mensaje'] = $mensaje;
}
mysqli_close($conexion);

$_SESSION['url']= "form_listado_usuarios.php";
header('Location: mensaje.php',true,303);
exit;
?>
