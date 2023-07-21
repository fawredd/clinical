<?php
if (session_status()!=2){session_start();}
 include 'conexion.php';
 $tbl_name = "mm_usuarios";
 //$form_pass = $_POST['password'];
$buscarUsuario = "SELECT * FROM $tbl_name WHERE id = '$_POST[id]' ";
$result = $conexion->query($buscarUsuario);
$count = mysqli_num_rows($result);
 if ($count == 1) {
	$myDate = date('d/m/Y');
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$id_usuario = $row['id']; 
	//$sql ="UPDATE mm_usuarios SET tipodocumento =".mysqli_real_escape_string( $conexion, $_POST['tipodocumento'] );
	//$sql .=",numerodocumento =".mysqli_real_escape_string( $conexion, $_POST['numerodocumento'] );
	//$sql .=",nombre ='".mysqli_real_escape_string( $conexion, $_POST['nombre'] )."'";
	//$sql .=",apellido ='".mysqli_real_escape_string( $conexion, $_POST['apellido'])."'";
	//$sql .=",tipousuario =".mysqli_real_escape_string( $conexion, $_POST['tipousuario'] );
	//$sql .=",activo ='".mysqli_real_escape_string( $conexion, $_POST['activo'] );
	$sql .="UPDATE mm_usuarios SET modificacion ='".date("Y-m-d")."'";
	$sql .=",direccion ='".mysqli_real_escape_string( $conexion, $_POST['direccion'] )."'";
	$sql .=",provincia ='".mysqli_real_escape_string( $conexion, $_POST['provincia'] )."'";
	$sql .=",localidad ='".mysqli_real_escape_string( $conexion, $_POST['localidad'] )."'";
	$sql .=",cp ='".mysqli_real_escape_string( $conexion, $_POST['codigopostal'] )."'";
	$sql .=",telefono ='".mysqli_real_escape_string( $conexion, $_POST['telefono'] )."'";
	$sql .=",email ='".mysqli_real_escape_string( $conexion, $_POST['email'] )."'";
	$sql .=",comentarios ='".mysqli_real_escape_string( $conexion, $_POST['comentarios'] )."'";
	$sql .=",celular ='".mysqli_real_escape_string( $conexion, $_POST['celular'] )."' WHERE id=".$id_usuario.";";
	if ($conexion->query($sql) === TRUE) {
			$_SESSION['mensaje']="Datos actualizados";
		$_SESSION['url']="form_listado_usuarios.php";
	}else{
		$_SESSION['mensaje']="Error al actualizar datos.<br>" . $conexion->error . "<br>". $sql; 
		$_SESSION['url']="form_listado_usuarios.php";
	}
}	
else {
	$_SESSION['mensaje']= "Error el usuario no fue encontrado.<br>" . $conexion->error; 
	$_SESSION['url']="form_listado_usuarios.php";
}
mysqli_close($conexion);
header('Location: mensaje.php',true,303);
exit;
?>
