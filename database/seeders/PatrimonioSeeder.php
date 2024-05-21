<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Patrimonio;
use App\Models\Hermano;

class PatrimonioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Crear 20 patrimonios ficticios
        for ($i = 0; $i < 100; $i++) {
            $patrimonio = Patrimonio::create([
                'nombre' => $faker->word,
                'descripcion' => $faker->paragraph,
                'imagen' => $faker->imageUrl,
                'fecha_adquisicion' => $faker->date,
                'valor' => $faker->randomFloat(2, 100, 1000),
                'ubicacion' => $faker->word,
                'observaciones' => $faker->sentence,
                'estado' => $faker->word,
                'tipo' => $faker->word,
            ]);

            // Obtener algunos con el rol de 15
            $hermanos = Hermano::where('rol', 15)->inRandomOrder()->take(5)->get();

            // Adjuntar hermanos al patrimonio con asignado_por
            foreach ($hermanos as $hermano) {
                $patrimonio->hermanos()->attach($hermano->id, ['asignado_por' => $hermano->nombre]);
            }
        }
    }
}
