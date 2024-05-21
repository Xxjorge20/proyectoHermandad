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
    <h1>Modificar Culto</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('administrador.GestionCultos.update', $culto->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $culto->nombre }}" onblur="validarCampo('nombre', this.value)">
                    </div>

                    <div id="errorNombre" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $culto->descripcion }}" onblur="validarCampo('descripcion', this.value)">
                    </div>

                    <div id="errorDescripcion" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="{{ \Carbon\Carbon::parse($culto->fecha)->format('Y-m-d') }}" onblur="validarCampo('fecha', this.value)">
                    </div>

                    <div id="errorFecha" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" name="hora" value="{{ \Carbon\Carbon::parse($culto->hora)->format('H:i') }}" onblur="validarCampo('hora', this.value)">
                    </div>

                    <div id="errorHora" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="lugar">Lugar</label>
                        <input type="text" class="form-control" name="lugar" value="{{ $culto->lugar }}" onblur="validarCampo('lugar', this.value)">
                    </div>

                    <div id="errorLugar" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="aforo">Aforo</label>
                        <input type="text" class="form-control" name="aforo" value="{{ $culto->aforo }}" onblur="validarCampo('aforo', this.value)">
                    </div>

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
                                <option value="{{ $rutaImagen }}" {{ $culto->imagen === $rutaImagen ? 'selected' : '' }}>
                                    {{ $nombreArchivo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Modificar" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
@endsection
