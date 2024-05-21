@extends('plantillas.plantilla')
@section('contenido')

    <!-- Boton Volver -->
    <a href="{{route('paginaInicio')}}" class="btn btn-primary">Volver</a>

    <h1>Origenes de Santa Rita</h1>
    <div class="container">

        <h2>Viuda, Religiosa,
            y Abogada de Imposibles</h2>

        <div class="CajonDatos">

            <p>
                Martirologio Romano: Santa Rita, religiosa, que, casada con un hombre violento,
                 toleró pacientemente sus crueldades reconciliándolo con Dios,
                 y al morir su marido y sus hijos ingresó en el monasterio de la Orden de San Agustín en Casia,
                 <br>
                 de la Umbría, en Italia,
                 dando a todos un ejemplo sublime de paciencia y compunción († c.1457).
            </p>


        </div>
        <div class="CajonDatos">
            <p>
                Fecha de beatificación: 1 de octubre de 1627 por el Papa Urbano VIII
                <br>
                Fecha de canonizacicón: 24 de mayo de 1900 por el Papa León XIII
            </p>
        </div>


        <div class="CajonDatos">
            <p>
                Vista de cerca, sin el halo de la leyenda, se nos revela el rostro humanísimo de una mujer que no pasó indiferente ante la tragedia del dolor y de la miseria material, moral y social. Su vida terrena podría ser de ayer como de hoy.
            </p>
        </div>


            <img src="{{asset('Estilos/Imagenes/SantaRita1.jpg')}}" alt="Santa Rita" width="300" height="400">
            <p>Imagen de Santa Rita de Casia (Luque)</p>


        <div class="CajonDatos">
            <p>
                Rita nació en 1381 en Roccaporena, un pueblito perdido en las montañas apeninas. Sus ancianos padres la educaron en el temor de Dios, y ella respetó a tal punto la autoridad paterna que abandonó el propósito de entrar al convento y aceptó unirse en matrimonio con Pablo de Ferdinando, un joven violento y revoltoso. Las biografías de la santa nos pintan un cuadro familiar muy común: una mujer dulce, obediente, atenta a no chocar con la susceptibilidad del marido, cuyas maldades ella conoce, y sufre y reza en silencio.
            </p>
        </div>

        <div class="CajonDatos">
            <p>
                Su bondad logró finalmente cambiar el corazón de Pablo, que cambió de vida y de costumbres, pero sin lograr hacer olvidar los antiguos rencores de los enemigos que se había buscado. Una noche fue encontrado muerto a la vera del camino. Los dos hijos, ya grandecitos, juraron vengar a su padre. Cuando Rita se dio cuenta de la inutilidad de sus esfuerzos para convencerlos de que desistieran de sus propósitos, tuvo la valentía de pedirle a Dios que se los llevara antes que mancharan sus vidas con un homicidio. Su oración, humanamente incomprensible, fue escuchada. Ya sin esposo y sin hijos, Rita fue a pedir su entrada en el convento de las agustinas de Casia. Pero su petición fue rechazada.
            </p>
        </div>

        <div class="CajonDatos">
            <p>
                Regresó a su hogar desierto y rezó intensamente a sus tres santos protectores, san Juan Bautista, san Agustín y san Nicolás de Tolentino, y una noche sucedió el prodigio. Se le aparecieron los tres santos, le dijeron que los siguiera, llegaron al convento, abrieron las puertas y la llevaron a la mitad del coro, en donde las religiosas estaban rezando las oraciones de la mañana. Así Rita pudo vestir el hábito de las agustinas, realizando el antiguo deseo de entrega total a Dios. Se dedicó a la penitencia, a la oración y al amor de Cristo crucificado, que la asoció aun visiblemente a su pasión, clavándole en la frente una espina.
            </p>
        </div>

        <div class="CajonDatos">
            <p>
                Este estigma milagroso, recibido durante un éxtasis, marcó el rostro con una dolorosísima llaga purulenta hasta su muerte, esto es, durante catorce años. La fama de su santidad pasó los limites de Casia. Las oraciones de Rita obtuvieron prodigiosas curaciones y conversiones. Para ella no pidió sino cargar sobre sí los dolores del prójimo. Murió en el monasterio de Casia en 1457 y fue canonizada en el año 1900.
            </p>
        </div>



    </div>

    <!-- Boton Volver -->
    <a href="{{route('paginaInicio')}}" class="btn btn-primary">Volver</a>


@endsection
