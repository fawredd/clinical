<?php
include 'session.php';
include 'conexion.php';
$links = 0;
?>
<!DOCTYPE html>
<html lang="es-AR">
<head>
  <title>Inicio</title>
  
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="./img/logo.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css"> 
  a:link 
  { 
	text-decoration:none; 
  } 
  </style>

</head>
<body>
<div class="container">
<?php
$_SESSION['menu']=1;
include 'menu.php'; 
?>
	<div class="row">
		<div class="col-sm-12">
			<h4>
				<p>Bienvenido <?php echo  $_SESSION['nombre'];?></p>
				<small>-<?php echo $_SESSION['empresa']; ?>-</small>
			</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary" style="margin-top: 10px;">
				<div class="panel-heading ">
					<h5>Mensajes</h5>
						
				</div>
				<div class="panel-body">
					<?php
					//consulto los mensajes
					$sql = "SELECT mm_mensajes.id as id,mm_mensajes.mensaje as mensaje,mm_mensajes.fecha_carga as fecha, concat(mm_usuarios.nombre , ' ' , mm_usuarios.apellido) 
					as elUsuario FROM mm_mensajes INNER JOIN mm_usuarios ON mm_mensajes.usuario_carga = mm_usuarios.id 
					WHERE mm_mensajes.id_empresa=".$_SESSION['id_empresa'] ." ORDER BY mm_mensajes.id DESC;";
					
					if( $result = $conexion->query($sql) ){
						while ($row_mensajes = $result->fetch_array(MYSQLI_ASSOC)){
					?>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel">
							<div class="panel-heading">
								<a type="button" class="close" href="elimina_comentario.php?id=<?= $row_mensajes['id']; ?>">&times;</a>
							</div>
							<div class="panel-body">
								<p><?= $row_mensajes['mensaje']; ?></p>
								<p><?= $row_mensajes['elUsuario'].' '.date("d/m/Y", strtotime($row_mensajes['fecha'])); ?></p>
							</div>
							</div>
						</div>
					</div>
					<?php
						}
					}
					?>
				</div>
				<div class="panel-footer">
				<?php
						if ($_SESSION['tipousuario']==1){
				?>
						<div class="panel-group d-print-none" id="accordion">
							<div class="panel">
								<div class="panel-heading">
									<h4 class="panel-title">
									<a class="btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion" href="#collapse0">
									Nuevo mensaje.</a>
									</h4>
								</div>
								<div id="collapse0" class="panel-collapse collapse">
								<div class="panel-body">
									<form id="form_mensaje" method="post" enctype="multipart/form-data" action="carga_nuevo_mensaje.php">
										<textarea rows="5" id="element_1" name="mensaje" class="form-control" type="text" value="" placeholder="mensaje" required></textarea>
										<input type="submit" name="submit" class="btn btn-success" />
									</form>
								</div>
								</div>
							</div>
						</div>
					<?php
						}
					?>
					</div>
			</div>
		</div>
	</div>
	
</div>
</body>
</html>