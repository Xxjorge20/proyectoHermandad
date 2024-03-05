
var ctx = document.getElementById('graficoHermanos').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        // Datos obtenidos del controlador
        labels: ['Año 1', 'Año 2', 'Año 3'],
        datasets: [{
            label: 'Número de Hermanos',
            data: [10, 20, 15],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        // Opciones del gráfico
        // ...
    }
});
