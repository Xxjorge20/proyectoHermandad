<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Culto;

class CultoController extends Controller
{

    /**
     * Muestra el panel para gestionar los cultos.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function panelCultos(){

        // Obtenemos todos los cultos
        $cultos = Culto::paginate(5);

        return view('administrador.GestionCultos.panelCultos', compact('cultos'));
    }


    /**
     * Método para mostrar la vista de creación de un nuevo culto.
     *
     * @return \Illuminate\View\View
     */
    public function crearCulto(){
        return view('administrador.GestionCultos.anadirCultos');
    }

    /**
     * Almacena un nuevo culto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP que contiene los datos del culto a almacenar.
     * @return \Illuminate\Http\RedirectResponse  Una respuesta de redirección.
     */
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


    /**
     * Editar culto
     *
     * Este método se encarga de recuperar un culto específico por su ID y devuelve la vista para modificarlo.
     *
     * @param int $id El ID del culto que se va a modificar
     * @return \Illuminate\View\View La vista para modificar el culto
     */
    public function modificarCulto($id){
        $culto = Culto::find($id);
        return view('administrador.GestionCultos.modificarCultos', compact('culto'));
    }

    /**
     * Actualiza un culto.
     *
     * @param  \Illuminate\Http\Request  $request  La instancia del objeto Request que contiene los datos de la solicitud
     * @param  int  $id  El ID del culto que se va a actualizar
     * @return \Illuminate\Http\RedirectResponse  Una instancia de RedirectResponse que redirige a la página de administración de cultos
     */
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
            return redirect()->route('administrador.GestionCultos.panelCultos')->with('error', 'Error al actualizar el culto', $e->getMessage());
        }
    }

    /**
     * Elimina un culto.
     *
     * @param  int  $id  El ID del culto a eliminar.
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Consultar cultos por nombre desde el hermano.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function consultarCultoNombre(Request $request)
    {
        $nombre = $request->input('nombre');
        // Busca los cultos que coincidan con el nombre proporcionado
        $cultos = Culto::where('nombre', 'LIKE', "%{$nombre}%")->paginate(5);
        return view('hermanos.consultarCultos', compact('cultos'));
    }

    public function consultarCultoPorMes(Request $request)
    {
        $mes = $request->mes;

        // Almacena el mes seleccionado en una variable de sesión
        session(['mesSeleccionado' => $mes]);

        // Realiza la búsqueda de cultos por el mes seleccionado
        $cultos = Culto::whereMonth('fecha', $mes)->paginate(5);

        // Asegura que el mes se pase también a la vista para la paginación
        return view('hermanos.consultarCultos', compact('cultos', 'mes'));
    }




    /**
     * Consultar cultos por nombre desde el panel de administrador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function consultarCultoNombreAdmin(Request $request)
    {
        $nombre = $request->input('nombre');
        // Busca los cultos que coincidan con el nombre proporcionado
        $cultos = Culto::where('nombre', 'LIKE', "%{$nombre}%")->paginate(5);
        return view('administrador.GestionCultos.datosCultos', compact('cultos'));
    }

    public function consultarCultoPorMesAdmin(Request $request)
    {
        $mes = $request->mes;

        // Almacena el mes seleccionado en una variable de sesión
        session(['mesSeleccionado' => $mes]);

        // Realiza la búsqueda de cultos por el mes seleccionado
        $cultos = Culto::whereMonth('fecha', $mes)->paginate(5);

        // Asegura que el mes se pase también a la vista para la paginación
        return view('administrador.GestionCultos.panelCultos', compact('cultos', 'mes'));
    }
}
