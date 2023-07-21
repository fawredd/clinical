<?php
 include 'session.php';
 include 'conexion.php';
$errors = []; // Store all foreseen and unforseen errors here
$mensajes = [];
 $_SESSION['id_historia']=$_POST['id_historia'];
 
if (isset($_SESSION['id_historia'])){
	
	$comentario = mysqli_real_escape_string( $conexion, $_POST['comentario']);
	$query = "START TRANSACTION;";
	if ($conexion->query($query) === TRUE) {
		$mensajes[] = 'Se inicio la carga.'; 
	}else {
		$mensajes[] = 'Error al agregar la indicación.<br/>SQL: ' . $query . '<br/>Con error: ' . $conexion->error; 
		goto error;
	}
	
	$query = "INSERT INTO mm_indicaciones"
	." (historiaclinica, fechaficha, horacarga, usuariocarga, comentario) "
	."VALUES (".$_SESSION['id_historia'].", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,". $_SESSION['id']
	.",'".$comentario."');";
	
	if ($conexion->query($query) === TRUE) {
		$mensajes[] = 'Se cargo correctamente la indicación '.$j; 
	}else {
		$mensajes[] = 'Error al agregar la indicación $j.<br/>SQL: ' . $query . '<br/>Con error: ' . $conexion->error; 
		goto error;
	}
	
	$last_id = mysqli_insert_id($conexion);
	
	for ($j=0;$j<count($_POST['medicacion']);$j++){
	
	$medicacion = mysqli_real_escape_string( $conexion, $_POST['medicacion'][$j] );
	$desayuno = mysqli_real_escape_string( $conexion, $_POST['desayuno'][$j] );
	$almuerzo = mysqli_real_escape_string( $conexion, $_POST['almuerzo'][$j] );
	$merienda = mysqli_real_escape_string( $conexion, $_POST['merienda'][$j] );
	$cena = mysqli_real_escape_string( $conexion, $_POST['cena'][$j] );
	$veintidoshs = mysqli_real_escape_string( $conexion, $_POST['22hs'][$j] );
	
	$query = "INSERT INTO mm_indicaciones_mov"
	." (indicacion, medicacion , desayuno, almuerzo, merienda, cena, 22hs) "
	."VALUES ('".$last_id ."'"
	.",'".$medicacion."'" 
	.",'".$desayuno."'" 
	.",'".$almuerzo."'" 
	.",'".$merienda."'" 
	.",'".$cena."'" 
	.",'".$veintidoshs."');";
		
	if ($conexion->query($query) === TRUE) {
		$mensajes[] = 'Se cargo correctamente la indicación '.$j; 
	}else {
		$mensajes[] = 'Error al agregar la indicación '. $j. '<br/>SQL: ' . $query . '<br/>Con error: ' . $conexion->error; 
		goto error;
	}
	}	
	
	
	$query = "COMMIT";
	if ($conexion->query($query) === TRUE) {
		$mensajes[] = 'Se finalizo la carga.'.'<br/>'; 
	}else {
		$mensajes[] = 'Error al finalizar la carga.<br/>SQL: ' . $query . '<br/>Con error: ' . $conexion->error.'<br/>'; 
		goto error;
	}
	
}else{
	$mensajes[] = "No se encontro la historia clinica: ".$_SESSION['id_historia'];
 }
cierre:
 mysqli_close($conexion);

	foreach ($errores as $error){
		$_SESSION['mensaje'] .= $error . "<br/>";
	}
	foreach ($mensajes as $mensaje){
		$_SESSION['mensaje'] .= $mensaje . "<br/>";
	}
	
unset($_SESSION['id_historia']);
$_SESSION['url']="form_muestra_indicaciones.php?links=1&id_paciente=".$_POST['id_paciente'];
header('Location: mensaje.php',true,303);
exit;

error:
$query = "ROLLBACK";
if ($conexion->query($query) === TRUE) {
	$mensajes[] = 'Se anulo la carga.'.'<br/>'; 
}
goto cierre;	
 ?>