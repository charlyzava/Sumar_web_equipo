<?php
include('conexion_pdo.php');

// Datos enviados desde el formulario
//pg_escape_string escapa a caracteres especiales
$username = pg_escape_string($_POST['username']);
$password = pg_escape_string($_POST['password']);
try {
// Datos enviados desde el formulario

// Consulta para verificar las credenciales
$query = "SELECT * FROM public.users WHERE usuario = '$username' AND password = '$password'";
$stmt = $conn->prepare($query);
//$stmt->bindParam(':username', $username);
//$stmt->bindParam(':password', $password);
$stmt->execute();

// Verificar si se encontraron coincidencias
if ($stmt->rowCount() > 0) {
  // Inicio de sesión exitoso
  echo "Inicio de sesión exitoso. ¡Bienvenido, $username!";
} else {
  // Credenciales inválidas
  echo "Nombre de usuario o contraseña incorrectos.";
}

	
	
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
	
?>