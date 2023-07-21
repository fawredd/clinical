<?php
 include 'session.php';
 include 'conexion.php';
$errors = []; // Store all foreseen and unforseen errors here
$mensajes = [];
 $_SESSION['id_historia']=$_POST['id_historia'];
 
if (isset($_SESSION['id_historia'])){
	
	$tbl_name = "mm_fichaNutri";
	$diagnosico = mysqli_real_escape_string( $conexion, $_POST['diagnostico'] );
	$antecedentes = mysqli_real_escape_string( $conexion, $_POST['antecedentes'] );
	$pa = mysqli_real_escape_string( $conexion, $_POST['pa'] );
	$t = mysqli_real_escape_string( $conexion, $_POST['t'] );
	$tEstimada = mysqli_real_escape_string( $conexion, $_POST['tEstimada'] );
	$bmi = mysqli_real_escape_string( $conexion, $_POST['bmi'] );
	$ph = mysqli_real_escape_string( $conexion, $_POST['ph'] );
	$pcp = mysqli_real_escape_string( $conexion, $_POST['pcp'] );
	$diagnosticoNutricional = mysqli_real_escape_string( $conexion, $_POST['diagnosticoNutricional'] );
	$laboratorio = mysqli_real_escape_string( $conexion, $_POST['laboratorio'] );
	$masticacion = mysqli_real_escape_string( $conexion, $_POST['masticacion'] );
	$deglucion = mysqli_real_escape_string( $conexion, $_POST['deglucion'] );
	$asistencia = mysqli_real_escape_string( $conexion, $_POST['asistencia'] );
	$indicacion = mysqli_real_escape_string( $conexion, $_POST['indicacion'] );
	$suplementacion = mysqli_real_escape_string( $conexion, $_POST['suplementacion'] );
	$colaciones = mysqli_real_escape_string( $conexion, $_POST['colaciones'] );
	$comentario = mysqli_real_escape_string( $conexion, $_POST['comentario'] );
	
	$query = "INSERT INTO mm_fichaNutri"
	." (historiaclinica, fechaficha, horacarga, usuariocarga"
	.", diagnostico, antecedentes, pa, t, tEstimada, bmi, ph, pcp, diagnosticoNutricional"
	.",laboratorio, masticacion, deglucion, asistencia, indicacion, suplementacion, colaciones, comentario) "
	."VALUES (".$_SESSION['id_historia'].", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,". $_SESSION['id']
	.",'".$diagnostico."'" 
	.",'".$antecedentes."'" 
	.",'".$pa."'" 
	.",'".$t."'" 
	.",'".$tEstimada."'" 
	.",'".$bmi."'" 
	.",'".$ph."'" 
	.",'".$pcp."'" 
	.",'".$diagnosticoNutricional."'" 
	.",'".$laboratorio."'" 
	.",'".$masticacion."'" 
	.",'".$deglucion."'" 
	.",'".$asistencia."'" 
	.",'".$indicacion."'" 
	.",'".$suplementacion."'" 
	.",'".$colaciones."'" 
	.",'".$comentario."')"; 

	if ($conexion->query($query) === TRUE) {
		$mensajes[] = 'Se cargo correctamenta la hoja.'; 
	}else {
		$mensajes[] = "Error al agregar la hoja.<br>SQL: " . $query . "<br>Con error: " . $conexion->error; 
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
			
			$sql = "INSERT INTO mm_adjuntosNutri (ficha,archivo) VALUES ('" . $last_id . "','". $uploadPath ."')";
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
$_SESSION['url']="form_muestra_datos_nutricion.php?links=1&id_paciente=".$_POST['id_paciente'];
header('Location: mensaje.php',true,303);
exit;
 ?>