<?php
include 'session.php';
include 'conexion.php';


	//consulto datos usuario
	$sql = "SELECT * FROM mm_pacientes WHERE id=".$_GET['id_paciente'];
	$result = $conexion->query($sql);
	$row_pacientes = $result->fetch_array(MYSQLI_ASSOC);
	
	//consulto datos historias y fichas
	$sql = "SELECT * FROM mm_historiasclinicas WHERE paciente=".$_GET['id_paciente'];

if($result = $conexion->query($sql)){
if ($result->num_rows > 0){
	$i=1;
	$j=1;
	while ($row_historia = $result->fetch_array(MYSQLI_ASSOC)){
		$historia[$i]=$row_historia;
		//consulto datos fichas
		$sql = "SELECT * FROM mm_fichahistoria WHERE historiaclinica=".$historia[$i]['id'];
		if($result_ficha = $conexion->query($sql)){
			while ($row_ficha = $result_ficha->fetch_array(MYSQLI_ASSOC)){
				$ficha[$i][$j]=$row_ficha;
				$j++;
			}
		}else{
			echo $sql.' - '.$conexion->error;
		}
		
		$i++;
	}
}else{
	echo "Sin historias asociadas.";
}
}else{
	echo $sql.' - '.$conexion->error;
}

if ($i > 0) {   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="es-AR">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Historia Clínica</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
        
		console.log( "document loaded" );
		window.print();
		
		
    });

</script>
  
</head>

<body id="main_body">
  <div class="container">
	<div class="panel panel-primary" style="margin-top: 10px;">
	<div class="panel-heading ">
		<h3>Historia Clínica</h3>
	</div>
	<div class="panel-body">
		<?
			$k=1;
			$l=1;
		?>
		<div class="row">
		<div class="col-xs-12">
			Paciente:<?= $row_pacientes['apellido'].', '.$row_pacientes['nombre']; ?>
			| Documento:<?= $row_pacientes['documento']; ?>			
			| Historia clínica:<?= $row_pacientes['documento'].'-'.$k; ?>
		</div>
		</div>
		<hr>
		<?
		if ($_SESSION['tipousuario']){
		?>
				<div class="row">
				<div class="col-xs-12">
					<label class="control-label">Comentarios:</label>
					<p id="element_1" class="form-control-static" ><?= $historia[$k]['comentarios']; ?></p>
				</div>
				</div>
		<?
		}
		?>
		<div "well well-dedault"><strong>Se muestran <?=($j-1)?> evoluciones.</strong></div>
		<div class="panel-group d-print-none">
		<?
		
		//Muestro todas las evoluciones
		for ($l=$j-1;$l>0;$l--){
		?>
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h5 class="panel-title">
				<?="Nro. ".$l."/".($j-1)?> | Evolución de fecha <?= date("d/m/Y", strtotime($ficha[$k][$l]['fechaficha'])); ?>
			  </h5>
			</div>
				<div class="panel-body" style="word-break:break-word;">
					<?
						$sql = "SELECT * FROM mm_usuarios WHERE id=" . $ficha[$k][$l]['usuariocarga'];
						if($result_medico = $conexion->query($sql)){
							$row_medico = $result_medico->fetch_array(MYSQLI_ASSOC);
							
						}else{
							$mensajes[] = "ERROR en cosulta medico.<br/> SQL: ". $sql.' - '.$conexion->error;
						}
					?>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p>Cargado por: <strong><?= $row_medico['nombre']." ".$row_medico['apellido']. "</strong>  |  Matricula: <strong>". $row_medico['matricula'] ; ?></strong></p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Antecedentes patológicos</strong>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p class="text-justify">
						<?= $ficha[$k][$l]['antecedentespatologicos']; ?>
					</p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Examen fisico</strong>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p class="text-justify">
						<?= $ficha[$k][$l]['examenfisico']; ?>
					</p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Motivo</strong>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p class="text-justify">
						<?= $ficha[$k][$l]['motivo']; ?>
					</p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Impresión diagnosticada</strong>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p class="text-justify">
						<?= $ficha[$k][$l]['impresiondiagnosticada']; ?>
					</p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Estudios complementarios</strong>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p class="text-justify">
						<?= $ficha[$k][$l]['estudioscomplementarios']; ?>
					</p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Tratamiento</strong>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p class="text-justify">
						<?= $ficha[$k][$l]['tratamiento']; ?>
					</p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Comentarios</strong>
					<hr style="margin-top:0;margin-bottom:5px;">
					<p class="text-justify">
						<?= $ficha[$k][$l]['comentario']; ?>
					</p>
					<hr style="margin-top:0;margin-bottom:5px;">
					<strong>Adjunto</strong>
						<?
						$sql = "SELECT * FROM mm_adjuntosficha WHERE ficha=" . $ficha[$k][$l]['id'];
						if($result_adjunto = $conexion->query($sql)){
							while ($row_adjunto = $result_adjunto->fetch_array(MYSQLI_ASSOC)){
								echo "<p><a href='". $row_adjunto['archivo'] ."'>". substr($row_adjunto['archivo'], strpos($row_adjunto['archivo'], '/', 2)) ."</a></p>";
							}
						}else{
							echo $sql.' - '.$conexion->error;
						}
						?>
				</div>
		  </div>
		<?
		}
		?>
		</div>

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
	$mensajes[] = "Error al intentar cargar datos de Historias Clínicas.";
}
mysqli_close($conexion);
exit;
?>
