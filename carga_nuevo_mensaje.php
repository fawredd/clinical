<?php
 if (session_status()!=2){session_start();}
 include 'conexion.php';
 $tbl_name = "mm_usuarios";
$conexion->query("SET NAMES 'utf8'");

	$conexion->begin_transaction();
	
	$sql = "INSERT INTO mm_mensajes (fecha_carga,mensaje,id_empresa,usuario_carga)
	VALUES ("
	."'". date("Y-m-d") . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['mensaje'] ) . "' " 
	.",'". $_SESSION['id_empresa'] . "'" 
	.",'". $_SESSION['id'] . "');"; 
	
	if(!($conexion->query($sql))){
		$_SESSION['mensaje']="Error al intentar aplicar sql:".$sql." <br/>Error:".$conexion->error;
		$_SESSION['url']="panel-control.php";
		mysqli_close($conexion);
		header('Location: mensaje.php',true,303);
		exit;
	}
	
	$conexion->commit();
	
	$_SESSION['mensaje']="<p>Mensaje cargado.</p>". $mensaje;
	$_SESSION['url']= "panel-control.php";

mysqli_close($conexion);
header('Location: mensaje.php',true,303);
exit;
?>
