<?php
include('../conexion_pdo.php');
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  header('Location: ../inicio_sesion/login_sumar.php');
  exit();
}
// Obtener el nombre de usuario para mostrarlo en la página
$usuario = $_SESSION['usuario'];

// Procesar el cierre de sesión
if (isset($_POST['cerrar_sesion'])) {
  session_unset();
  session_destroy();
  header('Location: ../inicio_sesion/login_sumar.php');
  exit();
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro de Supervisión de Equpos</title>
</head>

<body>
  <h1>Bienvenido, <?php echo $usuario; ?></h1>
  <form method="post" action="../inicio_sesion/pagina_destino.php">
    <input type="submit" name="cerrar_sesion" value="Cerrar sesión">
</body>
</html>