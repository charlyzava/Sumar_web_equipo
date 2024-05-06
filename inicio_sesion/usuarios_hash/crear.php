<?php 
//Validar campo vacio
//Validar que no se repita el usuario
//Validar Mínimo de caracteres


//LOGIN***************************************************************

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
  header('Location: ../login_sumar.php');
  exit();
}

// Obtener el nombre de usuario para mostrarlo en la página
$usuario_sesion = $_SESSION['usuario'];

// Procesar el cierre de sesión
if (isset($_POST['cerrar_sesion'])) {
  session_unset();
  session_destroy();
  header('Location: ../login_sumar.php');
  exit();
}

//FIN LOGIN*********************************************************


//Genera una cadena de Cacteres de longitud 25, para crear contraseñas más seguras.

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Datos de conexión a la base de datos  
include('../conexion.php') ;
    
    
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
// Datos del nuevo usuario

$usuario=$_POST['inputUsuario'];
$contrasena=$_POST['inputContrasena'];
// Buscar si el usuario existe
    
$existeUsuario="select count(*) as total from usuarios where usuario = '$usuario'";
    
$resultado = pg_query($conn, $existeUsuario);

if (!$resultado) {
    echo "Error al ejecutar la consulta.";
    exit;
}

$fila = pg_fetch_assoc($resultado);
$total = $fila['total'];

if ($total > 0) {
    echo "El usuario $usuario existe en la base de datos.";
} else {
    
    
    
        // fin Buscar si el usuario existe    
        // Generar salt aleatorio
        $salt = generarSalt();

        // Calcular el hash de la contraseña
        $contrasena_hash = hash('sha256', $contrasena . $salt);

        // Insertar el nuevo usuario en la tabla
        $sql = "INSERT INTO usuarios (usuario, contrasena_hash, salt)
                VALUES ('$usuario', '$contrasena_hash', '$salt')";

        $result = pg_query($conn, $sql);
        if ($result) {
            echo "Nuevo usuario creado exitosamente";
        } else {
            echo "Error al crear el usuario";
        }

        // Cerrar la conexión
        pg_close($conn);

}// fin control el usuario no existe en la BD
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de Usuarios</title>
</head>
<body>
<h1>Bienvenido, <?php echo $usuario_sesion; ?> v2.2</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <input type="submit" name="cerrar_sesion" id="cerrar_sesion" value="Cerrar sesión">
  </form>
    


    <h3>Crear Usuario con Hash</h3>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" id="formCrearUsuario">
    <h5>Ingrese los datos</h5>
    <input type="text" id="inputUsuario" name="inputUsuario" placeholder="Usuario">
    <input type="password" id="inputContrasena" name ="inputContrasena" placeholder="Password">
    <br>
    <input type="submit" id="btnGrabar" name="btnGrabar" value="Crear Usuario">
</form>

<script src="./controlador_hash8.js"></script>
<?php if (isset($sql)){
	echo $sql;
} ?>
</body>
</html>

