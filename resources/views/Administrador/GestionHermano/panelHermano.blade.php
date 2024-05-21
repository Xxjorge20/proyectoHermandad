@extends('plantillas.plantillaAdmin')

@section('menu')

    <li><a href="{{ route('hermanos.paginaHermanos') }}">Pagina Inicio</a></li>
    <li><a href="{{ route('administrador.GestionHermano.panelHermano') }}">Gestionar Hermanos</a></li>
    <li><a href="{{ route('administrador.GestionHermano.crearHermano') }}">Añadir Hermanos</a></li>
    <li><a href="{{ route('hermanos.consultarCuotas') }}">Consultar Cuota</a></li>

@endsection

@section('contenido')

    <h1>Gestión de Hermanos</h1>
    <div class="container">

        <div class="CajonDatos">
            <!-- Consulta de hermanos por dni -->
            <h2>    Buscar por dni    </h2>
            <form action="{{ route('administrador.GestionHermano.buscarHermano') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="dni">Buscar hermano por DNI:</label>
                    <input type="text" class="form-control" id="dni" name="dni">
                </div>
                <input type="submit" value="Buscar">
            </form>

        </div>


        <div class="CajonDatos">
            <!-- Consulta de hermanos por nombre -->
            <h2>    Buscar por nombre    </h2>
            <form action="{{ route('administrador.GestionHermano.consultarHermanoNombre') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="nombre">Buscar hermano por nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                            <!-- Línea divisoria -->
                    <hr class="linea-divisoria">
                </div>
            </form>
        </div>

        <div class="containerHermanos">

        </div>

        @foreach($hermanos as $hermano)
        <div class="CajonDatos">
            <div class="FotoDatos">
                <img src="{{asset('Estilos/Imagenes/Logo.png')}}" alt="Foto Hermano">
            </div>
            <div class="DatosFormulario">
                <h2>Nombre </h2>
                <p>{{$hermano->nombre . " " . $hermano->apellidos}}</p>
                <h2>DNI: </h2>
                <p>{{$hermano->dni}}</p>
                <h2>Email: </h2>
                <p>{{$hermano->email}}</p>
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

        <div class="pagination-container">
            {{ $hermanos->links() }}
        </div>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function confirmarEliminacion(dni, nombreCompleto, id) {
        var mensaje = "¿Estás seguro de que quieres eliminar a " + nombreCompleto + " con DNI " + dni + " y ID " + id + "?";
        if (confirm(mensaje)) {
            document.getElementById('formEliminarHermano').action = "/administrador/GestionHermano/eliminarHermano/" + id;
            document.getElementById('formEliminarHermano').submit();
        }
    }

    $(document).ready(function() {
    $('#nombre').on('input', function() {
        var nombre = $(this).val();
        if (nombre != '') {
            $.ajax({
                url: "{{ route('administrador.GestionHermano.consultarHermanoNombre') }}",
                method: "GET",
                data: {nombre: nombre},
                success: function(data) {
                    $('.containerHermanos').html(data);
                }
            });
        } else {
            // Si el campo está vacío oculto el div containerHermanos
            $.ajax({
                url: "{{ route('administrador.GestionHermano.consultarHermanoNombre') }}",
                method: "GET",
                data: {nombre: nombre},
                success: function(data) {
                    $('.containerHermanos').html('');
                }
            });
        }
    });
});



</script>


