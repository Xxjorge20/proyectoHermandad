<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Cargo;
use Carbon\Carbon;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear cargos

        // Hermano
        Cargo::create([
            'id'=> 2,
            'nombre' => 'Hermano',
            'descripcion' => 'Sin cargo',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);


        // Hermano Mayor
        Cargo::create([
            'id'=> 1,
            'nombre' => 'Hermano Mayor',
            'descripcion' => 'Encargado de la hermandad',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Mayordomo
        Cargo::create([
            'id'=> 3,
            'nombre' => 'Mayordomo',
            'descripcion' => 'Encargado de la economía de la hermandad',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now(),
        ]);

        // Diputado Mayor de Gobierno
        Cargo::create([
            'id'=> 4,
            'nombre' => 'Diputado Mayor de Gobierno',
            'descripcion' => 'responsable de la organización y el orden de todos los cultos externos que celebre o en los que participe corporativamente la Hermandad',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Secretario
        Cargo::create([
            'id'=> 5,
            'nombre' => 'Secretario',
            'descripcion' => 'Dar fe de los actos y acuerdos de los órganos de la Hermandad y, como tal fedatario extender las certificaciones que le soliciten y se deduzcan de los libros y documentos de la Hermandad, autorizándola con su firma y el visto bueno del Hermano Mayor',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Tesorero
        Cargo::create([
            'id'=> 6,
            'nombre' => 'Tesorero',
            'descripcion' => ' Tendrá a su cargo los pagos, cobranza de cuotas, limosnas y donativos para la hermandad y cofradía',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Fiscal
        Cargo::create([
            'id'=> 7,
            'nombre' => 'Fiscal',
            'descripcion' => 'El Fiscal de la Hermandad es aquel encargado del cumplimiento de los Estatutos y Reglamento de Régimen Interno, así como de que todas las actividades de la Hermandad se ajusten a lo indicado en los mismos',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Diputado de Caridad
        Cargo::create([
            'id'=> 8,
            'nombre' => 'Diputado de Caridad',
            'descripcion' => 'Cuidar de la coordinación y el cumplimiento de toda la Obra caritativa y asistencial de la Hermandad. Presidir las reuniones de la Bolsa de Caridad en los casos que procedan y previstos en estas Reglas',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Diputado de Formación
        Cargo::create([
            'id'=> 9,
            'nombre' => 'Diputado de Formación',
            'descripcion' => 'Serán funciones del Diputado de Formación: Establecer en unión con el Director Espiritual, las directrices de los programas formativos, encaminados a profundizar en la formación religiosa de los hermanos y en el conocimiento de la Palabra de Dios y de la Doctrina de la Iglesia',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Diputado de Juventud
        Cargo::create([
            'id'=> 10,
            'nombre' => 'Diputado de Juventud',
            'descripcion' => 'Estimular la vida espiritual de los jóvenes, cuidar de su formación integral, facilitar su incorporación a la Iglesia y a la sociedad y promover el conocimiento y comprensión de estas Reglas y su participación activa en la vida de la Hermandad',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Diputado de Relaciones Públicas
        Cargo::create([
            'id'=> 11,
            'nombre' => 'Diputado de Relaciones Públicas',
            'descripcion' => 'Encargarse de las relaciones de protocolo de la Hermandad en todos los actos e intervenciones y velar por el cumplimiento de las normas de cortesía cofrade y social.',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Diputado de Cultos
        Cargo::create([
            'id'=> 12,
            'nombre' => 'Diputado de Cultos',
            'descripcion' => 'Se encargará de las intenciones de las Eucaristías y demás cultos de la Hermandad, especialmente en la aplicación de las Misas por los hermanos fallecidos. Procurar que las necesidades de asistencia sacerdotal queden debidamente cubiertas',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Diputado de Formación
        Cargo::create([
            'id'=> 13,
            'nombre' => 'Diputado de Formación',
            'descripcion' => 'Establecer en unión con el Director Espiritual, las directrices de los programas formativos, encaminados a profundizar en la formación religiosa de los hermanos y en el conocimiento de la Palabra de Dios y de la Doctrina de la Iglesia',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);


        // Diputado de Relaciones Públicas
        Cargo::create([
            'id'=> 14,
            'nombre' => 'Diputado de Relaciones Públicas',
            'descripcion' => 'Encargarse de las relaciones de protocolo de la Hermandad en todos los actos e intervenciones y velar por el cumplimiento de las normas de cortesía cofrade y social',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Gestor de patrimonio
        Cargo::create([
            'id'=> 15,
            'nombre' => 'Gestor de patrimonio',
            'descripcion' => ' se encarga de la planificación, ejecución y monitorización de tareas para las que requiere un equipo multidisciplinar formado por técnicos especialistas en las diferentes áreas. Entre sus funciones destacan: Investigación y análisis del patrimonio',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Prioste
        Cargo::create([
            'id'=> 16,
            'nombre' => 'Prioste',
            'descripcion' => 'Encargado de la custodia y conservación de los enseres y patrimonio de la hermandad',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Parroco
        Cargo::create([
            'id'=> 17,
            'nombre' => 'Parroco',
            'descripcion' => 'Encargado de la parroquia',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);

        // Rector de la Iglesia
        Cargo::create([
            'id'=> 18,
            'nombre' => 'Rector de la Iglesia',
            'descripcion' => 'Encargado de la iglesia',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addYears(4),
        ]);



    }
}
