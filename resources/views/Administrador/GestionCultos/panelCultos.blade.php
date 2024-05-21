@extends('plantillas.plantillaAdmin')

@php
    use Carbon\Carbon;
    Carbon::setLocale('es');
@endphp


@section('menu')

    <li><a href="{{ route('hermanos.paginaHermanos') }}">Pagina Inicio</a></li>
    <li>
        <a href="{{ route('administrador.GestionCultos.panelCultos') }}">Gestionar Cultos</a>
    </li>
    <li>
        <a href="{{ route('administrador.GestionCultos.crearCulto') }}">Añadir Cultos</a>
    </li>
    <li><a href="{{ route('hermanos.consultarCuotas') }}">Consultar Cuota</a></li>

@endsection

@section('contenido')

    <h1>Gestión de Cultos</h1>

    <div class="CajonDatos">
        <div class="container">
            <h2>Consultar cultos por nombre</h2>
            <form action="{{ route('administrador.GestionCultos.consultarCultoNombreAdmin') }}" method="GET" id="searchForm">
                @csrf
                <label for="nombre">Buscar Culto por Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="nombre del culto">
                <input type="submit" value="Buscar">
            </form>
        </div>

    </div>


    <div class="CajonDatos">
        <div class="container">
            <h2>Consultar cultos por mes</h2>
            <form action="{{ route('consultarCultoPorMesAdmin') }}" method="GET" id="searchForm">
                @csrf
                <label for="mes">Seleccionar Mes:</label>
                <select name="mes" id="mes">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i == session('mesSeleccionado') ? 'selected' : '' }}>
                            {{ Carbon::create()->month($i)->locale('es')->isoFormat('MMMM') }}
                        </option>
                    @endfor
                </select>
                <input type="submit" value="Buscar">
            </form>
        </div>
    </div>

    <div class="containerCultos">

    </div>


    <div class="container">

        @foreach($cultos as $culto)
        <div class="CajonDatos">
            <div class="FotoDatos">
                <img src="{{ asset($culto->imagen) }}" alt="Imagen del culto">
            </div>
            <div class="DatosFormulario">
                <h2>Nombre: </h2>
                <p>{{$culto->nombre}}</p>
                <h2>Fecha: </h2>
                <p>{{ \Carbon\Carbon::parse($culto->fecha)->format('Y-m-d') }}</p>
                <h2>Hora: </h2>
                <p>{{ \Carbon\Carbon::parse($culto->hora)->format('H:i') }}</p>
                <h2>Lugar: </h2>
                <p>{{$culto->lugar}}</p>
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

        <div class="pagination-container">
            {{ $cultos->links() }}
        </div>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        function confirmarEliminacionculto(nombreculto, idculto) {
            var mensaje = "¿Estás seguro de que quieres eliminar el culto " + nombreculto + " con ID " + idculto + "?";
            if (confirm(mensaje)) {
                document.getElementById('formEliminarculto').action = "/administrador/GestionCultos/eliminarCulto/" + idculto;
                document.getElementById('formEliminarculto').submit();
            }
        }

        $(document).ready(function() {
        $('#nombre').on('input', function() {
        var nombre = $(this).val();
        if (nombre != '') {
            $.ajax({
                url: "{{ route('administrador.GestionCultos.consultarCultoNombreAdmin') }}",
                method: "GET",
                data: {nombre: nombre},
                success: function(data) {
                    $('.containerCultos').html(data);
                }
            });
        } else {
            // Si el campo está vacío oculto el div containerHermanos
            $.ajax({
                url: "{{ route('administrador.GestionCultos.consultarCultoNombreAdmin') }}",
                method: "GET",
                data: {nombre: nombre},
                success: function(data) {
                    $('.containerCultos').html('');
                }
            });
        }
    });
});

    </script>

@endsection


