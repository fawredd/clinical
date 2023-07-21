<?php
if (session_status()!=2){session_start();}
include 'conexion.php';

$mensajes = array();
$sql = "SELECT * FROM mm_usuarios WHERE id=".$_SESSION['id'];

if($result = $conexion->query($sql)){
if ($result->num_rows > 0 && isset($_POST['token'])) {   
	$row = $result->fetch_array(MYSQLI_ASSOC);

	if (password_verify($_POST['token'], $row['token'])) {
		$hashed_password = password_hash($_POST['clave'], PASSWORD_DEFAULT);
		$sql = "UPDATE mm_usuarios SET activo = '1', clave='". $hashed_password."' WHERE id =".$_SESSION['id'];
		if ($result = $conexion->query($sql)){
			$mensajes[]="Usuario verificado.<br/>Por favor ingrese nuevamente al sistema.";
			$_SESSION['url']="logout.php";
		} else{
			$mensajes[]="Error:".$conexion->connect_error;
			$_SESSION['url']="logout.php";
		}
	} else {
		$mensajes[]="El token ingresado es incorrecto";
		$_SESSION['url']="logout.php";
	}
} else {
	$mensajes[]="Error: usuariono encontrado";
	$_SESSION['url']="logout.php";
}
}else{
		$mensajes[]="Error:".$conexion->connect_error;
		$_SESSION['url']="logout.php";
}	
mysqli_close($conexion); 
foreach ($mensajes as $mensaje){
	$_SESSION['mensaje'] .= $mensaje . "<br/>";
}
header("location:mensaje.php",true,303);
exit;

?>
