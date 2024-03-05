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

    <h1>Gestión de Cultos</h1>
    <div class="container">

        <form action="{{ route('administrador.GestionCultos.consultarCultoNombreAdmin') }}" method="GET" id="searchForm">
            @csrf
            <label for="nombre">Buscar Culto por Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="nombre del culto">
            <input type="submit" value="Buscar">
        </form>


        @foreach($cultos as $culto)
        <div class="CajonDatos">
            <div class="FotoDatos">
                <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Imagen del culto">
            </div>
            <div class="DatosFormulario">
                <h2>Nombre: </h2>
                <p>{{$culto->nombre}}</p>
                <h2>Descripción: </h2>
                <p>{{$culto->descripcion}}</p>
                <h2>Fecha: </h2>
                <p>{{$culto->fecha}}</p>
                <h2>Hora: </h2>
                <p>{{$culto->hora}}</p>
                <h2>Lugar: </h2>
                <p>{{$culto->lugar}}</p>
                <h2>Aforo: </h2>
                <p>{{$culto->aforo}}</p>
                <h2>ID:</h2>
                <p>{{$culto->id}}</p>
            </div>
            <div class="BotonesDatosFormulario">
                <a href="{{ route('administrador.GestionCultos.editarCultos', ['id' => $culto->id]) }}" class="btn btn-warning">Modificar</a>
                <br>
                <br>
                <form id="formEliminarculto" action="{{ route('administrador.GestionCultos.eliminarCulto', ['id' => $culto->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmarEliminacionculto('{{ $culto->nombre }}', '{{ $culto->id }}')" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
        @endforeach
        @if($cultos->isEmpty())
            <h2>No hay cultos</h2>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
         @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <!-- error y su mensaje -->
                {{ session('error') }}
            </div>
         @endif
    </div>


    <script>
        function confirmarEliminacionculto(nombreculto, idculto) {
            var mensaje = "¿Estás seguro de que quieres eliminar el culto " + nombreculto + " con ID " + idculto + "?";
            if (confirm(mensaje)) {
                document.getElementById('formEliminarculto').action = "/administrador/GestionCultos/eliminarCulto/" + idculto;
                document.getElementById('formEliminarculto').submit();
            }
        }
    </script>

@endsection


