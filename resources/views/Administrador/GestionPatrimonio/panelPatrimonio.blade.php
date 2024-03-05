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
    <h1>Gestión de Patrimonios</h1>

    <form action="{{ route('administrador.GestionPatrimonio.consultarPatrimonioNombreAdmin') }}" method="GET" id="searchForm">
        @csrf
        <label for="nombre">Buscar Patrimonio por Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="nombre del patrimonio">
        <input type="submit" value="Buscar">
    </form>

    <div class="container">
        @foreach($patrimonios as $patrimonio)
            <div class="CajonDatos">
                <div class="FotoDatos">
                    <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Imagen del patrimonio">
                </div>
                <div class="DatosFormulario">
                    <h2>Nombre: </h2>
                    <p>{{ $patrimonio->nombre }}</p>
                    <h2>Descripción: </h2>
                    <p>{{ $patrimonio->descripcion }}</p>
                    <!-- Agrega más campos según tus necesidades -->
                    <h2>Fecha de Adquisición: </h2>
                    <p>{{ $patrimonio->fecha_adquisicion }}</p>
                    <h2>Valor: </h2>
                    <p>{{ $patrimonio->valor }}</p>
                    <h2>Ubicación: </h2>
                    <p>{{ $patrimonio->ubicacion }}</p>
                    <h2>Observaciones: </h2>
                    <p>{{ $patrimonio->observaciones }}</p>
                    <h2>Estado: </h2>
                    <p>{{ $patrimonio->estado }}</p>
                    <h2>Tipo: </h2>
                    <p>{{ $patrimonio->tipo }}</p>
                    <!-- Fin de los campos -->
                </div>
                <div class="BotonesDatosFormulario">
                    <a href="{{ route('administrador.GestionPatrimonio.modificarPatrimonio', ['id' => $patrimonio->id]) }}" class="btn btn-warning">Modificar</a>
                    <br>
                    <br>
                    <form id="formEliminarPatrimonio" action="{{ route('administrador.GestionPatrimonio.eliminarPatrimonio', ['id' => $patrimonio->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmarEliminacionPatrimonio('{{ $patrimonio->nombre }}', '{{ $patrimonio->id }}')" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
        @if($patrimonios->isEmpty())
            <h2>No hay patrimonios</h2>
        @endif

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

    <script>
        function confirmarEliminacionPatrimonio(nombrePatrimonio, idPatrimonio) {
            var mensaje = "¿Estás seguro de que quieres eliminar el patrimonio " + nombrePatrimonio + " con ID " + idPatrimonio + "?";
            if (confirm(mensaje)) {
                document.getElementById('formEliminarPatrimonio').action = "/administrador/GestionPatrimonio/eliminarPatrimonio/" + idPatrimonio;
                document.getElementById('formEliminarPatrimonio').submit();
            }
        }
    </script>
@endsection

