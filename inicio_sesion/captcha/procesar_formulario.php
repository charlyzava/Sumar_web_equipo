<?php
session_start();

// Verificar si el texto del CAPTCHA ingresado es correcto
if (isset($_POST['captcha']) && $_POST['captcha'] === $_SESSION['captcha']) {
  // El CAPTCHA es válido, procesar el formulario
  // Resto del código para procesar el formulario
  echo "funciono";
  
} else {
  // El CAPTCHA es inválido, mostrar un mensaje de error
  echo "El texto del CAPTCHA es incorrecto.";
}
?>