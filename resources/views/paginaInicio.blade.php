@extends('plantillas.plantilla')
@section('contenido')

    <h1>Ultimas Noticias en el ambito cofrade</h1>
    <div id="rss-container">
        <script>
            $(document).ready(function () {
                // URL del feed RSS
                var rssUrl = 'https://www.diariodesevilla.es/rss/semana_santa/';

                // Realiza la solicitud AJAX para obtener el feed
                $.ajax({
                    url: 'https://api.rss2json.com/v1/api.json',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        rss_url: rssUrl
                    },
                    success: function (response) {
                        // Maneja la respuesta y muestra los eventos
                        if (response.status === 'ok') {
                            displayEvents(response.items);
                        } else {
                            console.error('Error al obtener el feed RSS');
                        }
                    },
                    error: function () {
                        console.error('Error en la solicitud AJAX');
                    }
                });

                // Función para mostrar los eventos en el contenedor
                function displayEvents(events) {
                    var rssContainer = $('#rss-container');

                    if (events.length > 0) {
                        // Crea una lista de eventos
                        var eventsList = '<ul>';
                        // Los imprime en la lista con el título y la fecha y imagen y en la imagen el link para acceder a la noticia
                        for (var i = 0; i < 10; i++) {
                            var event = events[i];
                            eventsList += '<li><a href="' + event.link + '">' + event.title + '</a> <br><img src="' + event.enclosure.link + '">  </li>';
                        }

                        eventsList += '</ul>';

                        // Agrega la lista al contenedor
                        rssContainer.html(eventsList);
                    } else {
                        rssContainer.html('No hay eventos disponibles');
                    }
                }
            });
        </script>
    </div>


@endsection
