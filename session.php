<?php
if (session_status()!= PHP_SESSION_ACTIVE){session_start();}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {

	$_SESSION['mensaje']="Inicia sesion para acceder a este contenido.";
	$_SESSION['url']= "login.php";
	header('Location: mensaje.php',true,303);//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion
	exit;
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // last request was more than 10 minutes ago
	$_SESSION['mensaje']="Su sesion ha expirado.";
	$_SESSION['url']= "logout.php";
}
?>