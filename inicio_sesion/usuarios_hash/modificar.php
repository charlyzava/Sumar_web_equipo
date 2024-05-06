<?php
// Datos de conexión a la base de datos
include('../conexion.php');

// Datos del usuario y la nueva contraseña
$usuario = "usuario_existente";
$nuevaContrasena = "nueva_contrasena";

// Generar un nuevo salt
$nuevoSalt = generarSalt();

// Calcular el nuevo hash de la contraseña
$nuevaContrasenaHash = hash('sha256', $nuevaContrasena . $nuevoSalt);

// Establecer la conexión a la base de datos
/*$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    echo "Error al conectar a la base de datos";
    exit;
}*/

// Actualizar la contraseña y el salt en la tabla
$sql = "UPDATE usuarios
        SET contrasena_hash = '$nuevaContrasenaHash', salt = '$nuevoSalt'
        WHERE usuario = '$usuario'";

$result = pg_query($conn, $sql);
if ($result) {
    echo "Contraseña actualizada exitosamente";
} else {
    echo "Error al actualizar la contraseña";
}

// Cerrar la conexión
pg_close($conn);

// Función para generar un salt aleatorio
function generarSalt() {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $salt = '';
    for ($i = 0; $i < 25; $i++) {
        $indice = rand(0, strlen($caracteres) - 1);
        $salt .= $caracteres[$indice];
    }
    return $salt;
}
?>