@extends('plantillas.plantillaHermanos')

@section('contenido')

    <h1>Cultos de nuestra Hermandad</h1>

    <form action="{{ route('consultarCultoNombre') }}" method="GET" id="searchForm">
        @csrf
        <label for="nombre">Buscar Culto por Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="nombre del culto">
        <input type="submit" value="Buscar">
    </form>

    <br>
    <br>


    <div class="container">
        @foreach($cultos as $culto)
        <div class="CajonDatos">
            <div class="FotoDatos">
                <img src="{{$culto->imagen}}" alt="Imagen del culto">
            </div>
            <div class="DatosFormulario">
                <h2>Nombre: </h2>
                <p>{{$culto->nombre}}</p>
                <h2>Descripción: </h2>
                <p>{{$culto->descripcion}}</p>
                <h2>Fecha: </h2>
                <p>{{$culto->fecha}}</p>
                <h2>Hora: </h2>
                <p>{{$culto->hora}}</p>
                <h2>Lugar: </h2>
                <p>{{$culto->lugar}}</p>
            </div>
        </div>
        @endforeach
    </div>



@endsection


