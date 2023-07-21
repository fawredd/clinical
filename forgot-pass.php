<?php
if (session_status()!= PHP_SESSION_ACTIVE){session_start();}

require("class.phpmailer.php");
require("class.smtp.php");

include 'conexion.php';

$sql = "SELECT * FROM mm_usuarios WHERE email='".$_POST['email']."'";
if($result = $conexion->query($sql)){

if ($result->num_rows > 0) {
	
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	$randtoken = rand(999, 99999);
	$eltoken = password_hash($randtoken, PASSWORD_DEFAULT);
	
	// ENVIO EMAIL DE CONFIRMACION
	$nombre = "Clinical";
	$email = "webmaster@dominio.com";
	$mensaje = "<p>Nombre y Apellido: ".$row["nombre"]." ".$row["apellido"]."</p>"
	."<p>Email: ".$row["email"]."</p>"
	."<p>Clave: abcd</p>"
	."<p>Ingrese con su email y clave. Luego verifique su registro con el siguiente codigo:" . $randtoken."</p>"
	."<p>Link: <a href='login.php'>Login</a></p>";
	
	// Datos de la cuenta de correo utilizada para enviar vía SMTP
	$smtpHost = "mail.dominio.com";  // Dominio alternativo brindado en el email de alta 
	$smtpUsuario = "admin@dominio.com";  // Mi cuenta de correo
	$smtpClave = "clave";  // Mi contraseña

	// Email donde se enviaran los datos cargados en el formulario de contacto
	$emailDestino = $_POST['email'];
	$_SESSION['mensaje'] .= "Email destino: ". $_POST['email'];

	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Port = 25; 
	//$mail->SMTPSecure = 'ssl';
	$mail->IsHTML(true); 
	$mail->CharSet = "utf-8";


	// VALORES A MODIFICAR //
	$mail->Host = $smtpHost; 
	$mail->Username = $smtpUsuario; 
	$mail->Password = $smtpClave;

	$mail->From = $email; // Email desde donde envío el correo.
	$mail->FromName = $nombre;
	$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

	$mail->Subject = "Mensaje para usuario."; // Este es el titulo del email.
	$mensajeHtml = nl2br($mensaje);
	$mail->Body = "{$mensajeHtml} <br /><br />Clinical<br />"; // Texto del email en formato HTML
	$mail->AltBody = "{$mensaje} \n\n Clinical"; // Texto sin formato HTML
	// FIN - VALORES A MODIFICAR //

	$estadoEnvio = $mail->Send(); 
	if($estadoEnvio){
		$mensaje = "Se ha enviado un email de confirmación al email informado. ".$randtoken; // BORRAR $randtoken
	}else{
		$mensaje = "Hubo un error al intentar enviar un email de confirmacion al email informado." Error: ".$mail->ErrorInfo;;
	}
		
	$sql = "UPDATE mm_usuarios SET activo='0', token='".$eltoken."' WHERE id='".$row['id']."'";
	if($result = $conexion->query($sql)){
		$_SESSION['mensaje']="<p>".$mensaje."</p><p>Email verificado y a la espera de activacion.</p>" ;
		$_SESSION['url']= "logout.php";
	} else {
		$_SESSION['mensaje']="Error al ejecutar comando sql:".$conexion->connect_error;
		$_SESSION['url']="logout.php";
	}
		
} else {
	$_SESSION['mensaje']="Error: Usuario no encontrado";
	$_SESSION['url']="logout.php";
}
}else{
		$_SESSION['mensaje']="Error:".$conexion->connect_error;
		$_SESSION['url']="logout.php";
		
}	
mysqli_close($conexion); 
//echo "session " . $_SESSION['mensaje'];
header("location:mensaje.php",true,303);
?>
