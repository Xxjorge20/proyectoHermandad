@extends('plantillas.plantillaAdmin')

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

<script src="{{asset('js/validacionesCulto.js')}}"></script>

@section('contenido')

    <h1> Añadir Culto </h1>
    <form action="{{ route('administrador.GestionCultos.store') }}" method="post">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" onblur="validarCampo('nombre', this.value)">
        <div id="errorNombre" class="errorValidacion"></div>
        <br>
        <br>
        <label for="descripcion">Descripción</label>
        <input type="text" name="descripcion" id="descripcion" onblur="validarCampo('descripcion', this.value)">
        <div id="errorDescripcion" class="errorValidacion"></div>
        <br>
        <br>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" onblur="validarCampo('fecha', this.value)">
        <div id="errorFecha" class="errorValidacion"></div>
        <br>
        <br>
        <label for="hora">Hora</label>
        <input type="time" name="hora" id="hora" onblur="validarCampo('hora', this.value)">
        <div id="errorHora" class="errorValidacion"></div>
        <br>
        <br>
        <label for="lugar">Lugar</label>
        <input type="text" name="lugar" id="lugar" onblur="validarCampo('lugar', this.value)">
        <div id="errorLugar" class="errorValidacion"></div>
        <br>
        <br>
        <label for="aforo">Aforo</label>
        <input type="number" name="aforo" id="aforo" onblur="validarCampo('aforo', this.value)">
        <div id="errorAforo" class="errorValidacion"></div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <select name="imagen" id="imagen" class="form-control">
                @php
                $rutaCarpeta = public_path('estilos/imagenes/cultos');
                $archivos = File::files($rutaCarpeta);
                @endphp
                @foreach($archivos as $archivo)
                    @php
                    $nombreArchivo = pathinfo($archivo, PATHINFO_BASENAME); // Obtener el nombre del archivo con su extensión
                    $rutaImagen = asset('estilos/imagenes/cultos/' . $nombreArchivo);
                    @endphp
                    <option value="{{ $rutaImagen }}">
                        {{ $nombreArchivo }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>
        <br>
        <input type="submit" value="Registrar">
    </form>


@endsection
