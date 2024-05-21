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


<script src="{{ asset('js/validacionesPatrimonio.js') }}"></script>

@section('contenido')
    <h1>Modificar Patrimonio</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('administrador.GestionPatrimonio.update', $patrimonio->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $patrimonio->nombre }}" onblur="validarCampo('nombre', this.value)">
                    </div>

                    <div id="errorNombre" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $patrimonio->descripcion }}" onblur="validarCampo('descripcion', this.value)">
                    </div>

                    <div id="errorDescripcion" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="text" class="form-control" name="imagen" value="{{ $patrimonio->imagen }}" onblur="validarCampo('imagen', this.value)">
                    </div>
                    <div class="form-group">
                        <label for="fecha_adquisicion">Fecha de Adquisición</label>
                        <input type="date" class="form-control" name="fecha_adquisicion" value="{{ \Carbon\Carbon::parse($patrimonio->fecha_adquisicion)->format('Y-m-d') }}" onblur="validarCampo('fecha_adquisicion', this.value)">
                    </div>

                    <div id="errorFechaAdquisicion" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="number" step="0.01" class="form-control" name="valor" value="{{ $patrimonio->valor }}" onblur="validarCampo('valor', this.value)">
                    </div>

                    <div id="errorValor" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="ubicacion">Ubicación</label>
                        <input type="text" class="form-control" name="ubicacion" value="{{ $patrimonio->ubicacion }}" onblur="validarCampo('ubicacion', this.value)">
                    </div>

                    <div id="errorUbicacion" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" class="form-control" name="observaciones" value="{{ $patrimonio->observaciones }}" onblur="validarCampo('observaciones', this.value)">
                    </div>


                    <div id="errorObservaciones" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" name="estado" value="{{ $patrimonio->estado }}" onblur="validarCampo('estado', this.value)">
                    </div>

                    <div id="errorEstado" class="errorValidacion"></div>

                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" name="tipo" value="{{ $patrimonio->tipo }}" onblur="validarCampo('tipo', this.value)">
                    </div>

                    <div id="errorTipo" class="errorValidacion"></div>

                    <input type="submit" value="Modificar" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
@endsection
