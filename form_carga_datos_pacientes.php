<?php
include 'session.php';
include 'conexion.php';
include 'funciones.php';

parse_str(decryptLink(),$query_params);extract($query_params);
if(empty($check)){
	$_SESSION['mensaje']= "ACCESO RESTRINGIDO";
	$_SESSION['url']= "logout.php";
	header('Location: mensaje.php',true,303);
	exit;
}

$sql = "SELECT * FROM mm_pacientes WHERE id=".$id;
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
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
</head>

<body id="main_body">
  <div class="container">
  <? include 'menu.php'; ?>  
	<div class="panel panel-info" style="margin-top: 10px;">
	<div class="panel-heading ">
		<h2>Pacientes</h2>
		<p>Carga y modificación de pacientes.</p>
	</div>
	<div class="panel-body">
	<form id="form_pacientes" class="input-sm" method="post" action="carga_datos_pacientes.php">
	
	<input name="id" type="hidden" value="<?=$id;?>" />
	
	<div class="row">	
		<div class="col-xs-6">
			<p>
			<label>Documento:</label>
			<? 
			switch ($row['tipodocumento']) {
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
			echo " ".sprintf("%'.08d", $row['documento']);
			?>
			</p>
			<p>
			<label>Nombre y Apellido:</label>
			<?
				echo " ".$row['nombre']." ".$row['apellido'];
			?>
			</p>
		</div>
		<div class="col-xs-6">
			<p><label >Sexo:</label><?=" ".$row['sexo'];?></p>
			<p><label>Fecha nacimiento: </label><?=$row['fechanacimiento']; ?></p>
		</div>
	</div>
	
	<div class="row">
	<div class="col-xs-12">
		<h4>Domicilio</h4>
		<div class="form-group">
			<label class="" for="element_7_1">Direccion</label>
			<input id="element_7_1" name="direccion" class="form-control" value="<?= $row['direccion']; ?>" type="text" />
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-xs-5">
			<div class="form_group">
			<label for="element_7_4">Provincia</label>
			<select id="element_7_4" name="provincia" class="form-control">;
				<?php
				$conexion2 = new mysqli($host_db, $user_db, $pass_db, $db_name);
				if ($conexion2->connect_error) {
					die("La conexion falló: " . $conexion->connect_error);
				}
				$sql = "SELECT provincia_id as id, provincia_nombre as nombre FROM mm_provincias";
				$result = $conexion2->query($sql);
				while ($row2 = $result->fetch_array(MYSQLI_ASSOC)){
					echo '<option value="'.$row2['id'].'" ';
					if($row['provincia']==$row2['id']){echo 'selected="selected"';}
					echo '>'.$row2['nombre'].'</option>';
				}
				mysqli_close($conexion2); 
				?>
			</select>
			</div>
		</div>
		<div class="col-xs-5">
			<div class="form_group">
				<label class="" for="element_7_3">Localidad</label>
				<input id="element_7_3" name="localidad" class="form-control" value="<?= $row['localidad']; ?>" type="text" />
			</div>
		</div>
		<div class="col-xs-2">
			<div class="form-group">
				<label for="element_7_5">CP</label>
				<input id="element_7_5" name="codigopostal" class="form-control" maxlength="15" value="<?= $row['codigopostal']; ?>" type="text" />
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-4">
		<div class="form-group">
			<label  for="element_8">Teléfono</label>
			<input id="element_8" name="telefono" class="form-control" type="tel" maxlength="30" value="<?= $row['telefono']; ?>" />
			
		</div>
		</div>
		<div class="col-xs-4">
		
		<div class="form-group">
			<label  for="element_9">Celular</label>
			<input id="element_9" name="celular" class="form-control" type="tel" maxlength="30" value="<?= $row['celular']; ?>" />
			
		</div>
		</div>
		<div class="col-xs-4">		
		<div class="form-group">
			<label for="element_14">Email</label>
			<input id="element_14" name="email" class="form-control" value="<?= $row['email']; ?>" type="email" placeholder="email" />
		</div>
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		<div class="col-xs-4">
		<div class="form-group">
			<label for="element_15" class="small">Grupo sanguineo</label>
			<select class="form-control" id="element_15" name="gruposanguineo" required>
				<option value="0" <? if($row['gruposanguineo']==1){echo 'selected="selected"';} ?>>--</option>
				<option value="1" <? if($row['gruposanguineo']==1){echo 'selected="selected"';} ?>>A+</option>
				<option value="2" <? if($row['gruposanguineo']==2){echo 'selected="selected"';} ?>>A-</option>
				<option value="3" <? if($row['gruposanguineo']==3){echo 'selected="selected"';} ?>>B+</option>
				<option value="4" <? if($row['gruposanguineo']==4){echo 'selected="selected"';} ?>>B-</option>
				<option value="5" <? if($row['gruposanguineo']==5){echo 'selected="selected"';} ?>>AB+</option>
				<option value="6" <? if($row['gruposanguineo']==6){echo 'selected="selected"';} ?>>AB-</option>
				<option value="7" <? if($row['gruposanguineo']==7){echo 'selected="selected"';} ?>>0+</option>
				<option value="8" <? if($row['gruposanguineo']==8){echo 'selected="selected"';} ?>>0-</option>
			</select>
		</div>
		</div>
		<div class="col-xs-4">
		<div class="form-group">
		<label for="element_16">Obra social</label>
		<input id="element_16" name="obrasocial" class="form-control" value="<?= $row['obrasocial']; ?>" type="text" placeholder="obra social" />
		</div>
		</div>
		<div class="col-xs-4">
		<div class="form-group">
		<label for="element_17">Numero de afiliado</label>
		<input id="element_17" name="numeroafiliado" class="form-control" value="<?= $row['numeroafiliado']; ?>" type="text" placeholder="" />
		</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label for="element_13">Fecha fallecimiento</label>
				<input id="element_13" name="fechafallecimiento" class="form-control" type="date" value="<?= ($row['fechafallecimiento']!='')?($row['fechafallecimiento']):''; ?>" placeholder="01/01/1950" />
			</div>
		</div>
		<div class="col-xs-4">
			<div class="form-group">
				<label for="element_13">Fecha baja</label>
				<input id="element_13" name="fechabaja" class="form-control" type="date" value="<?= ($row['fechabaja']!='')?($row['fechabaja']):''; ?>" placeholder="01/01/2019" />
			</div>
		</div>
	</div>
	
	<hr>
	<h5>Responsable</h5>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
			<label for="element_19">Nombre y Apellido</label>
			<input id="element_19" name="responsable_nombre" class="form-control" type="text" maxlength="30" value="<?= $row['responsable_nombre']; ?>" required/>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-4">
			<div class="form-group">
				<label  for="element_19">Tipo y númer de documento</label>
				<input id="element_19" name="responsable_doc" class="form-control" type="text" maxlength="11" value="<?= $row['responsable_doc']; ?>" required />
				
			</div>
		</div>
		<div class="col-xs-4">
			<div class="form-group">
				<label  for="element_20">Teléfono</label>
				<input id="element_20" name="responsable_tel" class="form-control" type="tel" maxlength="20" value="<?= $row['responsable_tel']; ?>" required />
				
			</div>
		</div>
		<div class="col-xs-4">		
			<div class="form-group">
				<label for="element_21">Email</label>
				<input disabled id="element_21" name="responsable_email" class="form-control" value="" type="email" placeholder="email" />
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
			<label for="element_22">Dirección completa</label>
			<input id="element_23" name="responsable_dir" class="form-control" type="text" maxlength="50" value="<?= $row['responsable_dir']; ?>" required/>
			</div>
		</div>
	</div>

	<hr>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
				<label for="element_18">Comentarios</label>
				<textarea class="form-control" rows="5" id="element_18" name="comentarios" placeholder="comentarios" value="<?= $row['comentarios']; ?>"><?= $row['comentarios']; ?></textarea>
			</div>
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		<div class="col-xs-1">
			<button id="saveForm" class="btn btn-default" type="submit">Cargar</button>
		</div>
	</div>
    </form>
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
	echo "Error al intentar cargar datos del usuario.";
}
mysqli_close($conexion);
exit;
?>
