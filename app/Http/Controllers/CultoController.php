<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Culto;

class CultoController extends Controller
{
    // Panel cultos
    public function panelCultos(){

        // Obtenemos todos los cultos
        $cultos = Culto::all();

        return view('administrador.GestionCultos.panelCultos', compact('cultos'));
    }
    // Crear culto
    public function crearCulto(){
        return view('administrador.GestionCultos.anadirCultos');
    }


    // Almacenar culto
    public function store(Request $request){

        try {
            // Obtén el hermano autenticado
            $hermanoAutenticado = Auth::user();
            $idHermano = $hermanoAutenticado->id;
            $nombreHermano = $hermanoAutenticado->nombre;


            // Asocia el hermano autenticado al culto en la tabla intermedia
            if ($hermanoAutenticado) {
                // Intenta crear un nuevo culto
               // dd($idHermano, $nombreHermano);
                $culto = Culto::create($request->except('_token'));
                $culto->hermanos()->attach($idHermano, ['asignado_por' => $nombreHermano]);
            }

            // Si se crea exitosamente, redirige con un mensaje de éxito
            return redirect()->route('administrador.GestionCultos.panelCultos')->with('success', 'Culto creado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error y el error en el mensaje
            return redirect()->route('administrador.GestionCultos.panelCultos')->with('error', 'Error al crear el culto: ' . $e->getMessage());
        }
    }


    // Editar culto
    public function modificarCulto($id){
        $culto = Culto::find($id);
        return view('administrador.GestionCultos.modificarCultos', compact('culto'));
    }

    // Actualizar culto
    public function update(Request $request, $id){
        try {
            // Obtén el hermano autenticado
            $hermanoAutenticado = Auth::user();

            // Busca el culto que se va a actualizar
            $culto = Culto::findOrFail($id);

            // Actualiza los datos del culto
            $culto->update($request->except('hermano_id', 'asignado_por'));

            // Asocia el hermano autenticado al culto en la tabla intermedia
            $culto->hermanos()->sync([$hermanoAutenticado->id => ['asignado_por' => $hermanoAutenticado->nombre]], false);

            // Si se actualiza exitosamente, redirige con un mensaje de éxito
            return redirect()->route('administrador.GestionCultos.panelCultos')->with('success', 'Culto actualizado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error
            return redirect()->route('administrador.GestionCultos.panelCultos')->with('error', 'Error al actualizar el culto');
        }
    }

    // Eliminar culto
    public function destroy($id){
        try {
            // Obtén el hermano autenticado
            $hermanoAutenticado = Auth::user();

            // Busca el culto que se va a eliminar
            $culto = Culto::findOrFail($id);

            // Desasocia los hermanos del culto
            $culto->hermanos()->detach();

            // Si ya no hay hermanos asociados al culto, elimina el culto
            if ($culto->hermanos()->count() === 0) {
                $culto->delete();
            }

            // Si se elimina exitosamente, redirige con un mensaje de éxito
            return redirect()->route('administrador.GestionCultos.panelCultos')->with('success', 'Culto eliminado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error
            return redirect()->route('administrador.GestionCultos.panelCultos')->with('error', 'Error al eliminar el culto');
        }
    }

    // Consultar culto por nombre
    public function consultarCultoNombre(Request $request)
    {
        $nombre = $request->input('nombre');
        $cultos = Culto::where('nombre', 'LIKE', "%{$nombre}%")->get();
        return view('hermanos.consultarCultos', compact('cultos'));
    }

    // Consultar cultos por nombre desde el panel de administrador
    public function consultarCultoNombreAdmin(Request $request)
    {
        $nombre = $request->input('nombre');
        $cultos = Culto::where('nombre', 'LIKE', "%{$nombre}%")->get();
        return view('administrador.GestionCultos.panelCultos', compact('cultos'));
    }
}
