<?php

$db = new mysqli('localhost', 'usuario', 'clave', 'Base');
$query = $db->query('DESCRIBE `mm_usuarios`');
$fields = array();
while($row = $query->fetch_assoc()) {
    $fields[] = $row['Field'];
}
$i=0;
foreach($fields as $field): 
	?>
	,<?= $field; ?>
	<?
	$i++;
endforeach; 
?>
