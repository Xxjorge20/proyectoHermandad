@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.GestionCultos.panelCultos') }}">Gestionar Cultos</a>
    </li>
    <li>
        <a href="{{ route('administrador.GestionCultos.crearCulto') }}">Añadir Cultos</a>
    </li>
@endsection

@section('contenido')

    <h1> Añadir Culto </h1>
    <form action="{{ route('administrador.GestionCultos.store') }}" method="post">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <br>
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion">
        <br>
        <br>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha">
        <br>
        <br>
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora">
        <br>
        <br>
        <label for="lugar">Lugar</label>
        <input type="text" name="lugar" id="lugar">
        <br>
        <br>
        <label for="aforo">Aforo</label>
        <input type="number" name="aforo" id="aforo">
        <br>
        <br>
        <input type="submit" value="Registrar">
    </form>

@endsection
