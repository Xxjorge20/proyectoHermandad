@extends('plantillas.plantillaHermanos')
@section('contenido')

    <h1>Patrimonio de la Hermandad</h1>


    <form action="{{ route('consultarPatrimonioNombre') }}" method="GET" id="searchForm">
        @csrf
        <label for="nombre">Buscar Patrimonio por Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="nombre del patrimonio">
        <input type="submit" value="Buscar">
    </form>


    <div class="container">
        @foreach($patrimonios as $patrimonio)
            <div class="CajonDatos">
                <div class="FotoDatos">
                    <img src="{{ $patrimonio->imagen }}" alt="Imagen del patrimonio">
                </div>
                <div class="DatosFormulario">
                    <h2>Nombre: </h2>
                    <p>{{ $patrimonio->nombre }}</p>
                    <h2>Descripción: </h2>
                    <p>{{ $patrimonio->descripcion }}</p>
                    <h2>Fecha de Adquisición: </h2>
                    <p>{{ \Carbon\Carbon::parse($patrimonio->fecha_adquisicion)->format('Y-m-d') }}</p>
                    <h2>Ubicación: </h2>
                    <p>{{ $patrimonio->ubicacion }}</p>
                    <h2>Observaciones: </h2>
                    <p>{{ $patrimonio->observaciones ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination-container">
        {{ $patrimonios->links() }}
    </div>




@endsection
