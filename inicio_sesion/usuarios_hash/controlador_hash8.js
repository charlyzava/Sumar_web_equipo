document.getElementById('formCrearUsuario').addEventListener('submit', function(event) {
    

    // Obtener los valores de usuario y contraseña ingresados
    var username = document.getElementById('inputUsuario').value;
    var password = document.getElementById('inputContrasena').value;

    // Realizar las validaciones necesarias
    if (username.trim() === '') {
        alert('Por favor, ingresa un nombre de usuario.');
        event.preventDefault(); // Evitar que el formulario se envíe por defecto
        return;
    }

    if (password.trim() === '') {
        alert('Por favor, ingresa una contraseña.');
        event.preventDefault(); // Evitar que el formulario se envíe por defecto
        return;
    }

    if (username.length > 20) {
        alert('Error, el usuario no debe tener más de 20 caracteres');
        event.preventDefault(); // Evitar que el formulario se envíe por defecto
        return;
    }

    if (password.length > 20) {
        alert('Error, la contraseña no debe tener más de 20 caracteres');
        event.preventDefault(); // Evitar que el formulario se envíe por defecto
        return;
    }
    if (username.length < 6) {
        alert('Error, el usuario no debe tener menos de 6 caracteres');
        event.preventDefault(); // Evitar que el formulario se envíe por defecto
        return;
    }
    if (password.length < 8) {
        alert('Error, la contraseña no debe tener menos de 8 caracteres');
        event.preventDefault(); // Evitar que el formulario se envíe por defecto
        return;
    }
	

    // Si todas las validaciones son exitosas, aquí puedes realizar otras acciones o enviar el formulario
    // Puedes agregar más código aquí según tus necesidades

    // Por ejemplo, podrías enviar el formulario de manera programática si es válido
    // event.target.submit();
});