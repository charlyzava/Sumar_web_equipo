 window.addEventListener("load",()=>{
  const idA = document.querySelector("#idA");
idA.addEventListener("click",()=>{ alert('Comuníquese con el área de Sistemas del Programa Sumar Catamarca')});
})

// Escuchar el evento submit del formulario
document.querySelector('form').addEventListener('submit', function(event) {
    //event.preventDefault(); // Evitar que el formulario se envíe por defecto
    // Obtener los valores de usuario y contraseña ingresados
    var username = document.getElementById('usuario').value;
    var password = document.getElementById('contrasena').value;
  
    // Realizar las validaciones necesarias
    if (username.trim() === '') {
      alert('Por favor, ingresa un nombre de usuario.');
      return;
    }
  
    if (password.trim() === '') {
      alert('Por favor, ingresa una contraseña.');
      return;
    }
	
	if (username.length > 20){
		alert('Error, el usuario no debe tener más de 20 caracteres');
		return;
	}
	
	if (password.length > 20){
		alert('Error, la contraseña no debe tener más de 20 caracteres');
		return;
	}
  
    // Enviar los datos al servidor para realizar la autenticación
    // Puedes usar Ajax o Fetch para hacer la solicitud al archivo PHP
  
    // Aquí puedes agregar el código para enviar los datos al servidor
    // y realizar la autenticación en el archivo PHP, como se mostró anteriormente.
  
    // Si la autenticación es exitosa, puedes redirigir al usuario a otra página
    // utilizando window.location.href = 'ruta_de_redireccionamiento';
  
    // Si la autenticación falla, puedes mostrar un mensaje de error en la página
    // o realizar alguna acción adicional según tus necesidades.
  
  });