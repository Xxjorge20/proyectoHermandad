@extends('plantillas.plantillaAdmin')

@section('menu')

    <li><a href="{{ route('hermanos.paginaHermanos') }}">Pagina Inicio</a></li>
    <li><a href="{{ route('hermanos.consultarCuotas') }}">Consultar Cuota</a></li>
    <li>
        <a href="{{ route('administrador.gestionCuotas.panelCuotas') }}">Gestionar Cuotas</a>
    </li>

    <li>
        <a href="{{ route('administrador.GestionCultos.panelCultos') }}">Gestionar Cultos</a>
    </li>

    <li>
        <a href="{{ route('administrador.GestionHermano.panelHermano') }}">Gestionar Hermanos</a>
    </li>

    <li>
        <a href="{{ route('administrador.GestionPatrimonio.panelPatrimonio') }}">Gestionar Patrimonio</a>
    </li>
@endsection


@section('contenido')

<!-- Grafico del total de hermanos por año de alta -->
<div class="container">
    <h1>Gráfico de Hermanos por año de alta</h1>
    <canvas id="graficoHermanos"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener datos desde la ruta del controlador
            fetch("{{ route('grafico.hermanos.por.ano') }}")
                .then(response => response.json())
                .then(data => {
                    var ctx = document.getElementById('graficoHermanos').getContext('2d');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.map(item => item.ano),
                            datasets: [{
                                label: 'Hermanos por Año',
                                data: data.map(item => item.cantidad),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
</div>





@endsection

