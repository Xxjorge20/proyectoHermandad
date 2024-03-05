@extends('plantillas.plantillaHermanos')
@section('contenido')

<h1>Nuestra Junta de Gobierno</h1>
@foreach($hermanos as $hermano)
<div class="CajonDatos">
    <div class="FotoDatos">
        <img src="{{asset('Estilos/Imagenes/Logo.png')}}" alt="Foto Hermano">
    </div>
    <div class="DatosFormulario">
        <h2>Nombre: </h2>
        <p>{{$hermano->nombre}}</p>
        <h2>Apellidos: </h2>
        <p>{{$hermano->apellidos}}</p>
        <h2>Cargo:</h2>
        <p>{{$hermano->cargo->nombre}}</p>
    </div>
</div>

@endforeach

@endsection

