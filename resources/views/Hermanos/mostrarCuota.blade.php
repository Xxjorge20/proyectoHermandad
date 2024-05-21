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

            <h1>Pagar con Paypal</h1>
            <script src="https://www.paypal.com/sdk/js?client-id=BAAAen45E4rAhAh9lzVNWOaOCvjoI1DFhVW6pw35XbsGU-jWj0Lk0fWEDXSZLSfHch-wNYsForSRLzL0tw&components=hosted-buttons&disable-funding=venmo&currency=EUR"></script>
            <div id="paypal-container-PRCX9PJ9DQLE6"></div>
            <script>
                paypal.HostedButtons({
                    hostedButtonId: "PRCX9PJ9DQLE6",
                    onClick: function(data, actions) {
                        // Abre una ventana emergente con la URL deseada en tu proyecto de Laravel
                        var url = "{{ route('cuota.actualizarCuotaPagada', ['cuotaId' => $cuota->id]) }}";
                        window.open(url, '_blank');
                    },
                    onApprove: function(data, actions) {
                        // Abre una ventana emergente con la URL deseada en tu proyecto de Laravel
                        var url = "{{ route('cuota.actualizarCuotaPagada', ['cuotaId' => $cuota->id]) }}";
                        window.open(url, '_blank');
                    }


                }).render("#paypal-container-PRCX9PJ9DQLE6");
            </script>

        </div>

        <div class="CajonDatos">
            <h1>Pagar con Bizum</h1>
            <div class="DatosFormulario">
                <p>Telefono: +34 649926084</p>
                <p>Concepto: {{ $cuota->nombre }}</p>
                <p>Importe: {{ $cuota->importe }}</p>
                <p style="color: red;">¡¡¡IMPORTANTE!!!</p>
                <h2> Recordar que tienes que subir un justificante para poder verificar el pago</h2>
            </div>
        </div>

        <div class="CajonDatos">
            <h1>Subir Justificante</h1>
            <div class="DatosFormulario">
                <p> Aquí podrás adjuntar tu justificante de pago (solo PDF)</p>
                <form action="{{ route('subirJustificante', ['cuotaId' => $cuota->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Input de tipo file personalizado -->
                    <label class="custom-file-input">
                        <input type="file" name="justificante" accept=".pdf" required style="display: none;">
                        Seleccionar archivo PDF
                    </label>
                    <br>
                    <br>
                    <!-- Botón personalizado -->
                    <input type="submit" value="Subir Justificante" class="custom-button">
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

    </div>

@endsection



