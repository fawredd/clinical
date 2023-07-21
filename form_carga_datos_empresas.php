<?php
include 'session.php';
include 'conexion.php';

$sql = "SELECT * FROM mm_usuarios WHERE id=".$_GET['id'];
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($result->num_rows > 0) {   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Usuarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body id="main_body">
  <div class="container">
	<div class="panel panel-primary" style="margin-top: 10px;">
	<div class="panel-heading ">
		<h2>Empresas</h2>
		<p>Carga y modificación de empresas.</p>
	</div>
	<div class="panel-body">
	<form id="form_pacientes" class="input-sm" method="post" action="carga_datos_empresas.php">
	
	<input name="id" type="hidden" value="<?= $_GET['id']; ?>" />
	
	<div class="form-group">
		<label for="element_1">CUIT</label>
		<input id="element_1" name="CUIT" class="form-control" type="text" maxlength="13" minlength="13" value="<?= $row['cuit']; ?>" placeholder="30-22228888-0" required/>
	</div>
	<div class="form-group">
		<label for="element2">Denominacion</label>
		<input id="element_2" name="denominacion" class="form-control" type="text" maxlength="30" value="<?= $row['denominacion']; ?>" placeholder="Empresa s.a." required/>
	</div>

	<div class="row">
	<div class="col-sm-12">
	<div class="form-group">
		<h4>Domicilio</h4>
		<div>
			<input id="element_7_1" name="direccion" class="form-control" value="<?= $row['direccion']; ?>" type="text" />
			<label class="" for="element_7_1">Direccion</label>
		</div>
	
		<div class="row">
		<div class="col-sm-6">
			<select id="element_7_4" name="provincia" class="form-control">;
				<?php
				$conexion2 = new mysqli($host_db, $user_db, $pass_db, $db_name);
				if ($conexion2->connect_error) {
					die("La conexion falló: " . $conexion->connect_error);
				}
				$sql = "SELECT provincia_id as id, provincia_nombre as nombre FROM mm_provincias";
				$result = $conexion2->query($sql);
				while (0 && $row2 = $result->fetch_array(MYSQLI_ASSOC)){
					echo '<option value="'.$row2['id'].'" ';
					if($row['provincia']==$row2['id']){echo 'selected="selected"';}
					echo '>'.$row2['nombre'].'</option>';
				}
				mysqli_close($conexion2); 
				?>
			</select>
			<label for="element_7_4">Provincia</label>
		</div>

		<div class="col-sm-6">
			<select id="element_7_3" name="localidad" class="form-control">;
				<?php
				$conexion2 = new mysqli($host_db, $user_db, $pass_db, $db_name);
				if ($conexion2->connect_error) {
					die("La conexion falló: " . $conexion2->connect_error);
				}
				$sql = "SELECT mm_localidades.id as id_localidad, mm_localidades.nombre as nombre_localidad, mm_provincias.provincia_nombre FROM mm_localidades INNER JOIN mm_provincias ON mm_localidades.provincia_id=mm_provincias.provincia_id ORDER BY mm_provincias.provincia_nombre,mm_localidades.nombre";
				$result = $conexion2->query($sql);
				while (00 && $row2 = $result->fetch_array(MYSQLI_ASSOC)){
					echo '<option value="'.$row2['id_localidad'].'" ';
					if($row['localidad']==$row2['id_localidad']){echo 'selected="selected"';}
					echo '>'.$row2['nombre_localidad'].'->'.$row2['provincia_nombre'].'</option>';
				}
				mysqli_close($conexion2); 
				?>
			</select>
			<label for="element_7_3">Localidad</label>
		</div>
		</div>
		
		<div class="row">
		<div class="form-group col-sm-2">
			
			<input id="element_7_5" name="codigopostal" class="form-control" maxlength="15" value="<?= $row['cp']; ?>" type="text" />
			<label for="element_7_5">CP</label>
		</div>
	
		<div class="form-group col-sm-5">
			
			<input id="element_8" name="telefono" class="form-control" type="text" maxlength="30" value="<?= $row['telefono']; ?>" />
			<label  for="element_8">Teléfono</label>
		</div>
		
		</div>
	</div>
		
    <div class="form-group">
		<input class="btn btn-primary" type="submit" name="submit" value="Enviar" />
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
	echo "Error al intentar cargar datos del usuario.";
}
mysqli_close($conexion);
exit;
?>
