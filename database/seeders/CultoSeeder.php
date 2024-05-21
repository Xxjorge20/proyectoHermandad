<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Culto;
use App\Models\Hermano;

class CultoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Obtener la ruta de la carpeta de imágenes de cultos
        $rutaCarpeta = public_path('estilos/imagenes/cultos');
        $archivos = File::files($rutaCarpeta);

        // Año actual
        $anio = date('Y');

        // Crear los cultos para los domingos del año en curso
        foreach ($this->getDomingosDelAnio($anio) as $domingo) {
            // Crear culto para cada domingo
            $culto = Culto::create([
                'nombre' => 'Dia del Señor',
                'descripcion' => 'Misa del domingo en la Parroquia Nuestra Señora de la Asunción oficiada por el Parroco Don Manuel Rabadan.',
                'fecha' => $domingo,
                'hora' => '12:00:00', // Hora de la misa
                'lugar' => 'Parroquia Nuestra Señora de la Asunción',
                'aforo' => 100,
                'imagen' => $archivos[4], // Imagen misa.png
            ]);

            // Obtener el hermano con el rol de 17
            $hermano = Hermano::where('rol', 17)->first();

            // Adjuntar hermanos al culto con asignado_por
            $culto->hermanos()->attach($hermano->id, ['asignado_por' => $hermano->nombre]);
        }

    }

    /**
     * Obtener las fechas de los domingos del año en curso.
     *
     * @param int $anio Año para el cual obtener las fechas de los domingos.
     * @return array Arreglo de fechas de los domingos.
     */
    private function getDomingosDelAnio($anio)
    {
        $fecha = new DateTime($anio . '-01-01');
        $domingos = [];

        while ($fecha->format('Y') == $anio) {
            $diaSemana = $fecha->format('w'); // Obtener el día de la semana
            if ($diaSemana == 0) { // Si es domingo (0)
                $domingos[] = $fecha->format('Y-m-d'); // Almacenar la fecha
            }
            $fecha->modify('+1 day'); // Avanzar al próximo día
        }

        return $domingos;
    }

}
