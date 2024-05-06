<?php

include('conexion_pdo.php');


session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  header('Location: home.php');
  exit();
}

// Obtener el nombre de usuario para mostrarlo en la página
$usuario = $_SESSION['usuario'];

// Procesar el cierre de sesión
if (isset($_POST['cerrar_sesion'])) {
  session_unset();
  session_destroy();
  header('Location: login_sumar.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Acceso Web Sumar</title>
  <link rel="shortcut icon" href="../sumar.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1>Bienvenido, <?php echo $usuario; ?></h1>
  <form method="post" action="pagina_destino.php">
    <input type="submit" name="cerrar_sesion" value="Cerrar sesión">
  </form>
  <p>Contenido de la página protegida.</p>


  <p>Secciones
<p>


  Listado de Beneficiarios<p>

  Monto disponible </p>
  <p>
    <?php 
  
  // Ejemplo de consulta
  /*  $query = "SELECT cuie FROM public.registro_equipos";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Obtener resultados
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Trabajar con los resultados
    foreach ($results as $row) {
        // Acceder a los valores de cada fila
        $columnValue = $row['cuie'];
        echo $columnValue . "<br>";*/
  
  
  
  
  
 /* $data = $conn->query("SELECT * FROM users")->fetchAll();
// and somewhere later:
foreach ($data as $row) {
    echo $row['name']."<br />\n";
}*/
  
  /*
  $query = "SELECT * FROM public.usuarios WHERE usuario = '$username' AND contrasena_hash = '$password'";
$stmt = $conn->prepare($query);
//$stmt->bindParam(':username', $username);
//$stmt->bindParam(':password', $password);
$stmt->execute();
  
  
  
  
  
  $stmt = $pdo->query("SELECT cuie FROM registro_equipos");
while ($row = $stmt->fetch()) {
    echo "ll".$row['cuie']."<br />\n";
}
  
  */
  ?>
  </p>
  <p>&nbsp;</p>
  <p><a href="usuarios_hash/crear.php">Alta de usuario</a></p>
  <p><a href="../sistemas/registro_equipos.php">Registro de Supervisión de Equipos</a></p>
  <p><a href="efectores.php">Efectores</a></p>
</body>
</html>



