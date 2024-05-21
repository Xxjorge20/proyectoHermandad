<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hermano;
use Illuminate\Http\Request;

class GraficosController extends Controller
{

    /**
     * Obtiene un gráfico que muestra la cantidad de hermanos registrados por año.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function graficoHermanosPorAno()
    {
        $hermanosPorAno = Hermano::selectRaw('YEAR(fecha_alta) as ano, COUNT(*) as cantidad')
            ->groupBy('ano')
            ->orderBy('ano')
            ->get();

        return response()->json($hermanosPorAno);
    }
    /**
     * Obtiene el gráfico de cultos por año.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function graficoCultosPorAno()
    {
        $cultosPorMes = Culto::selectRaw('MONTH(fecha) as mes, COUNT(*) as cantidad')
            ->whereYear('fecha', date('Y')) // Filtrar por el año actual
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        dd($cultosPorMes); // Verifica los resultados parciales

        return response()->json($cultosPorMes);
    }


    /**
     * Recupera los datos para el gráfico de cuotas en el último año.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function graficoCuotas()
    {
        // Lógica para obtener datos de cuotas en el último año
        // ...

        return response()->json($datos);
    }
}
