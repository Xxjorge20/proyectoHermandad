<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Santa Rita Casia </title>
    <link rel="stylesheet" href="{{asset('Estilos/style.css')}}">
    <link rel="shortcut icon" href="{{asset('Estilos/Imagenes/Rosa.png')}}" type="image/x-icon">
</head>
<body>

    <div id = "cabecera">
        <div id = "logo">
            <img src="{{asset('Estilos/Imagenes/BannerS.png')}}" alt="logo">
        </div>

        <div id="menu">
            <ul>
                @yield('menu')
                    <!-- menu de administrador si el cargo del hermano es distinto a hermano id 2 -->
                    @if (Auth::user()->cargo_id != 2)
                        <li><a href="{{ route('menu.hermano') }}">Panel Administrador</a></li>
                    @endif
                <li><a href="{{ route('hermanos.cerrarSesion') }}">Cerrar Sesión</a></li>
            </ul>
        </div>




    <div id="wrapper">
        <div id="contenido">
            <!-- Aquí irá el contenido de la página (Implementación con blade) -->
            @yield('contenido')
        </div>

        <div id="lateralDerecho">
            <!-- Widget de los últimos 5 tweets de la hermandad -->
            <div class="twitter-widget">
                <h3>Últimos Tweets</h3>
                <a class="twitter-timeline" data-theme="light" href="https://twitter.com/HdadGranPoder?ref_src=twsrc%5Etfw">Tweets by HdadGranPoder</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <!-- Aquí irá el contenido del lateral derecho de la página (Implementación con blade) -->
            @yield('lateralDerecho')
        </div>
    </div>


    <footer class="pie">
        <!-- Sección "Dónde estamos" -->
        <div class="footer-section">
            <h4>Dónde estamos</h4>
            <div class="map-widget">
                <p>Dirección: Reino De Luque, S/N</p>
                <p>Ciudad: Luque</p>
                <p>Código Postal: 14880</p>
            </div>
        </div>
        <!-- Sección "Contacto" -->
        <div class="footer-section">
            <h4>Contacto</h4>
            <p>Teléfono: +34 123 456 789</p>
            <p>Email: info@reinodeluque.es</p>
        </div>

        <!-- Sección "Redes Sociales" -->
        <div class="footer-section">
            <h4>Redes Sociales</h4>
            <div class="social-icons">
                <a href="https://www.facebook.com/hermandaddelgranpoder/?locale=es_ES"><img src="{{asset('Estilos/Imagenes/LogoFacebook.png')}}" alt="Facebook" width="40" height="40"></a>
                <a href="https://www.instagram.com/hermandadgranpoder/"><img src="{{asset('Estilos/Imagenes/LogoInstagram.jpg')}}" alt="Twitter" width="40" height="40"></a>
                <a href="https://twitter.com/HdadGranPoder"><img src="{{asset('Estilos/Imagenes/LogoTwitter.jpeg')}}" alt="Instagram" width="40" height="40"></a>
                <a href="https://www.youtube.com/@GranpoderEsp"><img src="{{asset('Estilos/Imagenes/LogoYoutube.png')}}" alt="YouTube" width="40" height="40"></a>
            </div>
        </div>

        <!-- Widget de verificación W3C -->
        <div class="footer-section">
            <h4>Verificado por W3C</h4>
            <p>
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img style="border:0;width:88px;height:31px"
                        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
                        alt="¡CSS Válido!" />
                </a>
            </p>
        </div>
    </footer>

</body>
</html>
