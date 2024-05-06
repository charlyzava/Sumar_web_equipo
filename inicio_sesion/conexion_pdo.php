<?php

$host = 'localhost';
$dbname = "dbsumar";
$user = "sumar";
$password = "saluD.741";
	
	try {
    // Conexión a la base de datos
    $conn = new PDO("pgsql:host=localhost;dbname=$dbname", $user, $password);

    // Configuración de opciones de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   /* // Ejemplo de consulta
    $query = "SELECT * FROM public.users";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Obtener resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Trabajar con los resultados
    foreach ($results as $row) {
        // Acceder a los valores de cada fila
        $columnValue = $row['password'];
        echo $columnValue . "<br>";
    }*/
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
	

?>
