<?php
include 'session.php';
include 'conexion.php';

if ($_SESSION['tipousuario']!=1 && $_SESSION['tipousuario']!=3){
	$_SESSION['mensaje']= "ACCESO RESTRINGIDO";
	$_SESSION['url']= "logout.php";
	header('Location: mensaje.php',true,303);
	exit;
}

//$sql = "SELECT * FROM mm_usuarios WHERE id=".$_GET['id'];
//$result = $conexion->query($sql);
//$row = $result->fetch_array(MYSQLI_ASSOC);
//if ($result->num_rows > 0) {
if(1){
?>
<!DOCTYPE html>

<html lang="es-AR">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Usuarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(function() {   
		$("#element_11").on("change",function(e){
			var valor = $(this).val();
			console.log(valor);
			if(valor==2 || valor==1){
				$("#element_20").prop("disabled",false);
				$("#element_21").prop("disabled",false);
			} else {
				$("#element_20").val("");
				$("#element_20").prop("disabled",true);
				$("#element_21").val("");
				$("#element_21").prop("disabled",true);
			}
		});
	});
</script>
</head>

<body id="main_body">
  <div class="container">
  <? 
	$_SESSION['menu']=4;
	include 'menu.php'; 
  ?>
	
	<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="form-description">
			<h3>Nuevo Usuario</h3>
		</div>
	</div>
	<div class="panel-body">
	<form id="form_usuarios" method="post" action="carga_nuevo_usuario.php">
	
	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label class="control-label" for="element_11" >Tipo de usuario</label>
				<select class="form-control" id="element_11" name="tipousuario">
					<option value="1">
						Profesional Administrador
					</option>
					<option value="2">
						Profesional
					</option>
					<option value="3" selected="selected">
						Administrador
					</option>
					<option value="4" selected="selected">
						Consultas
					</option>
				</select>
			</div>	
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label class="control-label" for="element_16" >Contraseña</label>	
				<input id="element_16" name="clave" class="form-control" type="password" value="" required/>
			</div>
		</div>

	</div>
	<div class="row">	
		<div class="col-sm-2">
		<div class="form-group">
			<label class="control-label" for="element_13">Tipo Doc.</label>
			<select class="form-control " id="element_13" name="tipodocumento">
				<option value="1" selected="selected">DNI</option>
				<option value="2">LC</option>
				<option value="3">LE</option>
				<option value="4">CI</option>
			</select>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="form-group">
			<label for="element_10">Nro. de documento</label>
			<input id="element_10" name="numerodocumento" class="form-control" type="text" maxlength="8" minlength="8" value="" placeholder="05222333" required/>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="form-group">
			<label for="element_20">Matrícula</label>
			<input id="element_20" name="matricula" class="form-control" type="text" value="" placeholder="" disabled required/>
		</div>
		</div>
		<div class="col-sm-3">
		<div class="form-group">
			<label for="element_21">Especialidad</label>
			<input id="element_21" name="especialidad" class="form-control" type="text" value="" placeholder="" disabled required/>
		</div>
		</div>

	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="element_1">Nombre</label>
				<input id="element_1" name="nombre" class="form-control" type="text" maxlength="30" value="" placeholder="Nombre" required/>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="element_2">Apellido</label>
				<input id="element_2" name="apellido" class="form-control" type="text" maxlength="30" value="" placeholder="Apellido" required/>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<h4>Domicilio</h4>
			<div class="form-group">
				<label class="" for="element_7_1">Direccion</label>
				<input id="element_7_1" name="direccion" class="form-control" value="" placeholder="direccion" type="text" required />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="element_7_4">Provincia</label>
				<select id="element_7_4" name="provincia" class="form-control" required>;
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
		<div class="col-sm-5">
			<div class="form-group">
				<label class="" for="element_7_3">Localidad</label>
				<input id="element_7_3" name="localidad" class="form-control" value="" placeholder="Localidad" type="text" required/>
			</div>
		</div>
		<div class="col-sm-1">
			<div class="form-group">
				<label for="element_7_5">CP</label>
				<input id="element_7_5" name="codigopostal" class="form-control" maxlength="15" value="" placeholder="1000" type="text" />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label  for="element_8">Teléfono</label>
				<input id="element_8" name="telefono" class="form-control" type="tel" maxlength="30" value="" placeholder="011 4801-3333" />
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label  for="element_9">Celular</label>
				<input id="element_9" name="celular" class="form-control" type="tel" maxlength="30" value="" placeholder="011 15-22223333" />
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="element_14">Email</label>
				<input id="element_14" name="email" class="form-control" value="" type="email" placeholder="email" required/>
			</div>
		</div>
	</div>
	
	<hr>

	<div class="form-group">
		<input id="saveForm" class="btn btn-succsess" type="submit" name="submit" value="Cargar" />
	</div>
    </form>

	</div>

    <div class="panel-footer">
      Clinical
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
