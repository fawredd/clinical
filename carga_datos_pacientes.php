<?php
if (session_status()!=2){session_start();}
 include 'conexion.php';
 $tbl_name = "mm_pacientes";
 //$form_pass = $_POST['password'];
$buscarUsuario = "SELECT * FROM $tbl_name WHERE id = '$_POST[id]' ";
$result = $conexion->query($buscarUsuario);
$count = mysqli_num_rows($result);
 if ($count == 1) {
	$myDate = date('d/m/Y');
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$id_usuario = $row['id']; 
	//$sql ="UPDATE $tbl_name SET tipodocumento ='".mysqli_real_escape_string( $conexion, $_POST['tipodocumento'] )."'";
	//$sql .=",documento ='".mysqli_real_escape_string( $conexion, $_POST['numerodocumento'] )."'";
	//$sql .=",sexo ='".mysqli_real_escape_string( $conexion, $_POST['sexo'] )."'";
	//$sql .=",nombre ='".mysqli_real_escape_string( $conexion, $_POST['nombre'] )."'";
	//$sql .=",apellido ='".mysqli_real_escape_string( $conexion, $_POST['apellido'])."'";
	//$sql .=",activo =".mysqli_real_escape_string( $conexion, $_POST['activo'] );
	$sql = "UPDATE $tbl_name SET modificacion = '" . date('Y-m-d') . "'";
	$sql .=",direccion ='".mysqli_real_escape_string( $conexion, $_POST['direccion'] )."'";
	$sql .=",provincia ='".mysqli_real_escape_string( $conexion, $_POST['provincia'] ). "'";
	$sql .=",localidad ='".mysqli_real_escape_string( $conexion, $_POST['localidad'] ) ."'";
	$sql .=",codigopostal ='".mysqli_real_escape_string( $conexion, $_POST['codigopostal'] )."'";
	$sql .=",telefono ='".mysqli_real_escape_string( $conexion, $_POST['telefono'] )."'";
	$sql .=",celular ='".mysqli_real_escape_string( $conexion, $_POST['celular'] )."'";
	$sql .=",email ='".mysqli_real_escape_string( $conexion, $_POST['email'] )."'";
	$sql .=",gruposanguineo ='".mysqli_real_escape_string( $conexion, $_POST['gruposanguineo'] )."'";
	$sql .=",obrasocial ='".mysqli_real_escape_string( $conexion, $_POST['obrasocial'] )."'";
	$sql .=",numeroafiliado ='".mysqli_real_escape_string( $conexion, $_POST['numeroafiliado'] )."'";
	$sql .=",comentarios ='".mysqli_real_escape_string( $conexion, $_POST['comentarios'] )."'";
	$sql .=",fechafallecimiento ='".mysqli_real_escape_string( $conexion, $_POST['fechafallecimiento'] )."'";
	$sql .=",fechabaja ='".mysqli_real_escape_string( $conexion, $_POST['fechabaja'] )."'";
	$sql .=",responsable_nombre ='".mysqli_real_escape_string( $conexion, $_POST['responsable_nombre'] )."'";
	$sql .=",responsable_doc ='".mysqli_real_escape_string( $conexion, $_POST['responsable_doc'] )."'";
	$sql .=",responsable_tel ='".mysqli_real_escape_string( $conexion, $_POST['responsable_tel'] )."'";	
	$sql .=",responsable_dir ='".mysqli_real_escape_string( $conexion, $_POST['responsable_dir'] )."' WHERE id=".$id_usuario.";";
	if ($conexion->query($sql) === TRUE) {
		$_SESSION['mensaje']="Datos actualizados";
		$_SESSION['url']="form_listado_pacientes.php";
	}else{
		$_SESSION['mensaje']="Error al actualizar datos.<br>" . $conexion->error . "<br>". $sql; 
		$_SESSION['url']="form_listado_pacientes.php";
	}
}	
else {
	$_SESSION['mensaje']= "Error el paciente no fue encontrado.<br>" . $conexion->error; 
	$_SESSION['url']="form_listado_pacientes.php";
}
mysqli_close($conexion);
header('Location: mensaje.php',true,303);
exit;
?>
