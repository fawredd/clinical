<?php
 if (session_status()!=2){session_start();}
 include 'conexion.php';
 $tbl_name = "mm_pacientes";
 //$form_pass = $_POST['password'];

$mensajes = array();

$buscarUsuario = "SELECT * FROM $tbl_name WHERE (tipodocumento = '$_POST[tipodocumento]' AND documento = '$_POST[documento]' AND id_empresa='".$_SESSION['id_empresa']."')";
$result = $conexion->query($buscarUsuario);
$count = mysqli_num_rows($result);

if ($count == 1) {
	switch ($_POST[tipodocumento]) {
				case 1:
					$tipoDoc = "DNI";
					break;
				case 2:
					$tipoDoc =  "LC";
					break;
				case 3:
					$tipoDoc =  "LE";
					break;
				case 4:
					$tipoDoc =  "CI";
					break;
			}
	$mensajes[]="El paciente con documento ".$tipoDoc." ".$_POST[documento]." ya se encuentra cargado.";
	$_SESSION['url']= "panel-control.php";
}else {

	try{
	
	$conexion->begin_transaction();
	
	$sql = "INSERT INTO mm_pacientes (
	documento,nombre,apellido,tipodocumento
	,sexo,fechanacimiento,direccion,provincia,localidad,codigopostal,telefono,celular,email
	,gruposanguineo,obrasocial,numeroafiliado
	,comentarios,usuariocreacion,fechaalta,id_empresa)
	VALUES ("
	."'". mysqli_real_escape_string( $conexion, $_POST['documento'] ) ."'"
	.",'". mysqli_real_escape_string( $conexion, $_POST['nombre'] ) . "'" 
	.",'". mysqli_real_escape_string( $conexion, $_POST['apellido'] ) . "'"
	.",'". mysqli_real_escape_string( $conexion, $_POST['tipodocumento'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['sexo'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['fechanacimiento'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['direccion'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['provincia'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['localidad'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['codigopostal'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['telefono'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['celular'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['email'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['gruposanguineo'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['obrasocial'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['numeroafiliado'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['comentarios'] ) . "' " 
	.",'". $_SESSION['id'] . "' " 
	.",'". date('Y-m-d') . "' "
	.",'". $_SESSION['id_empresa'] . "' )";  
	if(!($conexion->query($sql))){
		echo "ERRO:".$conexion->error;
		mysqli_close($conexion);
		exit;
	}
	
	$last_id = mysqli_insert_id($conexion);
	
	$sql = "INSERT INTO mm_historiasclinicas (usuariocarga,fechacarga,paciente)
	VALUES ('" . $_SESSION['id'] . "','" . date('Y-m-d') . "','" . $last_id . "')";
	$conexion->query($sql);
	
	$conexion->commit();
	
	$mensajes[]="Nuevo paciente cargado.";
	$_SESSION['url']= "panel-control.php";
	
	} catch (Exception $e){
		$conexion->rollback();
		$mensajes[]=$sql." --> Error al actualizar datos.<br>" . $conexion->error . " - " . $e->getMessage(); 
		$_SESSION['url']= "panel-control.php";
	}
}	
mysqli_close($conexion);
foreach ($mensajes as $mensaje){
	$_SESSION['mensaje'] .= $mensaje . "<br/>";
}
header('Location: mensaje.php',true,303);
exit;
?>
