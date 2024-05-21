@extends('plantillas.plantilla')
@section('contenido')
    <h1>Formulario de contacto</h1>
    <div class="container">
        <div class="CajonDatos">
        <!-- Contenido del formulario de contacto -->
        <form action="{{ route('enviarCorreo') }}" method="POST">
            @csrf
            <!-- Campos del formulario -->
            <label for="destinatario">Correo electrónico</label>
            <input type="email" name="destinatario" placeholder="Correo electrónico" required>
            <br>
            <br>
            <label for="asunto">Asunto</label>
            <input type="text" name="asunto" placeholder="Asunto" required>
            <br>
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" placeholder="Mensaje" required rows="10" cols="75"></textarea>
            <br>
            <input type="submit">
        </form>


        </div>
        <br>
        <br>
        <!-- Boton Volver -->
        <a href="{{ route('paginaInicio') }}" class="btn btn-primary">Volver</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif



@endsection
