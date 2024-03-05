
@extends('plantillas.plantillaAdmin')
@section('contenido')
    <h1>Modificar Hermano</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('administrador.GestionHermano.update', ['id' => $hermano->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{$hermano->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" value="{{$hermano->apellidos}}">
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" name="dni" value="{{$hermano->dni}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$hermano->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" value="{{$hermano->password}}">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{$hermano->direccion}}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{$hermano->telefono}}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nacimiento" value="{{$hermano->fecha_nacimiento}}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_bautismo">Fecha de Bautismo</label>
                        <input type="date" class="form-control" name="fecha_bautismo" value="{{$hermano->fecha_bautismal}}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_alta">Fecha de Alta</label>
                        <input type="date" class="form-control" name="fecha_alta" value="{{$hermano->fecha_alta}}">
                    </div>
                    <div class="form-group">
                        <label for="cargo_id">Cargo</label>
                        <select name="cargo_id" id="cargo_id" class="form-control">
                            <option value="{{ $hermano->cargo_id }}" selected>{{ $hermano->cargo->nombre }}</option>
                            @foreach($cargos as $cargo)
                                <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="Modificar" class="btn btn-primary">

                </form>
            </div>
        </div>
    </div>
@endsection

