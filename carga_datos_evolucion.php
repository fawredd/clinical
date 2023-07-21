<?php
 include 'session.php';
 include 'conexion.php';
$errors = []; // Store all foreseen and unforseen errors here
$mensajes = [];
 $_SESSION['id_historia']=$_POST['id_historia'];
 
if (isset($_SESSION['id_historia'])){
	
	$tbl_name = "mm_fichahistoria";
	$datos = mysqli_real_escape_string( $conexion, $_POST['datos'] );
	$comentario = mysqli_real_escape_string( $conexion, $_POST['comentario'] );

	$query = "INSERT INTO mm_fichahistoria"
	." (historiaclinica, fechaficha, horacarga, usuariocarga, datos, comentario) "
	."VALUES (".$_SESSION['id_historia'].", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,". $_SESSION['id']
	.",'".$datos."'" 
	.",'".$comentario."')"; 

	if ($conexion->query($query) === TRUE) {
		$mensajes[] = 'Se cargo correctamenta la evolución.'; 
	}else {
		$mensajes[] = "Error al agregar la evolución.<br>SQL: " . $query . "<br>Con error: " . $conexion->error; 
	}

	$last_id = mysqli_insert_id($conexion);

	$currentDir = getcwd();
	
	$uploadDirectory = "./uploads/";
	
	$fileExtensions = ['jpeg','jpg','png','pdf']; // Get all the file extensions
	$fileName = $_FILES['myfile']['name'];
	$fileSize = $_FILES['myfile']['size'];
	$fileTmpName  = $_FILES['myfile']['tmp_name'];
	$fileType = $_FILES['myfile']['type'];
	$fileExtension = strtolower(end(explode('.',$fileName)));
	
	$uploadPath = $uploadDirectory . basename($fileName); 
	
	if (! in_array($fileExtension,$fileExtensions)) {
		$errors[] = "Adjunto no permitido. Solo jpg,png o pdf";
	}
	if ($fileSize > 2000000) {
		$errors[] = "El tamaño del adjunto es superior a 2MB.";
	}
	if (empty($errors)) {
		$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

		if ($didUpload) {
			
			$sql = "INSERT INTO mm_adjuntosficha (ficha,archivo) VALUES ('" . $last_id . "','". $uploadPath ."')";
			if($conexion->query($sql)){
				$mensajes[] = "El adjunto " . basename($fileName) . " fue cargado.";
			} else {
				$mensajes[]= "Error en SQL adjunto.<br/> SQL: " . $sql ." <br/> Con error: " . $conexion->error;
			}
		} else {
			$mensajes[] = "Error!<br/>El adjunto " . basename($fileName) . " no fue cargado.";
		}
	}

}else{
	$mensajes[] = "No se encontro la historia clinica: ".$_SESSION['id_historia'];
 }
mysqli_close($conexion);

	foreach ($errores as $error){
		$_SESSION['mensaje'] .= $error . "<br/>";
	}
	foreach ($mensajes as $mensaje){
		$_SESSION['mensaje'] .= $mensaje . "<br/>";
	}
	
unset($_SESSION['id_historia']);
$_SESSION['url']="form_muestra_datos_historia.php?links=1&id_paciente=".$_POST['id_paciente'];
header('Location: mensaje.php',true,303);
exit;
 ?>