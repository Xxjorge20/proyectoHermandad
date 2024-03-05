@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.GestionCultos.panelCultos') }}">Gestionar Cultos</a>
    </li>
    <li>
        <a href="{{ route('administrador.GestionCultos.crearCulto') }}">Añadir Cultos</a>
    </li>
@endsection

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
                        <input type="text" class="form-control" name="nombre" value="{{ $culto->nombre }}">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $culto->descripcion }}">
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha" value="{{ $culto->fecha }}">
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" class="form-control" name="hora" value="{{ $culto->hora }}">
                    </div>
                    <div class="form-group">
                        <label for="lugar">Lugar</label>
                        <input type="text" class="form-control" name="lugar" value="{{ $culto->lugar }}">
                    </div>
                    <div class="form-group">
                        <label for="aforo">Aforo</label>
                        <input type="text" class="form-control" name="aforo" value="{{ $culto->aforo }}">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="text" class="form-control" name="imagen" value="{{ $culto->imagen }}">
                    </div>
                    <input type="submit" value="Modificar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
