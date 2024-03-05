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

@endsection
