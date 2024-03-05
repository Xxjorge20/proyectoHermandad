<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hermano;
use App\Models\Cargo;
use Faker\Factory as Faker;

class HermanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $faker = Faker::create();

        Hermano::create([
            'id' => 1,
            'nombre' => 'hermandadGranPoder',
            'apellidos' => 'Sevilla',
            'dni' => '12345678A',
            'email' => 'hermandadGranPoder@gmail.com',
            'password' => '1234',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '123456789',
            'fecha_nacimiento' => '1990-01-01',
            'fecha_bautismal' => '1990-01-01',
            'fecha_alta' => '2024-02-15',
            'cargo_id' => 1,
        ]);


        Hermano::create([
            'id' => 2,
            'nombre' => 'Jorge',
            'apellidos' => 'Lopez Bravo',
            'dni' => '12345678B',
            'email' => 'jorgelopezbravo1998@gmail.com',
            'password' => '1234',
            'direccion' => 'Calle Falsa 123',
            'telefono' => '123456789',
            'fecha_nacimiento' => '1990-01-01',
            'fecha_bautismal' => '1990-01-01',
            'fecha_alta' => '2024-02-15',
            'cargo_id' => 2,
        ]);

        // Obtener todos los cargos excepto el primero
        $cargosExcluidos = Cargo::where('id', '>', 1)->pluck('id')->toArray();

        for ($i = 3; $i <= 150; $i++) {
            $dni = $faker->numerify('########'); // Genera un número de 8 dígitos para simular un DNI
            $email = $faker->unique()->safeEmail;

            // Seleccionar aleatoriamente un cargo excluyendo el primero
            $cargoId = $faker->randomElement($cargosExcluidos);

            Hermano::create([
                'id' => $i,
                'nombre' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'dni' => $dni,
                'email' => $email,
                'password' => '1234',
                'direccion' => $faker->address,
                'telefono' => $faker->phoneNumber,
                'fecha_nacimiento' => $faker->date,
                'fecha_bautismal' => $faker->date,
                'fecha_alta' => $faker->date,
                'cargo_id' => $cargoId,
            ]);
        }


    }
}
