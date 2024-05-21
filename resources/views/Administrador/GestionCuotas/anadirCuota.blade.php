@extends('plantillas.plantillaAdmin')

@section('menu')
    <li>
        <a href="{{ route('administrador.gestionCuotas.panelCuotas') }}">Gestionar Cuotas</a>
    </li>
    <li><a href="{{ route('hermanos.paginaHermanos') }}">Pagina Inicio</a></li>
    <li><a href="{{ route('hermanos.consultarCuotas') }}">Consultar Cuota</a></li>

@endsection


@section('contenido')

@endsection
