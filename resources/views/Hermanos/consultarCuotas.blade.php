@extends('plantillas.plantillaHermanos')



@section('contenido')

    <h1>Cuotas Pendientes </h1>
    <div class="container">
        @foreach($cuotas as $cuota)
            <div class="CajonDatos">
                <div class="FotoDatos">
                    <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Imagen de la cuota">
                </div>
                <div class="DatosFormulario">
                    <h2>Nombre: </h2>
                    <p>{{ $cuota->nombre }}</p>
                    <h2>Descripción: </h2>
                    <p>{{ $cuota->descripcion }}</p>
                    <h2>Importe: </h2>
                    <p>{{ $cuota->importe }}</p>
                    <h2>Fecha de Emisión: </h2>
                    <p>{{ $cuota->fecha_emision }}</p>
                    <h2>Fecha de Vencimiento: </h2>
                    <p>{{ $cuota->fecha_vencimiento }}</p>
                    <h2>Pagada: </h2>
                    <p>{{ $cuota->pagada ? 'Sí' : 'No' }}</p>

                    @if(!$cuota->pagada)
                        <!-- Botón para pagar la cuota -->
                        <a href="{{ route('hermanos.mostrar', ['cuotaId' => $cuota->id]) }}" class="btn btn-success">Pagar Cuota</a>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="pagination-container">
            {{ $cuotas->links() }}
        </div>
    </div>

@endsection
