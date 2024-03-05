@extends('plantillas.plantilla')
@section('contenido')


    <h1>Registro Hermano</h1>
    <form action="{{ route('hermano.store') }}" method="post">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <br>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos">
        <br>
        <br>
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">
        <br>
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <br>
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <br>
        <br>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion">
        <br>
        <br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono">
        <br>
        <br>
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
        <br>
        <br>
        <label for="fecha_bautismal">Fecha de Bautismo</label>
        <input type="date" name="fecha_bautismal" id="fecha_bautismal">
        <br>
        <br>
        <input type="submit" value="Registrar">
    </form>

@endsection
