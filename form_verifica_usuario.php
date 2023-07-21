<?php
if (session_status()!=2){session_start();}
include 'conexion.php';

$mensajes= array();

$sql = "SELECT * FROM mm_usuarios WHERE id=".$_SESSION['id'];
$result = $conexion->query($sql);

if ($result->num_rows > 0){
$row = $result->fetch_array(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es-AR">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Clinical</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	
	.panel {
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		box-shadow: 0 0 30px black;
		padding-left: 0px;
		padding-right:0px;
	}
  </style>
 </head>
<body>
<div class="container">
	<div class="panel panel-danger col-sm-4">
	  <div class="panel-heading">
		<h4>VERIFICAR</h4>
	  </div>
	  <div class="panel-body">  
	  <form action="verifica_usuario.php" method="post">
		<div class="form-group">
		  <label for="token"><b>Ingrese el token</b></label>
		  <input class="form-control" type="text" placeholder="token" name="token" required>
		</div>
		<div class="form-group">
		  <label for="1_2"><b>Nueva contraseña</b></label>
		  <input class="form-control" id="1_2" type="text" placeholder="contraseña" name="clave" required>
		</div>
		<div class="form-group">
		  <button  class="btn btn-success" type="submit">Enviar</button>
		</div>
	  </form>
	  </div>
	  <div class="panel-footer">
		<p>Clinical</p>
	  </div>
	</div>
</div>

</body>
</html>
<?php
} else {
	$_SESSION['mensaje']="ERROR. Usuario no encontrado.";
	$_SESSION['url']="http://".$_SERVER['SERVER_NAME']."/clinical/login.php";
	mysqli_close($conexion); 
	header("location:http://".$_SERVER['SERVER_NAME']."/clinical/mensaje.php",true,303);
	exit;
}

mysqli_close($conexion); 
?>