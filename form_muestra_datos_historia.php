<?php
include 'session.php';
include 'conexion.php';

include 'funciones.php';

parse_str(decryptLink(), $output);
$check = $output['check'];
$id_paciente = $output['id_paciente'];

if(empty($check)){
	$_SESSION['mensaje']= "ACCESO RESTRINGIDO";
	$_SESSION['url']= "logout.php";
	header('Location: mensaje.php',true,303);
	exit;
}


	//consulto datos usuario
	$sql = "SELECT * FROM mm_pacientes WHERE id=".$id_paciente;
	$result = $conexion->query($sql);
	$row_pacientes = $result->fetch_array(MYSQLI_ASSOC);
	
	//consulto datos historias y fichas
	$sql = "SELECT * FROM mm_historiasclinicas WHERE paciente=".$id_paciente;

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
  <script type="text/javascript" src="jquery-barcode.min.js"></script>
<script>
	$(function() {   
		 $("#barcode").barcode(
			"<?= sprintf("%'.013d", $row_pacientes['tipodocumento'].$row_pacientes['documento'])?>", // Valor del codigo de barras
			"ean13" // tipo (cadena)
		);
		
	   var beforePrint = function() {
			window.location.replace("form_print_datos_historia.php?id_paciente=<?=$id_paciente;?>");
			console.log('Functionality to run before printing.');
			return false;
		};
		var afterPrint = function() {
			console.log('Functionality to run after printing');
		};

		if (window.matchMedia) {
			var mediaQueryList = window.matchMedia('print');
			mediaQueryList.addListener(function(mql) {
				if (mql.matches) {
					beforePrint();
				} else {
					afterPrint();
				}
			});
		}
		
	});
</script>
  
</head>

<body id="main_body">
  <div class="container">
  <? include 'menu.php'; ?>
	<div class="panel panel-primary" style="margin-top: 10px;">
	<div class="panel-heading ">
		<h2>Historia Clínica</h2>
	</div>
	
	<div class="panel-body">
		<?
			$k=1;
			$l=1;
		?>
		<div class="form-group form-inline">
			<div id="barcode"></div>
			<label class="control-label">Paciente:</label>
			<p class="form-control-static"><?= $row_pacientes['apellido'].', '.$row_pacientes['nombre']; ?></p>

			<label class="control-label">| Documento:</label>
			<p class="form-control-static"><?= $row_pacientes['documento']; ?></p>
			
		</div>
		<?
		if ($_SESSION['tipousuario']){
		?>
			<form id="form_comentario_historia" method="post" enctype="multipart/form-data" action="carga_comentario_historia.php">
				<div class="form-group">
					<label class="control-label">Comentarios:</label>
					<textarea rows="5" id="element_1" name="comentario_historia" class="form-control" type="text" value="<?= $historia[$k]['comentarios']; ?>" placeholder="comentario" ><?= $historia[$k]['comentarios']; ?></textarea>
					<input type="hidden" name="id_paciente" value="<?= $id_paciente; ?>" />
					<input type="hidden" name="id_historia" value="<?= $historia[$k]['id']; ?>" />
					<input type="submit" id="submit_01" class="btn btn-default btn-sm" />
				</div>
			</form>
		<?
		}
		?>
	
		<div class="panel-group d-print-none" id="accordion">
		  	<?
			if ($_SESSION['tipousuario']==2 || $_SESSION['tipousuario']==1){
			?>
		    <div class="panel panel-primary">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
				Cargar nueva evolución.</a>
			  </h4>
			</div>
			<div id="collapse0" class="panel-collapse collapse">
			  <div class="panel-body">
				<form id="form_evolucion" method="post" enctype="multipart/form-data" action="carga_datos_evolucion.php">

					<? 
					//$_SESSION['id_historia']=$historia[$k]['id'];
					//$_SESSION['id_paciente']=$_GET['id_paciente'];
					?>
					<input type="hidden" name="id_paciente" value="<?= $id_paciente; ?>" />
					<input type="hidden" name="id_historia" value="<?= $historia[$k]['id']; ?>" />
					<div class="form-group">
					<label for="element_5">Datos: </label>
					<textarea rows="7" id="element_5" name="datos" class="form-control" type="text" value="" placeholder="" ></textarea>
					</div>

					<div class="form-group">
					<label for="element_11">Comentario: </label>
					<textarea rows="5" id="element_11" name="comentario" class="form-control" type="text" value="" placeholder="comentarios" ></textarea>
					</div>
					
					<div class="form-group">
						<label for="inputGroupFileAddon">Adjunto</label>
						<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
						<input type="file" id="inputGroupFile"name="myfile">
					</div>

					<input type="submit" name="submit" class="btn btn-success" />
				</form>
			  </div>
			</div>
		  </div>
		<?
			}
		//Muestro todas las evoluciones
		for ($l=$j-1;$l>0;$l--){
		?>
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $l; ?>">
				Evolución de fecha <?= date("d/m/Y", strtotime($ficha[$k][$l]['fechaficha'])); ?></a>
			  </h4>
			</div>
			<div id="collapse<?= $l; ?>" class="panel-collapse <?= ($l==$j-1)?' class="collapse.show" ':'collapse';?>">
				<div class="panel-body" style="word-break:break-word;">
					<?
						$sql = "SELECT * FROM mm_usuarios WHERE id=" . $ficha[$k][$l]['usuariocarga'];
						if($result_medico = $conexion->query($sql)){
							$row_medico = $result_medico->fetch_array(MYSQLI_ASSOC);
							
						}else{
							$mensajes[] = "ERROR en cosulta medico.<br/> SQL: ". $sql.' - '.$conexion->error;
						}
					?>
					<div class="well well-sm">Cargado por: <strong><?= $row_medico['nombre']." ".$row_medico['apellido']. "</strong>  -  Matricula: <strong>". $row_medico['matricula'] ; ?></strong></div>
					<h5><strong>Datos cargados</strong></h5>
					<p class="text-justify">
						<?= $ficha[$k][$l]['datos']; ?>
					</p>
					
					<h5><strong>Comentarios</strong></h5>
					<p class="text-justify">
						<?= $ficha[$k][$l]['comentario']; ?>
					</p>
					
					<h5><strong>Adjuntos</strong></h5>
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
