<?php

$db = new mysqli('localhost', 'usuario', 'contrasema', 'Base');
$query = $db->query('DESCRIBE `mm_pacientes`');
$fields = array();
while($row = $query->fetch_assoc()) {
    $fields[] = $row['Field'];
}

?>

<form id="form_evolucion" class="input-sm" method="post" action="carga_datos_evolucion.php">
    <?php 
		$i=0;
		foreach($fields as $field): 
	?>
        <div class="form-group">
			<label for="element_<?= $i; ?>"><?php echo "$field: "; ?></label>
			<input id="element_<?= $i; ?>" name="<?php echo $field; ?>" class="form-control" type="text" value="" placeholder="" />
		</div>

    <?php 
		$i++;
		endforeach; 
	?>
    <input type="submit" name="submit" />
</form>