<?php
//incluimos el archivo donde se encuentran nuestros datos de conexion
 include 'conexion.php';
 $tbl_name = "mm_usuarios";
 $form_pass = $_POST['password'];

 $buscarUsuario = "SELECT * FROM $tbl_name WHERE usuario = '$_POST[username]' ";

 $result = $conexion->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
 echo "<br />". "Nombre de Usuario ya asignado, ingresa otro." . "<br />";

 echo "<a href='registro.html'>Por favor escoga otro Nombre</a>";
 }
 else{
	$escaped_username = mysqli_real_escape_string( $conexion, $_POST['username'] );
	$hashed_password = password_hash($form_pass, PASSWORD_DEFAULT);
	$escaped_email = mysqli_real_escape_string( $conexion, $_POST['email'] );
	$query = "INSERT INTO mm_usuarios (usuario, clave,email) VALUES ('$escaped_username', '$hashed_password','$escaped_email')";
	if ($conexion->query($query) === TRUE) {
		echo "<br />" . "<h1>" . "Gracias por registrarse!" . "</h1>";
		echo "<h3>" . "Bienvenido: " . $_POST['username'] . "</h3>" . "\n\n";
		echo "<h3>" . "Iniciar Sesion: " . "<a href='login.html'>Login</a>" . "</h3>"; 
 }
 else {
	echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
 }
 mysqli_close($conexion);
?>
