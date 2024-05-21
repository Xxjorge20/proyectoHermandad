@extends('plantillas.plantillaHermanos')

@php
    use Carbon\Carbon;
    Carbon::setLocale('es');
@endphp

@section('contenido')

    <h1>Cultos de nuestra Hermandad</h1>

    <div class="CajonDatos">
        <div class="contenido">
            <h2>Consultar cultos por nombre</h2>
            <form action="{{ route('consultarCultoNombre') }}" method="GET" id="searchForm">
                @csrf
                <label for="nombre">Buscar Culto por Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="nombre del culto">
                <input type="submit" value="Buscar">
            </form>
        </div>
    </div>

    <div class="CajonDatos">
        <div class="contenido">
            <h2>Consultar cultos por mes</h2>
            <form action="{{ route('consultarCultoPorMes') }}" method="GET" id="searchForm">
                @csrf
                <label for="mes">Seleccionar Mes:</label>
                <select name="mes" id="mes">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i == session('mesSeleccionado') ? 'selected' : '' }}>
                            {{ Carbon::create()->month($i)->locale('es')->isoFormat('MMMM') }}
                        </option>
                    @endfor
                </select>
                <input type="submit" value="Buscar">
            </form>
        </div>
    </div>

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
                <p>{{ \Carbon\Carbon::parse($culto->fecha)->format('Y-m-d') }}</p>
                <h2>Hora: </h2>
                <p>{{ \Carbon\Carbon::parse($culto->hora)->format('H:i') }}</p>
                <h2>Lugar: </h2>
                <p>{{$culto->lugar}}</p>
            </div>
        </div>
        @endforeach

        <div class="pagination-container">
            <p>{{ $cultos->appends(['mes' => session('mesSeleccionado')])->links() }}</p>
        </div>
    </div>

@endsection
