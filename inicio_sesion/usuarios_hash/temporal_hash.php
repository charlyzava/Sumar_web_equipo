<?php
session_start();
ob_start();
require_once "conexion.php";
error_reporting(E_ALL);

if((isset($_POST['ingresar'])) or (isset($_POST['registrar']))){
  
    if(!($mysqli = conectarse())){
 echo "Error al conectarse a la base de datos";
 echo "
";
 echo $mysqli->connect_errno. " - " .$mysqli->connect_error;
 exit();                      }

$errores = array();
       $username = filter_var($username, FILTER_SANITIZE_STRING);
   $password = filter_var($password, FILTER_SANITIZE_STRING);
   
   if( empty($username) )
                $errores[] = "Debe especificar username";
            
            if( empty($password) )
                $errores[] = "Debe especificar password";          
    
  if( count($errores) > 0 )
        {
            echo "
ERRORES ENCONTRADOS:

";
            for( $contador=0; $contador < count($errores); $contador++ )
                echo $errores[$contador]."
";
   exit();
        }
       
        if(isset($_POST['ingresar'])) {
      
   if(!($stmt = $mysqli->prepare("SELECT username, password FROM login_php WHERE username = ?"))){
          echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
          exit(); }
   
   if(!$stmt->bind_param('s', $username)){
          echo "Bind failed: (" . $stmt->errno . ")" . $stmt->error;
          exit(); }

        if(!$stmt->execute()){
          echo "Execute failed: (" . $stmt->errno .")" . $stmt->error;
          exit();                   }

        $userdata = $stmt->get_result();
        $row = $userdata->fetch_array(MYSQLI_ASSOC);

        $stmt->store_result();

            if(password_verify($password, $row['password'])){

             $_SESSION['user'] = $username;
             header('Location: formulario.html');
             exit();
   
      }else{
             echo "Login Failed: (" . $stmt->errno .")" . $stmt->error;
             exit();             
    }
        }
  
 if (isset($_POST['registrar'])){
   $password_hash = password_hash($password, PASSWORD_DEFAULT);
   if(!($stmt = $mysqli->prepare("INSERT INTO login_php (username, password) 
         VALUES (?,?)"))){
         echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
     }

     if(!$stmt->bind_param('ss', $username, $password_hash)){
     echo "Binding paramaters failed:(" . $stmt->errno . ")" . $stmt->error;
     }

     if(!$stmt->execute()){
     echo "Execute failed: (" . $stmt->errno .")" . $stmt->error;
     }

     if($stmt) {
     header('Location: form_login.html');

     }
     else{
     echo "Registration failed";
     }

  }
}else{
    header('location:form_login.html');
        }
 $contenido = ob_get_contents();
 ob_end_clean();
 $stmt->close();
 $mysqli->close();
?>