@extends('plantillas.plantilla')
@section('contenido')

    <h1>Recuperar Contraseña</h1>
    <form action="{{ route('hermanos.recuperarContrasena') }}" method="post">
        @csrf
        <label for="usuario">email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <br>
        <input type="submit" value="Recuperar Contraseña">
    </form>

@endsection
