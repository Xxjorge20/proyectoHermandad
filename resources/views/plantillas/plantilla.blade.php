<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Hermandad Gran Poder </title>
    <link rel="stylesheet" href="{{asset('Estilos/style.css')}}">
    <link rel="shortcut icon" href="{{asset('Estilos/Imagenes/logo.png')}}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <div id = "cabecera">
        <div id = "logo">
            <a href="paginaPrincipal.php"><img src="{{asset('Estilos/Imagenes/banner.png')}}" alt="logo"></a>
        </div>

        <div id = "menu">
            <ul>
                <!-- Aqui iran los enlaces a las distintas paginas de la web -->
                <li><a href="historiaHermandad.php">Historia de Hermandad</a></li>
                <li><a href="videoTeca.php">Galeria de la hermandad</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <!-- Aqui irian los enlaces para acceder como hermano -->
                <li><a href="{{ route('hermanos.registroHermanos') }}">Hazte Hermano</a></li>
                <li><a href="{{ route('hermanos.accesoHermanos') }}">Acceso Hermanos</a></li>
                @yield('menu')
            </ul>
        </div>
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
