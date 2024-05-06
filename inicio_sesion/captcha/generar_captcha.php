<?php
session_start();

// Generar una cadena de texto aleatoria para el CAPTCHA
$randomText = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Guardar el texto del CAPTCHA en la sesión para su verificación posterior
$_SESSION['captcha'] = $randomText;

// Crear una imagen con el texto del CAPTCHA
$image = imagecreate(150, 50);
$background = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);
imagettftext($image, 20, 0, 10, 30, $textColor, './fuentes/comicate.ttf', $randomText);

// Enviar la imagen generada como respuesta
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);