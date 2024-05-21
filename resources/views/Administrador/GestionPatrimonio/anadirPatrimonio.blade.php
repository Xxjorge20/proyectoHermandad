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

<script src="{{asset('js/validacionesPatrimonio.js')}}"></script>

@section('contenido')

    <h1> Añadir Patrimonio </h1>
    <form action="{{ route('administrador.patrimonio.store') }}" method="post" enctype="multipart/form-data">
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
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" accept=".jpg, .jpeg, .png" required id="imagen" style="display: none;">
        <label class="custom-file-input" for="imagen">Seleccionar archivo JPG o PNG</label>
        <br>
        <br>
        <label for="fecha_adquisicion">Fecha de Adquisición</label>
        <input type="date" name="fecha_adquisicion" id="fecha_adquisicion" onblur="validarCampo('fecha_adquisicion', this.value)">
        <div id="errorFechaAdquisicion" class="errorValidacion"></div>
        <br>
        <br>
        <label for="valor">Valor</label>
        <input type="number" step="0.01" name="valor" id="valor" onblur="validarCampo('valor', this.value)">
        <div id="errorValor" class="errorValidacion"></div>
        <br>
        <br>
        <label for="ubicacion">Ubicación</label>
        <input type="text" name="ubicacion" id="ubicacion" onblur="validarCampo('ubicacion', this.value)">
        <br>
        <br>
        <div id="errorUbicacion" class="errorValidion"></div>
        <label for="observaciones">Observaciones</label>
        <input type="text" name="observaciones" id="observaciones" onblur="validarCampo('observaciones', this.value)">
        <div id="errorObservaciones" class="errorValidacion"></div>
        <br>
        <br>
        <label for="estado">Estado</label>
        <input type="text" name="estado" id="estado" onblur="validarCampo('estado', this.value)">
        <div id="errorEstado" class="errorValidacion"></div>
        <br>
        <br>
        <label for="tipo">Tipo</label>
        <input type="text" name="tipo" id="tipo" onblur="validarCampo('tipo', this.value)">
        <div id="errorTipo" class="errorValidacion"></div>
        <br>
        <br>
        <input type="submit" value="Registrar">
    </form>

@endsection

<script>
    // Escucha el evento de cambio en el input de imagen
    document.getElementById('input-imagen').addEventListener('change', function() {
        // Obtén el nombre del archivo seleccionado
        var fileName = this.files[0].name;
        // Actualiza el texto del label con el nombre del archivo
        var label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    });
</script>
