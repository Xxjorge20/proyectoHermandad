<div class="container">
    <h2>    Hermano Consultado    </h2>


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

<!-- Línea divisoria -->
<hr class="linea-divisoria">

</div>


