<?php

// Después de verificar las credenciales y antes de mostrar el mensaje de éxito o fallo

// Obtener la dirección IP del cliente
$ip = $_SERVER['REMOTE_ADDR'];

// Determinar el resultado del inicio de sesión
$resultado = ($inicio_sesion_exitoso) ? 'Éxito' : 'Fallo';

// Insertar el registro en la tabla
$sql = "INSERT INTO registros_login (usuario, resultado, ip) VALUES ('$usuario', '$resultado', '$ip')";
// Ejecutar la consulta en tu conexión a la base de datos

// Mostrar el mensaje de éxito o fallo
?>