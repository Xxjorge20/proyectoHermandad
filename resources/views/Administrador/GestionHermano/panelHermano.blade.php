@extends('plantillas.plantillaAdmin')

@section('menu')

    <li><a href="{{ route('administrador.GestionHermano.panelHermano') }}">Gestionar Hermanos</a></li>
    <li><a href="{{ route('administrador.GestionHermano.crearHermano') }}">Añadir Hermanos</a></li>


@endsection

@section('contenido')

    <h1>Gestión de Hermanos</h1>
    <div class="container">

        <!-- Consulta de hermanos por dni -->
        <form action="{{ route('administrador.GestionHermano.buscarHermano') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="dni">Buscar hermano por DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni">
            </div>
            <input type="submit" value="Buscar">
        </form>


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
                <h2>DNI: </h2>
                <p>{{$hermano->dni}}</p>
                <h2>Email: </h2>
                <p>{{$hermano->email}}</p>
                <h2>Telefono: </h2>
                <p>{{$hermano->telefono}}</p>
                <h2>ID:</h2>
                <p>{{$hermano->id}}</p>
            </div>
            <div class="BotonesDatosFormulario">
                <a href="{{ route('administrador.GestionHermano.modificarHermano', ['id' => $hermano->id]) }}" class="btn btn-warning">Modificar</a>
                <br>
                <br>
                <form id="formEliminarHermano" action="{{ route('administrador.GestionHermano.eliminarHermano', ['id' => $hermano->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmarEliminacion('{{ $hermano->dni }}', '{{ $hermano->nombre }} {{ $hermano->apellidos }}', '{{ $hermano->id }}')" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
        @endforeach
        @if($hermanos->isEmpty())
            <h2>No hay hermanos</h2>
        @endif
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

<script>
    function confirmarEliminacion(dni, nombreCompleto, id) {
        var mensaje = "¿Estás seguro de que quieres eliminar a " + nombreCompleto + " con DNI " + dni + " y ID " + id + "?";
        if (confirm(mensaje)) {
            document.getElementById('formEliminarHermano').action = "/administrador/GestionHermano/eliminarHermano/" + id;
            document.getElementById('formEliminarHermano').submit();
        }
    }
</script>


