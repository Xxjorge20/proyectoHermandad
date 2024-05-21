@extends('plantillas.plantilla')
@section('contenido')

    <a href="{{route('paginaInicio')}}" class="btn btn-primary">Volver</a>

    <h1>Fototeca</h1>
    <div class="container">

        <div class="container-grid">

            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita1.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Cartel de cultos en Honor de Santa Rita año 2024</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita2.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Estampa de Santa Rita para el año 2024 </p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita3.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Imagen de Santa Rita de Casia (Luque)</p>
            </div>

            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita10.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Altar Cultos Santa Rita 22 de Mayo del 2019</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita5.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Imagen posterior a su procesion del año 2023</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita6.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Donativo del Azulejo para la Santa - Noviembre 2021</p>
            </div>

            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita7.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Octubre del 2021</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita8.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Cultos en honor de Santa Rita 22 Mayo 2021</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita9.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Altar de Santa Rita en Marzo del 2021</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita4.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Procesion Santa Rita 22 de Mayo del 2022</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita11.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Altar Cultos Santa Rita 22 de Mayo del 2019</p>
            </div>
            <div class="grid-item">
                <img src="{{asset('Estilos/Imagenes/SantaRita12.jpg')}}" alt="Santa Rita" width="300" height="400">
                <p>Cultos en honor de Santa Rita año 2020</p>
            </div>
        </div>

    </div>

    <!-- Boton Volver -->
    <a href="{{route('paginaInicio')}}" class="btn btn-primary">Volver</a>




@endsection
