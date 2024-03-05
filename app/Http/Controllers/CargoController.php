<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CargoController extends Controller
{

    // Consultar Junta de Gobierno
    public function consultarJuntaGobierno()
    {
        // Obtener todos los hermanos con cargo distinto a Hermano
        $hermanos = Hermano::where('cargo_id', '!=', 1)->get();
        return view('hermanos.consultarJuntaGobierno', compact('hermanos'));
    }

    // Asignar cargo a hermano
    public function asignarCargo(Request $request)
    {
        // Validar datos
        $request->validate([
            'hermano_id' => 'required',
            'cargo_id' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);

        // Crear el cargo
        $cargo = Cargo::Create([
            'hermano_id' => $request->hermano_id,
            'cargo_id' => $request->cargo_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
    }

    public function cargarCargos()
    {
        $cargos = Cargo::all();
        return response()->json($cargos);
    }


}
