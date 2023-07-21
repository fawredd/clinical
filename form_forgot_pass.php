<?php
if (session_status()!=2){session_start();}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Recuperar contraseña</title>
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
		<h4>Reuperar contraseña</h4>
	  </div>
	  <div class="panel-body">  
	  <form action="forgot-pass.php" method="post">
		<div class="form-group">
		  <label for="email"><b>Ingrese su email</b></label>
		  <input class="form-control" type="text" placeholder="@" name="email" required>
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
