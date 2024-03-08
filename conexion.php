<?php
 $host_db = $_ENV['host_db'];
 $user_db = $_ENV['user_db']; 
 $pass_db = $_ENV['pass_db']; 
 $db_name = $_ENV['db_name']; 
 
 $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}
$conexion->query("SET NAMES 'utf8'");

//Verifico que una tabla este creada, sino creo todas las tablas en la base.
if ($conexion->select_db($db_name)) {
    // Verificar si la tabla mm_usuarios existe
    $result = mysqli_query($conexion, "SHOW TABLES LIKE 'mm_usuarios'");
    if (mysqli_num_rows($result) == 0) {
        // La tabla no existe, ejecutar el archivo SQL
        $sql = file_get_contents("mibase.sql");
        if ($conexion->multi_query($sql)) {
            //echo "Las tablas han sido creadas correctamente.";
        } else {
            //echo "Error al crear la base de datos: " . $conexion->error;
        }
    } else {
        // La tabla ya existe, no es necesario ejecutar el archivo SQL
        //echo "La tabla ya existe en la base de datos.";
    }
}
 ?>
