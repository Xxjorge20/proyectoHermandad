<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patrimonio;
use Illuminate\Support\Facades\Auth;

class PatrimonioController extends Controller
{

    /**
     * Método para mostrar el panel de patrimonio.
     *
     * Este método se encarga de obtener los patrimonios de la base de datos y mostrarlos en el panel de patrimonio.
     * Los patrimonios se muestran paginados de 5 en 5.
     *
     * @return \Illuminate\View\View
     */
    public function panelPatrimonio(){
        $patrimonios = Patrimonio::paginate(5);
        return view('administrador.GestionPatrimonio.panelPatrimonio', compact('patrimonios'));
    }

    /**
     * Crea un nuevo patrimonio.
     *
     * @return \Illuminate\View\View
     */
    public function crearPatrimonio(){
        return view('administrador.GestionPatrimonio.anadirPatrimonio');
    }


    /**
     *
     * Almacena un nuevo patrimonio en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $hermanoAutenticado = Auth::user();

            if ($hermanoAutenticado) {
                // Obtén la imagen del formulario

                $imagen = $request->file('imagen');


                // Genera un nombre único para la imagen
                $nombreImagen = $request->input('nombre') . '_' . $imagen->getClientOriginalName();

                // Guarda la imagen en la carpeta 'patrimonio' dentro del almacenamiento público
                $rutaImagen = $imagen->storeAs('patrimonios', $nombreImagen, 'public');

                // Si la imagen se guarda correctamente, guarda la ruta en la base de datos
                if ($rutaImagen) {
                    $datosPatrimonio = $request->except(['_token', 'imagen']);
                    $datosPatrimonio['imagen'] = $rutaImagen;

                    $patrimonio = Patrimonio::create($datosPatrimonio);
                    $patrimonio->hermanos()->attach($hermanoAutenticado->id, ['asignado_por' => $hermanoAutenticado->nombre]);

                    return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('success', 'Patrimonio creado exitosamente');
                } else {
                    return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('error', 'Error al guardar la imagen');
                }
            } else {
                return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('error', 'Error: No se pudo identificar al hermano autenticado');
            }
        } catch (\Exception $e) {
            return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio')->with('error', 'Error al crear el patrimonio: ' . $e->getMessage());
        }
    }

    /**
     * Modifica un patrimonio.
     *
     * @param int $id El ID del patrimonio a modificar.
     * @return \Illuminate\View\View La vista para modificar el patrimonio.
     */
    public function modificarPatrimonio($id){
        $patrimonio = Patrimonio::find($id);
        return view('administrador.GestionPatrimonio.modificarPatrimonio', compact('patrimonio'));
    }

    /**
     * Actualiza un patrimonio existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
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


    /**
     * Elimina un patrimonio.
     *
     * @param int $id El ID del patrimonio a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige a la página de gestión de patrimonio con un mensaje de éxito o error.
     */
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

    /**
     * Consulta el patrimonio por nombre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function consultarPatrimonioNombre(Request $request){
        $patrimonios = Patrimonio::where('nombre', 'like', '%' . $request->nombre . '%')->paginate(5);
        return view('hermanos.consultarPatrimonio', compact('patrimonios'));
    }

    /**
     * Consulta el patrimonio por nombre en el panel de administrador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function consultarPatrimonioNombreAdmin(Request $request){
        $patrimonios = Patrimonio::where('nombre', 'like', '%' . $request->nombre . '%')->paginate(5);
        return view('administrador.GestionPatrimonio.datosPatrimonio', compact('patrimonios'));
    }

    /**
     * Consulta el patrimonio.
     *
     * Esta función se encarga de consultar el patrimonio y mostrarlo en la vista 'hermanos.consultarPatrimonio'.
     * Utiliza la clase Patrimonio para obtener los datos del patrimonio y los paginamos en grupos de 5 elementos.
     *
     * @return \Illuminate\View\View
     */
    public function consultarPatrimonio(){
        $patrimonios = Patrimonio::paginate(5);
        return view('hermanos.consultarPatrimonio', compact('patrimonios'));
    }


    /*
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
    */
}
