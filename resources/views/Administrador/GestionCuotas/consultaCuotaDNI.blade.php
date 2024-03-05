@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.gestionCuotas.panelCuotas') }}">Gestionar Cuotas</a>
    </li>
    <li>
        <a href="{{ route('administrador.gestionCuotas.anadirCuota') }}">Añadir Cuotas</a>
    </li>
@endsection

@section('contenido')

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Cuota</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuotas as $cuota)
                    <tr>
                        <td>{{ $cuota->hermano->dni }}</td>
                        <td>{{ $cuota->hermano->nombre }}</td>
                        <td>{{ $cuota->hermano->apellidos }}</td>
                        <td>{{ $cuota->cuota }}</td>
                        <td>{{ $cuota->fecha }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
