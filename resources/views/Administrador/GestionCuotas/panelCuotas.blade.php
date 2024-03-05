@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.gestionCuotas.panelCuotas') }}">Gestionar Cuotas</a>
    </li>
    <li>
        <a href="{{ route('administrador.gestionCuotas.anadirCuota') }}">Añadir Cuotas</a>
    </li>

@endsection

@section('contenido')


    <h1>Gestión de Cuotas</h1>
    <div class="container">

        <form action="{{ route('administrador.gestionCuotas.consultarCuotaDNI') }}" method="GET" id="searchForm">
            @csrf
            <label for="dni">Buscar Cuota por DNI Hermano:</label>
            <input type="text" id="dni" name="dni" placeholder="DNI del hermano">
            <input type="submit" value="Buscar">
        </form>


    </div>


@endsection
