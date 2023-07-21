<?php
 if (session_status()!=2){session_start();}
 include 'conexion.php';
}

$sql = "SELECT * FROM mm_historiasclinicas WHERE id =". $_POST['id_historia'];
$result = $conexion->query($sql);
$count = mysqli_num_rows($result);
$_SESSION['mensaje']= "No se encontro la historia clinica.";
$_SESSION['url']="form_muestra_datos_historia.php".$_POST['id_paciente'];

if ($count == 1) {
	
	$conexion->begin_transaction();
	
	$myDate = date('d/m/Y');
	$sql ="UPDATE mm_historiasclinicas SET comentarios = '".mysqli_real_escape_string( $conexion, $_POST['comentario_historia'] )."';";
	if ($conexion->query($sql) === TRUE) {
		$_SESSION['mensaje']="Comentario actualizado";
		$_SESSION['url']="form_muestra_datos_historia.php?id_paciente=".$_POST['id_paciente'];
		$conexion->commit();
	}else{
		$_SESSION['mensaje']="Error al actualizar comentario.<br>" . $conexion->error . "<br>". $sql; 
		$_SESSION['url']="form_muestra_datos_historia.php?id_paciente=".$_POST['id_paciente'];
		$conexion->rollback();
	}
		
}
mysqli_close($conexion);
header('Location: mensaje.php',true,303);
exit;
?>
