<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patrimonio;
use Illuminate\Support\Facades\Auth;

class PatrimonioController extends Controller
{
    // panel patrimonio
    public function panelPatrimonio(){
        $patrimonios = Patrimonio::all();
        return view('administrador.GestionPatrimonio.panelPatrimonio', compact('patrimonios'));
    }
    // Crear patrimonio
    public function crearPatrimonio(){
        return view('administrador.GestionPatrimonio.anadirPatrimonio');
    }
    // Store patrimonio

    public function store(Request $request){

        try {

            $hermanoAutenticado = Auth::user();
            // Asocia el hermano autenticado al patrimonio en la tabla intermedia
            if ($hermanoAutenticado) {
                // Intenta crear un nuevo patrimonio
                $patrimonio = Patrimonio::create($request->except('_token'));
                $patrimonio->hermanos()->attach($hermanoAutenticado->id, ['asignado_por' => $hermanoAutenticado->nombre]);
            }

            // Si se crea exitosamente, redirige con un mensaje de éxito
            return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('success', 'Patrimonio creado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error y el error en el mensaje
            return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('error', 'Error al crear el patrimonio: ' . $e->getMessage());
        }
    }

    // Editar patrimonio
    public function modificarPatrimonio($id){
        $patrimonio = Patrimonio::find($id);
        return view('administrador.GestionPatrimonio.modificarPatrimonio', compact('patrimonio'));
    }

    // Update patrimonio
    public function update(Request $request, $id){
        try {
            // Obtenemos el patrimonio a modificar
            $patrimonio = Patrimonio::find($id);

            // Actualizamos el patrimonio
            $patrimonio->update($request->except('_token'));

            // Si se actualiza exitosamente, redirige con un mensaje de éxito
            return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('success', 'Patrimonio actualizado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error y el error en el mensaje
            return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('error', 'Error al actualizar el patrimonio: ' . $e->getMessage());
        }
    }

    // Eliminar patrimonio
    public function destroy($id){
        try {
            // Obtenemos el patrimonio a eliminar
            $patrimonio = Patrimonio::findOrFail($id);
            $patrimonio->hermanos()->detach();

            // Eliminamos el patrimonio
            if($patrimonio->hermanos->count() == 0) {
                $patrimonio->delete();
            }
            // Si se elimina exitosamente, redirige con un mensaje de éxito
            return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('success', 'Patrimonio eliminado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error y el error en el mensaje
            return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('error', 'Error al eliminar el patrimonio: ' . $e->getMessage());
        }
    }

    // Consultar patrimonio por nombre
    public function consultarPatrimonioNombre(Request $request){
        $patrimonios = Patrimonio::where('nombre', $request->nombre)->get();
        return view('hermanos.consultarPatrimonio', compact('patrimonios'));
    }

    // Consultar patrimonio por nombre
    public function consultarPatrimonioNombreAdmin(Request $request){
        $patrimonios = Patrimonio::where('nombre', $request->nombre)->get();
        return view('administrador.GestionPatrimonio.panelPatrimonio', compact('patrimonios'));
    }

    // Consultar patrimonio
    public function consultarPatrimonio(){
        $patrimonios = Patrimonio::all();
        return view('hermanos.consultarPatrimonio', compact('patrimonios'));
    }
}
