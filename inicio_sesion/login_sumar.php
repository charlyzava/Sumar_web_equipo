<?php
// FALTA CAMBIAR EL INICIO POR LA TABLA CON HASH Y SALT: LISTO!!!!

session_start();

    // Obtener la dirección IP del cliente
    $ip = $_SERVER['REMOTE_ADDR'];

// Verificar si el usuario ya ha iniciado sesión, en ese caso redireccionar a la página deseada
if (isset($_SESSION['usuario'])) {
  header('Location: home.php');
  exit();
}

// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['submit'])) {
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  // Verificar las credenciales del usuario (aquí debes implementar tu propia lógica de autenticación)
//******************************************************************* */
include('conexion_pdo.php');

// Datos enviados desde el formulario
//pg_escape_string escapa a caracteres especiales

$username=pg_escape_string($usuario);
$password=pg_escape_string($contrasena);

//usuario = 

try {
// Datos enviados desde el formulario

//Sacar el Salt
$stmt = $conn->query("select salt from public.usuarios where usuario = '$username'");
while ($row = $stmt->fetch()) {
	$salt=$row['salt'];
}

/*
#############################################################
VER, CAMBIAR tabla users por usuarios y ver hash con brcypt
#############################################################
*/
$nuevaContrasenaHash = hash('sha256', $password . $salt);
$query = "SELECT * FROM public.usuarios WHERE usuario = '$username' AND contrasena_hash = '$nuevaContrasenaHash'";
$stmt = $conn->prepare($query);
//$stmt->bindParam(':username', $username);
//$stmt->bindParam(':password', $password);
$stmt->execute();

// Verificar si se encontraron coincidencias
if ($stmt->rowCount() > 0) {
    // Inicio de sesión exitoso
    echo "Inicio de sesión exitoso. ¡Bienvenido, $username!".$salt;
    echo "bienvenido".$usuario;
    // Iniciar sesión y redireccionar al usuario a la página deseada
    $_SESSION['usuario'] = $usuario;


    /* ##########################    registro de inicio de sesión Exitoso   ##########################*/

    // Insertar el registro en la tabla
    $sql = "INSERT INTO public.registros_login (usuario, resultado, ip) VALUES ('$usuario', 'OK', '$ip')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // Ejecutar la consulta en tu conexión a la base de datos

    header('Location: home.php');
    exit();
  } else {
    // Credenciales inválidas
    //echo "Nombre de usuario o contraseña incorrectos.";

    $error = "Error : Credenciales incorrectas";

    /* ##########################    registro de inicio de sesión Incorrecto   ##########################*/
    // Insertar el registro en la tabla
    $sql = "INSERT INTO public.registros_login (usuario, resultado, ip) VALUES ('$username', 'error', '$ip')";
    $registro = $conn->prepare($sql);
    $registro->execute();
    // Ejecutar la consulta en tu conexión a la base de datos
    
  }

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Iniciar sesión</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
  <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="login9.css">
        <link rel="shortcut icon" href="../favicon.png">
</head>
<body>
  <?php //if (isset($error)) { echo "<p>$error</p>"; } ?>


  <div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                        Bienvenido
                    </div>

  <form method="post" id="loginform" action="login_sumar.php">
    <input type="text" id="usuario" name="usuario" placeholder="Usuario" required autocomplete="off"><br>

    <input type="password" id="contrasena" name="contrasena" placeholder="Password" required autocomplete="off"><br>
    <div id="botoncito">
    <input type="submit" name="submit" value="Iniciar sesión" id="btnIniciar">
    </div>
  </form>
  <div class="pie-form">
                        <a href="#" id="idA">¿Perdiste tu contraseña?</a>
                        <a href="#">¿No tienes Cuenta? Registrate</a>
                        <a href="#" style="color : red"><?php echo $error?></a>
                    </div>
                </div>
                <div class="inferior">
                    <a href="../index.html">Volver</a>
                </div>
            </div>
        </div>
<script src="login_javascript2.js"></script>
</body>
</html>