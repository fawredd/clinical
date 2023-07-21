<?php
include 'conexion.php';
?>            
			<select name="localidad">;
					<?
					$sql = "SELECT id as id_localidad, nombre as nombre_localidad FROM mm_localidades";
					$result = $conexion->query($sql);
					while ($row = $result->fetch_array(MYSQLI_ASSOC)){
						echo '<option value="'.$row['id_localidad'].'">'.$row['nombre_localidad'].'</option>';
					}
				?>
			</select>
<?
mysqli_close($conexion);
?>