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
        'descripcion': [/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s\d.,!?¡¿']+$/, "Formato de Descripción no válido. Solo se permiten letras, números y algunos signos de puntuación."],
        'fecha_adquisicion': [/^\d{4}-\d{2}-\d{2}$/, "Formato de Fecha de Adquisición no válido. Debe ser YYYY-MM-DD."],
        'valor': [/^\d+(\.\d{1,2})?$/, "Formato de Valor no válido. Debe ser un número con hasta dos decimales."],
        'ubicacion': [/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s\d.,!?¡¿']+$/, "Formato de Ubicación no válido. Solo se permiten letras, números y algunos signos de puntuación."],
        'estado': [/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s\d.,!?¡¿']+$/, "Formato de Estado no válido. Solo se permiten letras, números y algunos signos de puntuación."],
        'tipo': [/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s\d.,!?¡¿']+$/, "Formato de Tipo no válido. Solo se permiten letras, números y algunos signos de puntuación."],
    };

    // Obtener la validación correspondiente al campo
    var validacion = validaciones[campo];

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
