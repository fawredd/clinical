<?php
include 'session.php';
include 'conexion.php';
if ($_SESSION['tipousuario']!=1 && $_SESSION['tipousuario']!=3){
	$_SESSION['mensaje']= "ACCESO RESTRINGIDO";
	$_SESSION['url']= "logout.php";
	header("Location:http://".$_SERVER['SERVER_NAME']."/clinical/mensaje.php",true,303);
	exit;
}

//$sql = "SELECT * FROM mm_pacientes WHERE id=".$_GET['id'];
//$result = $conexion->query($sql);
//$row = $result->fetch_array(MYSQLI_ASSOC);
//if ($result->num_rows > 0) {   
if (1){
?>
<!DOCTYPE html>

<html lang="es-AR">
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
	  $("#element_7_4").on("change", function() {
		var filter = $(this).val();
		$('#element_7_3 option').each(function() {
			if ($(this).attr('provincia') == filter) {
				$(this).show();
				//$(this).attr('selected','selected');
			} else {
				$(this).hide();
			}
		})
	  })
	
    </script>
  
</head>

<body id="main_body">
  <div class="container">
  <? include 'menu.php'; ?>
	<div class="panel panel-info" style="margin-top: 10px;">
	<div class="panel-heading ">
		<h2>Pacientes</h2>
		<p>Nuevo paciente.</p>
	</div>
	<div class="panel-body">
	<form id="form_pacientes" class="input-sm" method="post" action="carga_nuevo_paciente.php">
	
	<div class="row">	
	<div class="form-group col-xs-2">	
		<label for="element_13" class="small">Tipo Doc.</label>
		<select class="form-control" id="element_13" name="tipodocumento">
			<option value="1" >DNI</option>
			<option value="2" >LC</option>
			<option value="3" >LE</option>
			<option value="4" >CI</option>
		</select>
	</div>	

	<div class="form-group col-xs-4">
		<label for="element_10">Nro. de documento</label>
		<input id="element_10" name="documento" class="form-control" type="text" maxlength="8" minlength="8" value="" placeholder="05222333" required/>
	</div>
	<div class="form-group col-xs-offset-6">
		&nbsp;
	</div>
	</div>
	
	
	<div class="row">
	<div class="col-xs-6">
	<div class="form-group">
		<label for="element_1">Nombre</label>
		<input id="element_1" name="nombre" class="form-control" type="text" maxlength="30" value="" placeholder="Nombre" required/>
	</div>
	</div>
	<div class="col-xs-6">
	<div class="form-group">
		<label for="element_2">Apellido</label>
		<input id="element_2" name="apellido" class="form-control" type="text" maxlength="30" value="" placeholder="Apellido" required/>
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="col-xs-4">
	<div class="form-group">
		<label  for="element_11">Sexo</label>
		<select class="form-control" id="element_11" name="sexo">
			<option value="Masculino">
				Masculino
			</option>
			<option value="Femenino">
				Femenino
			</option>
			
		</select>
	</div>
	</div>
	<div class="form-group col-xs-4">
		<label for="element_12">Fecha nacimiento</label>
		<input id="element_12" name="fechanacimiento" class="form-control" type="date" value="" placeholder="01/01/1950" required/>
		
	</div>
	</div>
	
	<div class="row">
	<div class="col-xs-12">
	<div class="form-group">
		<h4>Domicilio</h4>
		<div>
		<label class="" for="element_7_1">Direccion</label>
		<input id="element_7_1" name="direccion" class="form-control" value="" placeholder="dirección" type="text" required/>

		</div>
	
		<div class="row">
		<div class="col-xs-6">
			<label for="element_7_4">Provincia</label>
			<select id="element_7_4" name="provincia" class="form-control" required>;
				<option value="">-</option>
				<?php
				$conexion2 = new mysqli($host_db, $user_db, $pass_db, $db_name);
				if ($conexion2->connect_error) {
					die("La conexion falló: " . $conexion->connect_error);
				}
				$sql = "SELECT provincia_id as id, provincia_nombre as nombre FROM mm_provincias";
				$result = $conexion2->query($sql);
				while ($row2 = $result->fetch_array(MYSQLI_ASSOC)){
					echo '<option value="'.$row2['id'].'" ';
					//if($row['provincia']==$row2['id']){echo 'selected="selected"';}
					echo '>'.$row2['nombre'].'</option>';
				}
				mysqli_close($conexion2); 
				?>
			</select>
			
		</div>

		<div class="col-sm-6">
			<div class="form-group">
				<label class="" for="element_7_3">Localidad</label>
				<input id="element_7_3" name="localidad" class="form-control" value="" placeholder="Localidad" type="text" required/>
			</div>
		</div>
		</div>
		
		<div class="row">
		<div class="form-group col-xs-2">
			<label for="element_7_5">CP</label>
			<input id="element_7_5" name="codigopostal" class="form-control" maxlength="15" value="" placeholder="1000" type="text" />
			
		</div>
	
		<div class="form-group col-xs-5">
			<label  for="element_8">Teléfono</label>
			<input id="element_8" name="telefono" class="form-control" type="tel" maxlength="30" value="" placeholder="011 5555-5555" />
			
		</div>
		
		<div class="form-group col-xs-5">
			<label  for="element_9">Celular</label>
			<input id="element_9" name="celular" class="form-control" type="tel" maxlength="30" value="" placeholder="011 15-55555555" />
			
		</div>
		</div>
		
		<div class="form-group">
			<label for="element_14">Email</label>
			<input id="element_14" name="email" class="form-control" value="" type="email" placeholder="email@dominio.com" />
		</div>
	</div>
	<hr>

		<div class="col">
			<div class="form-group">
				<label for="element_15" class="small">Grupo sanguineo</label>
				<select class="form-control" id="element_15" name="gruposanguineo" required>
					<option value="0" >--</option>
					<option value="1" >A+</option>
					<option value="2" >A-</option>
					<option value="3" >B+</option>
					<option value="4" >B-</option>
					<option value="5" >AB+</option>
					<option value="6" >AB-</option>
					<option value="7" >0+</option>
					<option value="8" >0-</option>
				</select>
			</div>
		</div>

	<div class="form-group">
		<label for="element_16">Obra social</label>
		<input id="element_16" name="obrasocial" class="form-control" value="" type="text" placeholder="obra social" />
	</div>
	<div class="form-group">
		<label for="element_17">Numero de afiliado</label>
		<input id="element_17" name="numeroafiliado" class="form-control" value="" type="text" placeholder="identificación como afiliado" />
	</div>
	<hr>
	<div class="form-group">
		<label for="element_18">Comentarios</label>
		<textarea class="form-control" rows="5" id="element_18"  placeholder="comentarios" name="comentarios"></textarea>
	</div	
	<hr>
    <div class="form-group">
		<input id="saveForm" class="button" type="submit" name="submit" value="Submit" />
	</div>
	
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
	$_SESSION['mensaje'] = "Listado de usuarios vacio.";
	$_SESSION['url']="http://".$_SERVER['SERVER_NAME']."/clinical/panel-control.php";
	mysqli_close($conexion);
header("Location:http://".$_SERVER['SERVER_NAME']."/clinical/mensaje.php",true,303);
	exit;
}
mysqli_close($conexion);
exit;
?>
