<? 
if (session_status()!= PHP_SESSION_ACTIVE){session_start();}
if (isset($_SESSION['loggedin'])){
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	header("location:http://".$_SERVER['SERVER_NAME']."/clinical/panel-control.php",true,303);
	exit;	
}
?>
<!DOCTYPE html>
<html lang="es-AR">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="./img/logo.ico"> 
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
	<div class="panel panel-primary col-sm-4">
	  <div class="panel-heading">
		<h4>
		<img src="./img/logo.ico" style="height:50px;" />
		Login
		</h4>
	  </div>
	  <div class="panel-body">  
	  <form action="checklogin.php" method="post">
		<div class="form-group">
		  <label for="uname"><b>Email</b></label>
		  <input class="form-control" type="text" placeholder="Ingresar email" name="email" required>
		
		  <label for="psw"><b>Contraseña</b></label>
		  <input  class="form-control"  type="password" placeholder="Ingresa tu contraseña" name="password" required>
		</div>
		<div class="form-group">
		  <button  class="btn btn-success" type="submit">Login</button>
		  
		</div>
	  </form>
	  </div>
	  <div class="panel-footer" style="text-align:right;">
			<a class="btn btn-link btn-xs" href="form_forgot_pass.php">Olvide mi contraseña</a>
	  </div>
	</div>
</div>

</body>
</html>
