@extends('plantillas.plantillaHermanos')
@section('contenido')

    <!-- Resumen de la actualidad de la hermandad -->
    <h1> Bienvenido {{$hermano->nombre}} a la hermandad </h1>
    <h2>Resumen de la actualidad de la hermandad</h2>
    <p>En esta sección se mostrará un resumen de la actualidad de la hermandad, como por ejemplo los cultos que se van a celebrar, las actividades que se van a realizar, etc.</p>

    <!-- Consultar cultos -->
    <h2>Consultar Cultos</h2>
    <p>En esta sección se mostrarán los cultos que se van a celebrar en la hermandad.</p>
    <a href="{{ route('hermanos.consultarCultos') }}" class="btn btn-success">Consultar Cultos</a>
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

    <br>
    <br>

    <!-- Consultar patrimonio -->
    <h2>Consultar Patrimonio</h2>
    <p>En esta sección se mostrarán el patrimonio de la hermandad.</p>
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

                    <a href="{{ route('hermanos.consultarPatrimonio') }}" class="btn btn-success">Consultar Patrimonio</a>
                </div>
        @endforeach
    </div>

    <br>
    <br>

@endsection
