@extends('plantillas.plantillaHermanos')
<script src="{{ asset('js/contadorVisitas.js') }}"></script>
@section('contenido')

    <!-- Resumen de la actualidad de la hermandad -->
    <h1> Bienvenido {{$hermano->nombre}} a la hermandad </h1>
    <h2>Has visitado tu hermandad: <p id="visitCount"></p> </h2>



    <h2>Resumen de la actualidad de la hermandad</h2>
    <!-- Consultar cultos -->
    <h2>Cultos de la Hermandad</h2>
    <a href="{{ route('hermanos.consultarCultos') }}" class="btn btn-success">Consultar Cultos</a>

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
                    <p>{{ \Carbon\Carbon::parse($culto->fecha)->format('Y-m-d') }}</p>
                    <h2>Hora: </h2>
                    <p>{{ \Carbon\Carbon::parse($culto->hora)->format('H:i') }}</p>
                    <h2>Lugar: </h2>
                    <p>{{$culto->lugar}}</p>
                </div>
            </div>
            @endforeach
    </div>

    <br>
    <br>

    <!-- Consultar patrimonio -->
    <h2>Patrimonio de la Hermandad</h2>
    <a href="{{ route('hermanos.consultarPatrimonio') }}" class="btn btn-success">Consultar Patrimonio</a>

    <div class="container">
        @foreach($patrimonios as $patrimonio)
            <div class="CajonDatos">
                <div class="FotoDatos">
                    <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Imagen del patrimonio">
                </div>
                <div class="DatosFormulario">
                    <h2>Nombre: </h2>
                    <p>{{ $patrimonio->nombre }}</p>
                    <h2>Descripción: </h2>
                    <p>{{ $patrimonio->descripcion }}</p>
                    <h2>Ubicacion: </h2>
                    <p>{{ $patrimonio->ubicacion }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <br>
    <br>

@endsection
