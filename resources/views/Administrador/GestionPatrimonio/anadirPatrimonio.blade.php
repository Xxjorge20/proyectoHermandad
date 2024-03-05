@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.GestionPatrimonio.panelPatrimonio') }}">Gestionar Patrimonio</a>
    </li>
    <li>
        <a href="{{ route('administrador.GestionPatrimonio.anadirPatrimonio') }}">Añadir Patrimonio</a>
    </li>
@endsection

@section('contenido')

    <h1> Añadir Patrimonio </h1>
    <form action="{{ route('administrador.patrimonio.store') }}" method="post">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <br>
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion">
        <br>
        <br>
        <label for="imagen">Imagen</label>
        <input type="text" name="imagen" id="imagen">
        <br>
        <br>
        <label for="fecha_adquisicion">Fecha de Adquisición</label>
        <input type="date" name="fecha_adquisicion" id="fecha_adquisicion">
        <br>
        <br>
        <label for="valor">Valor</label>
        <input type="number" step="0.01" name="valor" id="valor">
        <br>
        <br>
        <label for="ubicacion">Ubicación</label>
        <input type="text" name="ubicacion" id="ubicacion">
        <br>
        <br>
        <label for="observaciones">Observaciones</label>
        <input type="text" name="observaciones" id="observaciones">
        <br>
        <br>
        <label for="estado">Estado</label>
        <input type="text" name="estado" id="estado">
        <br>
        <br>
        <label for="tipo">Tipo</label>
        <input type="text" name="tipo" id="tipo">
        <br>
        <br>
        <input type="submit" value="Registrar">
    </form>

@endsection
