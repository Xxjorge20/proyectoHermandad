@extends('plantillas.plantillaHermanos')
@section('contenido')

    <h1>Nuestra Junta de Gobierno</h1>
        @foreach($hermanos->groupBy('cargo.nombre') as $cargo => $hermanosPorCargo)
            <div class="FotoDatos">
                <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Foto Hermano">
            </div>
                <h2>Cargo: {{ $cargo }}</h2>
                @foreach($hermanosPorCargo as $hermano)
                        <h2>Nombre: </h2>
                        <p>{{ $hermano->nombre }}</p>
                        <h2>Apellidos: </h2>
                        <p>{{ $hermano->apellidos }}</p>
                @endforeach
        @endforeach
    <div class="pagination-container">
        {{$hermanos->links()}}
    </div>

@endsection

