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

parse_str(decryptLink(),$query_params);
extract($query_params);
if(empty($check)){
	$_SESSION['mensaje']= "ACCESO RESTRINGIDO";
	$_SESSION['url']= "logout.php";
	header('Location: mensaje.php',true,303);
	exit;
}

$sql = "SELECT * FROM mm_usuarios WHERE id=".$id;
$result = $conexion->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($result->num_rows > 0) {
?>
<!DOCTYPE html>

<html>
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
  <? 
	$_SESSION['menu']=4;
	include 'menu.php'; 
	?>
	
	<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="form-description">
			<h3>Usuarios</h3>
			<p>Carga y modificación de usuarios.</p>
		</div>
	</div>
	<div class="panel-body">
	<form id="form_usuarios" method="post" action="carga_datos_usuario.php">
	
	<input name="id" type="hidden" value="<?= $id; ?>" />
	
	<div class="row">
		<div class="col-sm-12">
			<p>
				<label>Tipo de usuario: </label>
				<? switch($row['tipousuario']){
						case 1:
							echo 'Profesional Admin';
							break;
						case 2:
							echo 'Profesional';
							break;
						case 3:
							echo 'Administrador';
							break;
						case 4:
							echo 'Consultas';
							break;
				}
				if ($row['tipousuario']==2 || $row['tipousuario']==1){
						echo " | <label>Matricula:</label> " . $row['matricula']. " | <label>Especialidad:</label> ".$row['especialidad'];
				}
				?>
			</p>
		</div>
	</div>
	<div class="row">	
		<div class="col-sm-12">
			<p>
			<label>Documento: </label>
			<? switch($row['tipodocumento']){
				case 1:
					echo 'DNI ';
					break;
				case 2:
					echo 'LC ';
					break;
				case 3:
					echo 'LE ';
					break;
				case 4:
					echo 'CI ';
					break;
			}
			echo $row['numerodocumento'];
			echo " | <label>Nombre y Apellido:</label>";
			echo " ".$row['nombre']." ".$row['apellido'];
			?>
			</p>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<h4>Domicilio</h4>
			<div class="form-group">
				<label class="" for="element_7_1">Direccion</label>
				<input id="element_7_1" name="direccion" class="form-control" value="<?= $row['direccion']; ?>" type="text" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
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
		<div class="col-sm-5">
			<div class="form-group">
				<label class="" for="element_7_3">Localidad</label>
				<input id="element_7_3" name="localidad" class="form-control" value="<?= $row['localidad']; ?>" type="text" />
			</div>
		</div>
		<div class="col-sm-1">
			<div class="form-group">
				<label for="element_7_5">CP</label>
				<input id="element_7_5" name="codigopostal" class="form-control" maxlength="15" value="<?= $row['cp']; ?>" type="text" />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<div class="form-group">
				<label  for="element_8">Teléfono</label>
				<input id="element_8" name="telefono" class="form-control" type="tel" maxlength="30" value="<?= $row['telefono']; ?>" />
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label  for="element_9">Celular</label>
				<input id="element_9" name="celular" class="form-control" type="tel" maxlength="30" value="<?= $row['celular']; ?>" />
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="element_14">Email</label>
				<input id="element_14" name="email" class="form-control" value="<?= $row['email']; ?>" type="email" placeholder="email" />
			</div>
		</div>
	</div>
	
	<hr>
	<div class="row">
	<div class="col-sm-12">
	<div class="form-group">
		<label for="element_18">Comentarios</label>
		<textarea class="form-control" rows="5" id="element_18" name="comentarios" placeholder="comentarios"><?= $row['comentarios']; ?></textarea>
	</div>
	</div>
	</div>
	<hr>
	<div class="row">
	<div class="col-sm-1">
	<button id="saveForm" class="btn btn-default" type="submit">Cargar</button>
	</div>
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
