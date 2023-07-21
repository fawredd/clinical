<?php
include 'session.php';
include 'conexion.php';
include 'funciones.php';
if ($_SESSION['tipousuario']!=1 && $_SESSION['tipousuario']!=3){
	$_SESSION['mensaje']= "ACCESO RESTRINGIDO";
	$_SESSION['url']= "logout.php";
	header('Location: mensaje.php',true,303);
	exit;
}

$sql = "SELECT * FROM mm_usuarios ORDER BY apellido";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Pacientes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
	$(document).ready(function(){
	  $("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
		  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	  });
	});
	</script>
	<style>
	.dropdown{position:absolute;}
	</style>
</head>

<body id="main_body">
  <div class="container">
    <? 
	$_SESSION['menu']=3;
	include 'menu.php'; 
	?>
	<div class="panel panel-primary" style="margin-top: 10px;">
	<div class="panel-heading ">
		<h4>Listado de usuarios</h4>
		<form class="panel-heading-left" action="#">
		  <div class="form-group">
			<input id="myInput" type="text" class="form-control" placeholder="busqueda">
		  </div>
		  <button type="submit" class="btn btn-default">buscar</button>
		</form>		
	</div>
	<div class="panel-body table-responsive text-nowarp">
	<table class="table table-striped table-hover table-responsive table-condensed" style="font-size:12px;">
	<thead>
	<tr>
		<th>Tipo</th>
		<th>Nombre y Apellido</th>
		<th>Documento</th>
		<th>Teléfono</th>
		<th>Celular</th>
		<th>Email</th>
	</tr>
	</thead>
	<tbody  id="myTable">
	<?
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
	?>
	<tr>
	<td>
		<? switch($row['tipousuario']){
			case 1:
				echo '<span title="Profesional Administrador">PA</span>';
				break;
			case 2:
				echo '<span title="Profesional">P</span>';
				break;
			case 3:
				echo '<span title="Administrador">A</span>';
				break;
			case 4:
				echo '<span title="Consultas">C</span>';
				break;
		}
		?>
	</td>
	<td>
		<div class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown">
			<?= $row['apellido'].','.$row['nombre']; ?>
			<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<? 
				if($_SESSION['tipousuario']==1 || $_SESSION['tipousuario']==3){
				?>
				<li><a href="form_carga_datos_usuario.php?<?=encryptLink('id='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Modificar legajo</a></li>
				<?if($row['id']!=$_SESSION['id']){?>
				<li><a href="form_elimina_datos_usuario.php?<?=encryptLink('id='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Eliminar legajo</a></li>
				<?
				}
				}
				?>
				
			</ul>
		</div>	
		
	</td>
	<td>
		<? switch ($row['tipodocumento']) {
			case 1:
				echo "DNI";
				break;
			case 2:
				echo "LC";
				break;
			case 3:
				echo "LE";
				break;
			case 4:
				echo "CI";
				break;

			}
			echo ' '. sprintf("%'.08d", $row['numerodocumento']);
		?>
	</td>
	<td><?= $row['telefono']; ?></td>
	<td><?= $row['celular']; ?></td>
	<td><?= $row['email']; ?></td>
	</tr>
	<?
	}
	?>
	</tbody>
	</table>
	</div>

    <div class="panel-footer">
      Clinical
    </div>
  
  </div>
  </div>
</body>
</html>
<?
}else{
	echo "Error al intentar cargar listado de usuarios.";
}
mysqli_close($conexion);
exit;
?>
