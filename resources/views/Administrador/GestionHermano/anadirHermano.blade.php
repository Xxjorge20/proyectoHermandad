@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.GestionHermano.panelHermano') }}">Gestionar Hermanos</a>
    </li>
    <li>
        <a href="{{ route('administrador.GestionHermano.crearHermano') }}">Añadir Hermanos</a>
    </li>
@endsection



@section('contenido')

    <h1>Añadir Hermano</h1>
    <form action="{{ route('administrador.hermano.store') }}" method="post">
        @csrf
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br>
        <br>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos">
        <br>
        <br>
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">
        <br>
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <br>
        <br>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password">
        <br>
        <br>
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion">
        <br>
        <br>
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono">
        <br>
        <br>
        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
        <br>
        <br>
        <label for="fecha_bautismal">Fecha de Bautismo</label>
        <input type="date" name="fecha_bautismal" id="fecha_bautismal">
        <br>
        <br>
        <div class="form-group">
            <label for="cargo_id">Cargo</label>
            <select name="cargo_id" id="cargo_id" class="form-control">
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <br>
        <input type="submit" value="Registrar">
    </form>
@endsection
