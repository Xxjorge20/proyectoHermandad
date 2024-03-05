@extends('plantillas.plantillaAdmin')
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
                        <input type="text" class="form-control" name="nombre" value="{{ $patrimonio->nombre }}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $patrimonio->descripcion }}">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="text" class="form-control" name="imagen" value="{{ $patrimonio->imagen }}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_adquisicion">Fecha de Adquisición</label>
                        <input type="date" class="form-control" name="fecha_adquisicion" value="{{ $patrimonio->fecha_adquisicion }}">
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input type="number" step="0.01" class="form-control" name="valor" value="{{ $patrimonio->valor }}">
                    </div>
                    <div class="form-group">
                        <label for="ubicacion">Ubicación</label>
                        <input type="text" class="form-control" name="ubicacion" value="{{ $patrimonio->ubicacion }}">
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <input type="text" class="form-control" name="observaciones" value="{{ $patrimonio->observaciones }}">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" name="estado" value="{{ $patrimonio->estado }}">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" name="tipo" value="{{ $patrimonio->tipo }}">
                    </div>
                    <input type="submit" value="Modificar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
