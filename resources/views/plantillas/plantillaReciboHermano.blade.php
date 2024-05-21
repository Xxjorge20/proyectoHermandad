<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset default styles */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        /* Container for the whole invoice */
        .invoice-container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Header section */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Hermandad name */
        .hermandad-name {
            font-size: 24px;
            font-weight: bold;
        }

        /* Recibo details */
        .recibo-details {
            margin-bottom: 20px;
        }

        /* Datos del Hermano section */
        .datos-hermano {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-bottom: 20px;
        }

        /* Datos de la Cuota section */
        .datos-cuota {
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        /* Heading styles */
        h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Paragraph styles */
        p {
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1 class="hermandad-name">Real Hermandad Santa Rita de Casia - Luque</h1>
            <h2>Recibo de Cuota {{$cuota->id}}</h2>
            <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>

        <div class="recibo-details">
            <div class="datos-hermano">
                <h2>Datos del Hermano:</h2>
                <p>Nombre del Hermano/a: {{ $hermanoObtenido->nombre }} {{ $hermanoObtenido->apellidos }}</p>
                <p>DNI: {{ $hermanoObtenido->dni }}</p>
                <p>Dirección: {{ $hermanoObtenido->direccion }}</p>
                <p>Email: {{ $hermanoObtenido->email }}</p>
            </div>

            <div class="datos-cuota">
                <h2>Datos de la Cuota:</h2>
                <p>Nombre: {{ $cuota->nombre }}</p>
                <p>Importe: {{ $cuota->importe }} €</p>
                <p>Fecha de Emisión: {{ $cuota->fecha_emision }}</p>
                <p>Fecha de Vencimiento: {{ $cuota->fecha_vencimiento }}</p>
                <p>Pagada: {{ $cuota->pagada ? 'Sí' : 'No' }}</p>
            </div>
        </div>
    </div>
</body>
</html>
