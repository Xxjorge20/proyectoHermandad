<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hermano;
use Illuminate\Http\Request;

class GraficosController extends Controller
{
    public function graficoHermanosPorAno()
    {
        $hermanosPorAno = Hermano::selectRaw('YEAR(fecha_alta) as ano, COUNT(*) as cantidad')
            ->groupBy('ano')
            ->orderBy('ano')
            ->get();

        return response()->json($hermanosPorAno);
    }

    public function graficoCultos()
    {
        // Lógica para obtener datos de cultos en el último año
        // ...

        return response()->json($datos);
    }

    public function graficoCuotas()
    {
        // Lógica para obtener datos de cuotas en el último año
        // ...

        return response()->json($datos);
    }
}
