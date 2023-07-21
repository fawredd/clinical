<?php
include 'session.php';
include 'conexion.php';
include 'funciones.php';

$sql = "SELECT * FROM mm_pacientes ORDER BY apellido";
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
	.dropdown{
		position:absolute;
	}
	</style>
</head>

<body id="main_body">
  <div class="container">
    <? 
	$_SESSION['menu']=2;
	include 'menu.php'; 
	?>
	<div class="panel panel-primary" style="margin-top: 10px;">
	<div class="panel-heading ">
		<h4>Listado de acientes</h4>
		<form class="panel-heading-left" action="#">
		  <div class="form-group">
			<input id="myInput" type="text" class="form-control" placeholder="busqueda">
		  </div>
		  <button type="submit" class="btn btn-default">buscar</button>
		</form>		
	</div>
	<div class="panel-body table-responsive text-nowarp">
	<table class="table table-striped table-hover table-responsive table-condensed" style="font-size:12px;margin-bottom:50px;">
	<thead>
	<tr>
		<th colspan="3">Paciente</th>
		<th colspan="3">Responsable</th>
	</tr>
	<tr>
		<th style="white-space: nowrap;">Nombre y Apellido</th>
		<th>Documento</th>
		<th>Nacimiento</th>
		<th>Nombre y Apellido</th>
		<th>Teléfono</th>
		<th>Dirección</th>
	</tr>
	</thead>
	<tbody  id="myTable">
	<?
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
	?>
	<tr>
	<td style="white-space: nowrap;">
		<div class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown">
			<?= $row['apellido'].','.$row['nombre']; ?>
			<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="form_muestra_datos_historia.php?<?=encryptLink('links=1&id_paciente='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Historia clinica</a></li>
				<li><a href="form_muestra_indicaciones.php?<?=encryptLink('links=1&id_paciente='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Indicaciones médicas</a></li>
				<li><a href="form_muestra_datos_nutricion.php?<?=encryptLink('links=1&id_paciente='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Nutrición</a></li>
				<li><a href="form_muestra_datos_pacientes.php?<?=encryptLink('id='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Mostrar legajo</a></li>
				<? 
				if($_SESSION['tipousuario']==1 || $_SESSION['tipousuario']==3){
				?>
				<li><a href="form_carga_datos_pacientes.php?<?=encryptLink('id='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Modificar legajo</a></li>
				<li><a href="form_elimina_datos_pacientes.php?<?=encryptLink('id='.$row['id'].'&check=1&rnd='.rand(0,9)); ?>">Eliminar legajo</a></li>
				<?
				} ?>
				
			</ul>
		</div>	
		
	</td>
	<td style="white-space: nowrap;">
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
			echo ' '. sprintf("%'.08d", $row['documento']);
		?>
	</td>
	<td style="white-space: nowrap;"><?= calculaedad($row['fechanacimiento'])." años / ". date("d-m-Y", strtotime($row['fechanacimiento'])); ?></td>
	<td style="white-space: nowrap;"><?= $row['responsable_nombre']; ?></td>
	<td style="white-space: nowrap;"><?= $row['responsable_tel']; ?></td>
	<td style="white-space: nowrap;"><?= $row['responsable_dir']; ?></td>
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
	$_SESSION['mensaje'] = "Listado de pacientes vacio.";
	$_SESSION['url']="panel-control.php";
	mysqli_close($conexion);
	header('Location: mensaje.php',true,303);
	exit;
}
mysqli_close($conexion);
exit;

function calculaedad($fechanacimiento){
  list($ano,$mes,$dia) = explode("-",$fechanacimiento);
  $ano_diferencia  = date("Y") - $ano;
  $mes_diferencia = date("m") - $mes;
  $dia_diferencia   = date("d") - $dia;
  if ($dia_diferencia < 0 || $mes_diferencia < 0)
    $ano_diferencia--;
return $ano_diferencia;
}
?>
