<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo Hermano</title>

    <style>
        /* Estilos generales */

        body {
        font-family: 'Arial', sans-serif;
        background-color: #f6f6f6;
        color: #663399;
        margin: 0;
        padding: 0;
        }

        h2 {
        font-size: 20px;
        margin-bottom: 10px;
        }

        p {
        margin-bottom: 10px;
        }

        /* Contenedor principal */

        .CajonDatos {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        margin: 20px auto;
        max-width: 800px;
        }

        /* Imagen */

        .FotoDatos {
        width: 20%;
        text-align: center;
        margin-right: 20px;
        }

        .FotoDatos img {
        max-width: 100%;
        border: 1px solid #ddd;
        border-radius: 5px;
        }

        /* Datos del hermano */

        .DatosFormulario {
        width: 70%;
        padding: 20px;
        border-right: 1px solid #ddd;
        }

        /* Datos de la cuota */

        .DatosCuota {
        width: 30%;
        padding: 20px;
        background-color: #fff;
        }

        /* Línea divisoria */

        .LineaDivisoria {
        width: 1px;
        background-color: #ddd;
        margin: 20px 20px 10px 20px;
        }

        /* Opcional: agregar borde a los datos del formulario */

        .DatosFormulario p,
        .DatosCuota p {
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        }
    </style>


</head>
<body>

    <div class="CajonDatos">
        <div class="FotoDatos">
            <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Imagen de la cuota">
        </div>
        <div class="DatosFormulario">

            <h2>Hermandad del Gran Poder Sevilla</h2>

            <h2>Datos del Hermano: </h2>
            <h2>Nombre del Hermano/a: </h2>
            <p>{{ $hermanoObtenido->nombre }} {{ $hermanoObtenido->apellidos }}</p>
            <h2>DNI: </h2>
            <p>{{ $hermanoObtenido->dni }}</p>
            <h2>Dirección:</h2>
            <p>{{ $hermanoObtenido->direccion }}</p>
            <h2>Email:</h2>
            <p>{{ $hermanoObtenido->email }}</p>

            <h2>Datos de la Cuota </h2>
            <h2>Nombre: </h2>
            <p>{{ $cuota->nombre }}</p>
            <h2>Importe: </h2>
            <p>{{ $cuota->importe }}</p>
            <h2>Fecha de Emisión: </h2>
            <p>{{ $cuota->fecha_emision }}</p>
            <h2>Fecha de Vencimiento: </h2>
            <p>{{ $cuota->fecha_vencimiento }}</p>
            <h2>Pagada: </h2>
            <p>{{ $cuota->pagada ? 'Sí' : 'No' }}</p>
        </div>
    </div>
</body>
</html>
