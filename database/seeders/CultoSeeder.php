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
    public function run(): void
    {
        $faker = Faker::create();

        // Crear 20 cultos ficticios
        for ($i = 0; $i < 100; $i++) {
            $culto = Culto::create([
                'nombre' => $faker->sentence,
                'descripcion' => $faker->paragraph,
                'fecha' => $faker->date,
                'hora' => $faker->time,
                'lugar' => $faker->word,
                'aforo' => $faker->randomNumber,
                'imagen' => $faker->imageUrl,
            ]);

            // Obtener algunos hermanos ficticios
            $hermanos = Hermano::inRandomOrder()->limit(5)->get();

            // Adjuntar hermanos al culto con asignado_por
            foreach ($hermanos as $hermano) {
                $culto->hermanos()->attach($hermano->id, ['asignado_por' => $hermano->nombre]);
            }

        }
    }
}
