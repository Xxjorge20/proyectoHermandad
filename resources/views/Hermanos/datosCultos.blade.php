
<div class="container">

    <h2>    Cultos Consultado    </h2>

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


    <!-- Línea divisoria -->
    <hr class="linea-divisoria">
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
