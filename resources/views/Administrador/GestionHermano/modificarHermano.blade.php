
@extends('plantillas.plantillaAdmin')

@section('menu')

    <li><a href="{{ route('hermanos.paginaHermanos') }}">Pagina Inicio</a></li>
    <li><a href="{{ route('administrador.GestionHermano.panelHermano') }}">Gestionar Hermanos</a></li>
    <li><a href="{{ route('administrador.GestionHermano.crearHermano') }}">Añadir Hermanos</a></li>
    <li><a href="{{ route('hermanos.consultarCuotas') }}">Consultar Cuota</a></li>

@endsection


<script src="{{ asset('js/validacionesHermano.js') }}"></script>

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
                        <input type="text" class="form-control" name="nombre" value="{{$hermano->nombre}}" onblur="validarCampo('nombre', this.value)">
                    </div>
                    <div id="errorNombre" class="errorValidacion"></div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" value="{{$hermano->apellidos}}" onblur="validarCampo('apellidos', this.value)">
                    </div>
                    <div id = "errorApellidos" class="errorValidiacion"></div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" name="dni" value="{{$hermano->dni}}" readonly>
                    </div>
                    <div id="errorDNI" class="errorValidacion" ></div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$hermano->email}}" onblur="validarCampo('email', this.value)">
                    </div>
                    <div id="errorEmail" class="errorValidacion"></div>
                    <div class="form-group" hidden>
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" value="{{$hermano->password}}" onblur="validarCampo('password', this.value)">
                    </div>
                    <div id="errorPassword" class="errorValidacion"></div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{$hermano->direccion}}" onblur="validarCampo('direccion', this.value)">
                    </div>
                    <div id="errorDireccion" class="errorValidacion"></div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{$hermano->telefono}}" onblur="validarCampo('telefono', this.value)">
                    </div>
                    <div id="errorTelefono" class="errorValidacion"></div>
                    <div class="form-group" hidden>
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nacimiento" value="{{ $hermano->fecha_nacimiento->format('Y-m-d') }}" onblur="validarCampo('fecha_nacimiento', this.value)">
                    </div>
                    <div id="errorFechaNacimiento" class="errorValidacion"></div>
                    <div class="form-group" hidden>
                        <label for="fecha_bautismo">Fecha de Bautismo</label>
                        <input type="date" class="form-control" name="fecha_bautismo" value="{{ $hermano->fecha_bautismal->format('Y-m-d') }}" onblur="validarCampo('fecha_bautismo', this.value)">
                    </div>
                    <div id="errorFechaBautismo" class="errorValidacion"></div>
                    <div class="form-group" hidden>
                        <label for="fecha_alta">Fecha de Alta</label>
                        <input type="date" class="form-control" name="fecha_alta" value="{{ $hermano->fecha_alta->format('Y-m-d') }}" onblur="validarCampo('fecha_alta', this.value)">
                    </div>

                    <div id="errorFechaAlta" class="errorValidacion"></div>
                    <div class="form-group">
                        <label for="cargo_id">Cargo</label>
                        <select name="cargo_id" id="cargo_id" class="form-control" onblur="validarCampo('cargo_id', this.value)">
                            <option value="{{ $hermano->cargo_id }}" selected>{{ $hermano->cargo->nombre }}</option>
                            @foreach($cargos as $cargo)
                                <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="errorCargo" class="errorValidacion"></div>
                    <br>
                    <br>
                    <input type="submit" value="Modificar" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
@endsection

