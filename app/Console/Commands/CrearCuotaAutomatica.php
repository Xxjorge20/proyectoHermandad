<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CuotaController; // Asegúrate de importar tu controlador

class CrearCuotaAutomatica extends Command
{
    protected $signature = 'crear:cuota-automatica';
    protected $description = 'Crea cuotas automáticas para todos los hermanos';

    public function handle()
    {
        $controller = new CuotaController();
        $controller->crearCuotaAutomatica();
        $this->info('Tarea programada ejecutada correctamente.');
    }
}
