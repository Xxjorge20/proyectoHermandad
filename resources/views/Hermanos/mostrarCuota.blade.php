@extends('plantillas.plantillaHermanos')
@section('contenido')

    <h1>Pagar Cuota</h1>
    <div class="container">

        <!-- Datos de la cuota -->

        <div class="CajonDatos">
            <div class="FotoDatos">
                <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Imagen de la cuota">
            </div>
            <div class="DatosFormulario">
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
                <h2>Imprimir Recibo: </h2>
                <a href="{{ route('cuota.imprimirRecibo', ['cuotaId' => $cuota->id]) }}" class="btn btn-primary">Imprimir Recibo</a>
            </div>
        </div>

        <div class="CajonDatos">
            <h1>Pago con PayPal</h1>
            <p>Si prefieres, puedes realizar el pago de la cuota con PayPal:</p>
            <div class="DatosFormulario">
                <form action="{{ route('cuota.pagarCuotas', ['cuotaId' => $cuota->id]) }}" method="get">
                    @csrf
                    <div id="paypal-button-container"></div>
                </form>
            </div>
        </div>

    </div>

@endsection



<!-- Script de PayPal -->
<script src="https://www.paypal.com/sdk/js?client-id=ATrM06oJ54nD4tFoH3ombMYlBg2hHYf4RT3izVuKspDam3y6pU9VLpB8DoDwDARqaLhMZ3WquueCt_ZG"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Configura la transacción de PayPal aquí
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $cuota->importe }}' // Debes establecer el importe correcto de la cuota aquí
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // Lógica después de la aprobación del pago, como enviar los datos del formulario
            return actions.order.capture().then(function(details) {
                // Aquí puedes enviar detalles del pago y otros datos del formulario
                // a tu servidor para su procesamiento adicional
                console.log(details);

                // Continuar con el envío del formulario o redirigir según tus necesidades
                document.querySelector('form').submit();
            });
        }
    }).render('#paypal-button-container');
</script>
