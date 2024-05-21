@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.gestionCuotas.panelCuotas') }}">Gestionar Cuotas</a>
    </li>
    <li><a href="{{ route('hermanos.paginaHermanos') }}">Pagina Inicio</a></li>
    <li><a href="{{ route('hermanos.consultarCuotas') }}">Consultar Cuota</a></li>

@endsection

@section('contenido')


    <h1>Gestión de Cuotas</h1>

    <h1>Consultar Cuotas - por Hermano</h1>

    <div class="container">
        <div class="DatosFormulario">
            <h2>Buscar cuotas por nombre</h2>
            <form action="{{ route('administrador.gestionCuotas.consultarCuotasNombre') }}" method="post">
                @csrf
                <label for="hermano">Hermano:</label>
                <select name="hermano" id="hermano">
                    @foreach ($hermanos as $h)
                        <option value="{{ $h->id }}">{{ $h->nombre ." " . $h->apellidos }}</option>
                    @endforeach
                </select>
                <br>
                <br>
                <input type="submit">Consultar
            </form>
        </div>

        <div class="DatosFormulario">
            <h2>Buscar cuotas por DNI:</h2>
            <form action="{{ route('administrador.gestionCuotas.consultarCuotaDNI') }}" method="post">
                @csrf
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni">
                <input type="submit">Consultar
            </form>
        </div>
    </div>



    <div class="container">
        <h2>Consultar Justificantes</h2>
        <div class="container">
            <div class="CajonDatos">
                @if (!empty($justificantes) && (!empty($hermanoSeleccionado)))
                    <h3>Justificantes de {{ $hermanoSeleccionado->nombre }}</h3>
                    <ul>
                        @foreach ($justificantes as $justificante)
                            @php
                                // Obtener el nombre del archivo
                                $nombreArchivo = pathinfo($justificante, PATHINFO_FILENAME);
                                // Obtener el ID de la cuota (los últimos dígitos antes de la extensión)
                                $posGuionBajo = strrpos($nombreArchivo, '_');
                                $idCuota = substr($nombreArchivo, $posGuionBajo + 1);
                            @endphp
                            <h2> Justificante de la cuota con id: {{ $idCuota }} </h2>
                            <br>
                            <a class="custom-button" href="{{ asset($justificante) }}" download>Descargar Justificante cuota</a>
                            <a class="custom-button" href="{{ asset($justificante) }}" target="_blank">Abrir en nueva pestaña</a>
                            <br>
                            <br>
                        @endforeach
                    </ul>
                @else
                    <h3>No hay justificantes disponibles para este hermano.</h3>
                @endif
            </div>
        </div>

    </div>


    <div class="container">


        <div class="CajonDatos">
            @if (!empty($hermanoSeleccionado))
                <h2>Información del hermano</h2>
                <p><strong>Nombre:</strong> {{ $hermanoSeleccionado->nombre }}</p>
                <p><strong>Apellidos:</strong> {{ $hermanoSeleccionado->apellidos }}</p>
                <p><strong>DNI:</strong> {{ $hermanoSeleccionado->dni }}</p>
                <p><strong>Correo Electrónico:</strong> {{ $hermanoSeleccionado->email }}</p>
            @else
                <p>No se ha encontrado ningún hermano con ese nombre o DNI.</p>
            @endif
        </div>

        <div class="CajonDatos">

            @if (!empty($cuotas))
            <h2>Cuotas del hermano </h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Cuota</th>
                        <th>Nombre</th>
                        <th>Importe</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuotas as $cuota)
                        <tr>
                            <td><strong><p>{{ $cuota->id }}</p></strong></td>
                            <td><p>{{ $cuota->nombre }}</p></td>
                            <td><p>{{ $cuota->importe }}</p></td>
                            <td><p>{{ $cuota->fecha }}</p></td>
                            <br>
                            <td><p>{{ $cuota->pagada ? 'Pagada' : 'Pendiente' }}<p></td>
                            <td>
                                <br>
                                <a  href="{{ route('cuota.imprimirRecibo', ['cuotaId' => $cuota->id]) }}" class="btn btn-primary">Imprimir Recibo</a>
                                <br>
                                <br>
                                @if (!$cuota->pagada)
                                <a href="{{ route('cuota.actualizarCuotaPagada', ['cuotaId' => $cuota->id]) }}" class="btn btn-primary">Marcar como pagada</a>
                                @endif
                                <br>
                            </td>
                            <br>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <br>
                {{ $cuotas->links() }}
            @else
                <p>No hay cuotas disponibles para este hermano.</p>
            @endif
        </div>
    </div>

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


@endsection
