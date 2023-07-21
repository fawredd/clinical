<? 
if (session_status()!= PHP_SESSION_ACTIVE){session_start();}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Mensaje</title>
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
		padding-left:0px;
		padding-right:0px;
		box-shadow: 0 0 30px black;
	}

  </style>
 </head>
<body>
<div class="container">
	<div class="panel panel-primary col-sm-5">
		<div class="panel-heading">
			<h4 class="panel-title">Mensaje</h4>
		</div>
<?
if (isset($_SESSION) && isset($_SESSION['mensaje'])){
	?>

		<div id="divMensaje" class="panel-body">
			<p><?=$_SESSION['mensaje']; ?></p>
		</div>
	<?
} else {
	$_SESSION['url'] = "http://".$_SERVER['SERVER_NAME']."/clinical/panelCarga.php";
	?>
		<div id="divMensaje" class="panel-body">
			<p><?=(isset($_GET['mensaje']))?$_GET['mensaje']:'Redirigiendo a pagina de inicio.'; ?></p>
		</div>
<?
}
?>
		<div class="panel-footer">
			<a type="button" class="btn btn-default btn-sm" href="<?= $_SESSION['url'] ?>">Cerrar</a>
		</div>
	</div>
</div>
</body>
</html>
<? 	
unset($_SESSION['url']);
unset($_SESSION['mensaje']);
 ?>
