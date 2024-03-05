@extends('plantillas.plantilla')
@section('contenido')
    <div id="contenido">
        <h1>Acceso Hermanos</h1>
        <form action="{{ route('hermanos.login') }}" method="post">
            @csrf
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <br>
            <input type="submit" value="Acceder">
        </form>

        <div id = "enlaces">
            <a href="{{ route('hermanos.registroHermanos') }}">Hazte Hermano</a>
            <br>
            <br>
            <a href="{{ route('hermanos.olvidoContraseña') }}">¿Has olvidado tu contraseña?</a>
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

    </div>
@endsection



