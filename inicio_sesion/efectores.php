<?php

include('conexion.php');


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
  <p><a href="home.php">Home</a></p>
  <p>Efectores</p>
  <p>
    <?php 
  
  // Ejemplo de consulta
      
$sqlEfectores="select * from efectores";
    
$resEfectores = pg_query($conn, $sqlEfectores);

if (!$resEfectores) {
    echo "Error al ejecutar la consulta.";
    exit;
}

while ($fila = pg_fetch_assoc($resEfectores)){
    $cuie = $fila['CUIE'];
    $nombreEfector = $fila['NOMBREEFECTOR'];
    echo $cuie." - ".$nombreEfector."<br>";
}

     
  
  
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
</body>
</html>



