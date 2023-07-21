<?php
 if (session_status()!=2){session_start();}
 
 require("class.phpmailer.php");
 require("class.smtp.php");
 
 include 'conexion.php';
 $tbl_name = "mm_usuarios";

$mensajes[] = array();

//BUSCO SI ESTA CARGADO USUARIO POR DNI
$buscarUsuario = "SELECT * FROM $tbl_name WHERE (tipodocumento = '$_POST[tipodocumento]' AND numerodocumento = '$_POST[numerodocumento]' AND id_empresa='".$_SESSION['id_empresa']."')";
$result = $conexion->query($buscarUsuario);
$count = mysqli_num_rows($result);
//$mensajes[]="SQL: ".$buscarUsuario. "<br/>Resultados: ".$count;
if ($count == 1) {
	$_SESSION['mensaje']= "Ya se encuentra registrado un usuario con el documento indicado.";
	$_SESSION['url']="panel-control.php";
	mysqli_close($conexion);
	header('Location: mensaje.php',true,303);
	exit;
}

//Busco si el email ya esta registrado
$buscarUsuario = "SELECT * FROM $tbl_name WHERE email = '$_POST[email]' AND id_empresa='".$_SESSION['id_empresa']. "'";
$result = $conexion->query($buscarUsuario);
$count = mysqli_num_rows($result);
//$mensajes[]="SQL: ".$buscarUsuario. "<br/>Resultados: ".$count;
if ($count == 1) {
	$_SESSION['mensaje']= "Ya se encuentra registrado un usuario con el email indicado.";
	$_SESSION['url']="panel-control.php";
	mysqli_close($conexion);
	header('Location: mensaje.php',true,303);
	exit;
}

//SI PASA LOS FILTROS ANTERIORES DOY DE ALTA EL USUARIO
	$hashed_password = password_hash($_POST['clave'], PASSWORD_DEFAULT);
	$randtoken = rand(999, 99999);
	$eltoken = password_hash($randtoken, PASSWORD_DEFAULT);

	$conexion->begin_transaction();
	
	$sql = "INSERT INTO mm_usuarios (
	nombre ,apellido ,email ,clave ,tipousuario ,activo 
	,alta ,modificacion ,direccion ,provincia ,localidad ,cp ,telefono 
	,celular ,tipodocumento ,numerodocumento, matricula, especialidad ,id_empresa ,token, comentarios, usuariocarga)
	VALUES ("
	."'". mysqli_real_escape_string( $conexion, $_POST['nombre'] ) . "'" 
	.",'". mysqli_real_escape_string( $conexion, $_POST['apellido'] ) . "'"
	.",'". mysqli_real_escape_string( $conexion, $_POST['email'] ) . "' " 
	.",'". $hashed_password . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['tipousuario'] ) . "' " 
	.",'0'" 
	.",'". date("Y-m-d") . "' " 
	.",'". date("Y-m-d") . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['direccion'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['provincia'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['localidad'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['codigopostal'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['telefono'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['celular'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['tipodocumento'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['numerodocumento'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['matricula'] ) . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['especialidad'] ) . "' " 
	.",'". $_SESSION['id_empresa'] . "' " 
	.",'". $eltoken . "' " 
	.",'". mysqli_real_escape_string( $conexion, $_POST['comentarios'] ) . "' " 
	.",'". $_SESSION['id'] . "') " ;
	
	if(!($conexion->query($sql))){
		$_SESSION['mensaje']="Error al intentar aplicar sql:".$conexion->error;
		$_SESSION['url']="panel-control.php";
		mysqli_close($conexion);
		header('Location: mensaje.php',true,303);
		exit;
	}
	
	$conexion->commit();
	
	// ENVIO EMAIL DE CONFIRMACION
	$nombre = "Clinical";
	$email = "webmaster@dominio.com";
	$cuerpoEmail = "Usuario registrado: \n"
	."Nombre: ".$_POST["nombre"]." ".$_POST["apellido"]."\n"
	."Email: ".$_POST["email"]."\n"
	."Contraseña: ".$_POST["clave"]."\n"
	."Por favor verifique su registro con el siguiente codigo." . $randtoken
	."\n ingresando al siguiente <a href='login.php'>LINK</a>\n";
	
	// Datos de la cuenta de correo utilizada para enviar vía SMTP
	$smtpHost = "smtp.dominio.com";  // Dominio alternativo brindado en el email de alta 
	$smtpUsuario = "webmaster@dominio.com";  // Mi cuenta de correo
	$smtpClave = "clave";  // Mi contraseña

	// Email donde se enviaran los datos cargados en el formulario de contacto
	$emailDestino = $_POST['email'];

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Port = 465; 
	$mail->SMTPSecure = 'ssl';
	$mail->IsHTML(true); 
	$mail->CharSet = "utf-8";


	// VALORES A MODIFICAR //
	$mail->Host = $smtpHost; 
	$mail->Username = $smtpUsuario; 
	$mail->Password = $smtpClave;

	$mail->From = $email; // Email desde donde envío el correo.
	$mail->FromName = $nombre;
	$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

	$mail->Subject = "Verifique su registro."; // Este es el titulo del email.
	$mensajeHtml = nl2br($cuerpoEmail);
	$mail->Body = "{$mensajeHtml} <br /><br />Clinical<br />"; // Texto del email en formato HTML
	$mail->AltBody = "{$cuerpoEmail} \n\n Clinical"; // Texto sin formato HTML
	// FIN - VALORES A MODIFICAR //

	$estadoEnvio = $mail->Send(); 
	if($estadoEnvio){
		$mensajes[] = "Se ha enviado un email de confirmación al email informado";
	}else{
		$mensajes[] = "Hubo un error al intentar enviar un email de confirmacion al email informado";
	}
	
	$mensajes[]="<p>Nuevo usuario cargado.</p>";
	$_SESSION['url']= "panel-control.php";
	
mysqli_close($conexion);
foreach ($mensajes as $mensaje){
	$_SESSION['mensaje'] .= "<br/>".$mensaje;
}
header('Location: mensaje.php',true,303);
exit;
?>
