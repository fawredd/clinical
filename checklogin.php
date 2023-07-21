<?php
if (session_status()!=2){session_start();}
include 'conexion.php';
$tbl_name = "mm_usuarios";

$mensajes=array();
$email = $_POST['email'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM $tbl_name WHERE email = '$email'";


$result = $conexion->query($sql);


if ($result->num_rows > 0) {	
 
  $row = $result->fetch_array(MYSQLI_ASSOC);
 
 if (password_verify($password, $row['clave']) && $row['activo']==1){ 
    $_SESSION['loggedin'] = true;
    $_SESSION['id'] = $row['id'];
	$_SESSION['email'] = $email;
	$_SESSION['tipousuario'] = $row['tipousuario'];
	$_SESSION['nombre'] = $row['nombre']." ".$row['apellido'];
	
	$_SESSION['id_empresa'] = $row['id_empresa'];
	$sql = "SELECT * FROM mm_empresas WHERE id = '" . $row['id_empresa'] . "'";
	$result = $conexion->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$_SESSION['empresa'] = $row['denominacion'];
	
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	$_SESSION['start'] = time();
	mysqli_close($conexion); 
	header("location:http://".$_SERVER['SERVER_NAME']."/clinical/panel-control.php",true,303);
	exit;

 } else { 
	if ($row['activo']==0 || $row['activo']==2 ){
		$_SESSION['id']=$row['id'];
		$_SESSION['mensaje']='Debe verificar su cuenta mediante el codigo enviado a su email.';
		$_SESSION['url']= "http://".$_SERVER['SERVER_NAME']."/clinical/form_verifica_usuario.php";
	}else{
		$_SESSION['mensaje']='Username o Password estan incorrectos.';
			$_SESSION['url']= "http://".$_SERVER['SERVER_NAME']."/clinical/login.php";
	}
 }
}else {
	 $_SESSION['mensaje']='No se encontro el usuario.';
	 $_SESSION['url']= "http://".$_SERVER['SERVER_NAME']."/clinical/login.php";
 }

 mysqli_close($conexion); 
header("Location:http://".$_SERVER['SERVER_NAME']."/clinical/mensaje.php",true,303);
exit;
 ?>