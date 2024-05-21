/* Validaciones formulario */
/**
 * Valida un campo específico con un valor dado.
 * @param {string} campo - El nombre del campo a validar.
 * @param {string} valor - El valor del campo a validar.
 * @returns {void}
 */
function validarCampo(campo, valor) {


    // Definir los regex y mensajes de error en un array
    var validaciones = {
        'nombre': [/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s']+$/, "Formato de Nombre no válido. Solo se permiten letras y espacios."],
        'apellidos': [/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s']+$/, "Formato de Apellidos no válido. Solo se permiten letras y espacios."],
        'dni': [/^\d{8}[a-zA-Z]$/, "Formato de DNI no válido. Debe tener 8 dígitos seguidos de una letra."],
        'email': [/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, "Formato de Email no válido. Debe ser xxxx@yyyy.zzz"],
        'password': [/^[a-zA-Z0-9.,!?¡¿\s']+$/, "Formato de Contraseña no válido. Solo se permiten letras, números y algunos signos de puntuación."],
        'direccion': [/^[a-zA-Z0-9.,!?¡¿\s']+$/, "Formato de Dirección no válido. Solo se permiten letras, números y algunos signos de puntuación."],
        'telefono': [/^\d{9}$/, "Formato de Teléfono no válido. Debe tener 9 dígitos."],
        'fecha_nacimiento': [/^\d{4}-\d{2}-\d{2}$/, "Formato de Fecha de Nacimiento no válido. Debe ser en formato yyyy-mm-dd."],
        'fecha_bautismal': [/^\d{4}-\d{2}-\d{2}$/, "Formato de Fecha de Bautismo no válido. Debe ser en formato yyyy-mm-dd."],
        'fecha_alta': [/^\d{4}-\d{2}-\d{2}$/, "Formato de Fecha de Alta no válido. Debe ser en formato yyyy-mm-dd."],
    };

    // Obtener la validación correspondiente al campo
    var validacion = validaciones[campo];

    // Validación adicional para el DNI
    if (campo === 'dni') {
        if (!validarDNI(valor)) {
            mostrarError(campo, "El DNI no es válido.");
            return; // Detiene la validación adicional
        }
    }

    if (validacion) {
        var regex = validacion[0];
        var mensajeError = validacion[1];
        if (!regex.test(valor)) {
            mostrarError(campo, mensajeError);
        }
        else {
            ocultarError(campo);
        }
    }
}


/**
 * Valida un campo según un formato específico.
 * @param {string} valor - El valor del campo a validar.
 * @param {RegExp} regex - La expresión regular para validar el formato.
 * @param {string} mensajeError - El mensaje de error a mostrar.
 */
function validarFormato(valor, regex, mensajeError) {
    if (!regex.test(valor)) {
        mostrarError(mensajeError);
    }
}


/**
 * Muestra un mensaje de error en el div del error del campo correspondiente.
 * @param {string} campo - El nombre del campo que ha fallado la validación.
 * @param {string} mensaje - El mensaje de error a mostrar.
 */
function mostrarError(campo, mensaje) {
    var errorDiv = document.getElementById('error' + campo.charAt(0).toUpperCase() + campo.slice(1)); // Obtener el div de error correspondiente
    errorDiv.innerText = mensaje; // Mostrar el mensaje de error

    // Mostrar el div de errorValidacion
    errorDiv.classList.remove('hidden');
    errorDiv.classList.add('visible');
}

/**
 * Oculta el mensaje de error en el div del error del campo correspondiente.
 * @param {string} campo - El nombre del campo que ha pasado la validación.
 */
function ocultarError(campo) {
    var errorDiv = document.getElementById('error' + campo.charAt(0).toUpperCase() + campo.slice(1)); // Obtener el div de error correspondiente

    // Ocultar el div de errorValidacion
    errorDiv.classList.remove('visible');
    errorDiv.classList.add('hidden');
}


/**
 * Valida un DNI español.
 * @param {string} dni - El número de DNI a validar.
 * @returns {boolean} Verdadero si el DNI es válido, falso en caso contrario.
 */
function validarDNI(dni) {
    // Expresión regular para verificar el formato del DNI (8 dígitos seguidos de una letra)
    var formatoDNI = /^\d{8}[a-zA-Z]$/;

    // Si el formato del DNI es correcto, continúa con la validación
    if (formatoDNI.test(dni)) {
        var letras = 'TRWAGMYFPDXBNJZSQVHLCKE'; // Letras del DNI
        var letraCorrecta = letras.charAt(parseInt(dni.substr(0, 8)) % 23); // Calcula la letra correcta

        // Compara la letra calculada con la letra proporcionada en el DNI
        if (letraCorrecta === dni.charAt(8).toUpperCase()) {
            return true; // El DNI es válido
        }
    }

    return false; // El DNI no es válido
}




function main(){
    var campos = document.getElementsByTagName('input');
    if (campos != null) {
        for (var i = 0; i < campos.length; i++) {
            campos[i].addEventListener('blur', function () {
                validarCampo(this.id, this.value);
            });
        }
    }
}


window.onload = main();
