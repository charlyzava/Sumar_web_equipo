<?php
$host = 'localhost';
$dbname = "dbsumar";
$user = "sumar";
$password = "saluD.741";
	
	$conn = pg_connect("host=localhost dbname=dbsumar user=sumar password=saluD.741");
	if ($conn<>true){
		echo "No se conectó";
	}

?>
