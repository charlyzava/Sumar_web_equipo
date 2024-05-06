
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form method="post" action="procesar_formulario.php">
  <!-- Resto de campos del formulario -->
  
  <label for="captcha">Introduce el texto de la imagen (Mayúsculas):</label>
  <input type="text" name="captcha" id="captcha">
  <img src="generar_captcha.php" alt="CAPTCHA">
  
  <button type="submit">Enviar</button>
</form>
</body>
</html>



