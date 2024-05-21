@extends('plantillas.plantillaAdmin')

@section('menu')

    <li><a href="{{ route('hermanos.paginaHermanos') }}">Pagina Inicio</a></li>
    <li>
        <a href="{{ route('administrador.GestionPatrimonio.panelPatrimonio') }}">Gestionar Patrimonio</a>
    </li>
    <li>
        <a href="{{ route('administrador.GestionPatrimonio.anadirPatrimonio') }}">Añadir Patrimonio</a>
    </li>
    <li><a href="{{ route('hermanos.consultarCuotas') }}">Consultar Cuota</a></li>



@endsection

@section('contenido')
    <h1>Gestión de Patrimonios</h1>

    <form action="{{ route('administrador.GestionPatrimonio.consultarPatrimonioNombreAdmin') }}" method="GET" id="searchForm">
        @csrf
        <label for="nombre">Buscar Patrimonio por Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="nombre del patrimonio">

        <!-- Línea divisoria -->
        <hr class="linea-divisoria">
    </form>

    <div class="containerPatrimonios">

    </div>

    <div class="container">
        @foreach($patrimonios as $patrimonio)
            <div class="CajonDatos">
                <div class="FotoDatos">
                    <img src="{{ asset('Estilos/Imagenes/Logo.png') }}" alt="Imagen del patrimonio">
                </div>
                <div class="DatosFormulario">
                    <h2>Nombre: </h2>
                    <p>{{ $patrimonio->nombre }}</p>
                    <h2>Fecha de Adquisición: </h2>
                    <p>{{ \Carbon\Carbon::parse($patrimonio->fecha_adquisicion)->format('Y-m-d') }}</p>
                    <h2>Ubicación: </h2>
                    <p>{{ $patrimonio->ubicacion }}</p>
                    <h2>Estado: </h2>
                    <p>{{ $patrimonio->estado }}</p>
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

        <div class="pagination-container">
            {{ $patrimonios->links() }}
        </div>

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

        $(document).ready(function() {
    $('#nombre').on('input', function() {
        var nombre = $(this).val();
        if (nombre != '') {
            $.ajax({
                url: "{{ route('administrador.GestionPatrimonio.consultarPatrimonioNombreAdmin') }}",
                method: "GET",
                data: {nombre: nombre},
                success: function(data) {
                    $('.containerPatrimonios').html(data);
                }
            });
        } else {
            // Si el campo está vacío oculto el div containerPatrimonios
            $.ajax({
                url: "{{ route('administrador.GestionPatrimonio.consultarPatrimonioNombreAdmin') }}",
                method: "GET",
                data: {nombre: nombre},
                success: function(data) {
                    $('.containerPatrimonios').html('');
                }
            });
        }
    });
});

    </script>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
