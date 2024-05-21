<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hermano;
use App\Models\Culto;
use App\Models\Patrimonio;
use App\Models\Cuota;
use App\Models\Cargo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;



class HermanoController extends Controller
{
    /**
     * Método que devuelve la vista para el acceso de los hermanos.
     *
     * @return \Illuminate\View\View
     */
    public function accesoHermanos()
    {
        return view('hermanos.accesoHermanos');
    }

    /**
     * Método que devuelve la vista de registro de hermanos.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registroHermanos()
    {
        return view('hermanos.registroHermanos');
    }

    /**
     * Método que muestra la vista para recuperar la contraseña.
     *
     * @return \Illuminate\View\View
     */
    public function olvidoContrasena()
    {
        return view('hermanos.recuperarContrasena');
    }

    /**
     * Método para mostrar la página de los hermanos.
     *
     * Este método obtiene el hermano autenticado, los cultos más cercanos a la fecha actual
     * y los patrimonios más recientes. Luego, devuelve la vista 'hermanos.paginaHermanos'
     * con los datos obtenidos.
     *
     * @return \Illuminate\View\View
     */
    public function paginaHermanos()
    {
        // Obtengo el hermano autenticado
        $hermano = Auth::user();

        // Obtengo los cultos más cercanos a la fecha actual
        $cultos = Culto::orderBy('fecha', 'desc')->limit(5)->get();

        // Obtengo los patrimonios más recientes
        $patrimonios = Patrimonio::orderBy('fecha_adquisicion', 'desc')->limit(5)->get();

        return view('hermanos.paginaHermanos', compact('hermano', 'cultos', 'patrimonios'));
    }

    /**
     * Consultar Cultos
     *
     * Método que consulta los cultos y los muestra en la vista 'hermanos.consultarCultos'.
     * Los cultos se muestran paginados, con 5 cultos por página.
     *
     * @return \Illuminate\View\View
     */
    public function consultarCultos()
    {
        $cultos = Culto::paginate(5); // Paginar los cultos, mostrando 5 por página
        return view('hermanos.consultarCultos', compact('cultos'));
    }

    /**
     * Consulta el patrimonio.
     *
     * Esta función se encarga de consultar el patrimonio y paginar los resultados, mostrando 5 patrimonios por página.
     *
     * @return \Illuminate\View\View
     */
    public function consultarPatrimonio()
    {
        $patrimonio = Patrimonio::paginate(5); // Paginar los patrimonios, mostrando 5 por página

        return view('hermanos.consultarPatrimonio', compact('patrimonio'));
    }

    /**
     * Método para mostrar el panel de cuotas.
     *
     * Este método obtiene todas las cuotas del hermano logeado y las muestra en el panel de cuotas.
     *
     * @return \Illuminate\View\View
     */
    public function panelCuotas()
    {
        // Obtengo todas las cuotas del hermano logeado y las muestro
        $cuotas = Auth::user()->cuotas->paginate(5);
        return view('administrador.GestionCuotas.panelCuotas', compact('cuotas'));
    }


    /**
     * Panel del Hermano Mayor.
     *
     * Este método devuelve la vista del panel del Hermano Mayor.
     *
     * @return \Illuminate\View\View
     */
    public function panelHermanoMayor()
    {
        return view('administrador.hermanoMayor');
    }

    /**
     * Muestra el panel de hermanos.
     *
     * Esta función se encarga de obtener todos los hermanos y mostrarlos en el panel de hermanos.
     * Los hermanos se obtienen mediante la paginación de 5 elementos por página.
     *
     * @return \Illuminate\View\View
     */
    public function panelHermanos()
    {
        // Obtenemos todos los hermanos -> Futuros
        $hermanos = Hermano::paginate(5);

        return view('administrador.GestionHermano.panelHermano', compact('hermanos'));
    }

    /**
     * Crea un nuevo hermano.
     *
     * Esta función se encarga de crear un nuevo hermano y mostrar el formulario para añadirlo.
     *
     * @return \Illuminate\View\View
     */
    public function crearHermano()
    {
        $cargos = Cargo::all();

        return view('administrador.GestionHermano.anadirHermano', compact('cargos'));
    }

    /**
     * Modificar Hermano
     *
     * Método que se encarga de mostrar la vista para modificar un hermano.
     *
     * @param int $id El ID del hermano a modificar.
     * @return \Illuminate\View\View La vista para modificar un hermano.
     */
    public function modificarHermano($id)
    {
        // Buscamos el hermano por su id
        $hermano = Hermano::find($id);
        // Obtenemos todos los cargos
        $cargos = Cargo::all();
        return view('administrador.GestionHermano.modificarHermano', compact('hermano', 'cargos'));
    }

    /**
     * Actualiza un hermano.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscamos el hermano por su id
            $hermano = Hermano::find($id);
            // Actualizamos el hermano
            $hermano->update($request->all());
            // Redirigimos con un mensaje de éxito
            return redirect()->route('administrador.GestionHermano.panelHermano')->with('success', 'Hermano actualizado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigimos con un mensaje de error
            return redirect()->route('administrador.GestionHermano.panelHermano')->with('error', 'Error al actualizar hermano: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Elimina un hermano de la base de datos.
     *
     * @param  int  $id  El ID del hermano a eliminar.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Buscamos el hermano por su id
            $hermano = Hermano::find($id);
            // Eliminamos el hermano
            $hermano->delete();

            // Redirigimos con un mensaje de éxito
            return redirect()->route('administrador.GestionHermano.panelHermano')->with('success', 'Hermano eliminado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigimos con un mensaje de error
            return redirect()->route('administrador.GestionHermano.panelHermano')->with('error', 'Error al eliminar hermano: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Almacena un nuevo hermano.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Intenta crear un nuevo hermano
            Hermano::create($request->all());
            // Si se crea exitosamente, redirige con un mensaje de éxito
            return redirect()->route('hermanos.accesoHermanos')->with('success', 'Hermano creado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error
            return redirect()->route('hermanos.accesoHermanos')->with('error', 'Error al crear hermano: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Almacena un nuevo hermano en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AdminStore(Request $request)
    {
        try {
            // Intenta crear un nuevo hermano
            $id_cargo = $request->cargo;
            Hermano::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'dni' => $request->dni,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'fecha_bautismal' => $request->fecha_bautismal,
                'fecha_alta' => now(),
                'cargo_id' => $id_cargo
            ]);
            return redirect()->route('administrador.GestionHermano.panelHermano')->with('success', 'Hermano creado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error
            return redirect()->route('administrador.GestionHermano.panelHermano')->with('error', 'Error al crear hermano: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Función para realizar el inicio de sesión de un hermano.
     *
     * @param Request $request La solicitud HTTP recibida.
     * @return \Illuminate\Http\RedirectResponse La respuesta HTTP redirigida.
     */
    public function login(Request $request)
    {
        // Validación de los campos email y password
        $credenciales = $request->only('email', 'password');
        $email = $request->input('email');
        if (Auth::attempt($credenciales)) {
            $hermano = Auth::user();
            // Obtengo el id del cargo del hermano
            $cargo = $hermano->cargo;
            // Obtengo los cultos y patrimonios más recientes
            $cultos = Culto::limit(5)->get();
            $patrimonios = Patrimonio::limit(5)->get();
            // Switch para redirigir al panel correspondiente
            switch ($cargo->nombre) {
                case 'Hermano':
                    return redirect()->route('hermanos.paginaHermanos', compact('hermano'));
                    break;
                case 'Hermano Mayor':
                    return redirect()->route('administrador.hermanoMayor');
                    break;
                case 'Secretario':
                    return redirect()->route('administrador.GestionHermano.panelHermano');
                    break;
                case 'Tesorero':
                    return redirect()->route('administrador.gestionCuotas.panelCuotas');
                    break;
                case 'Diputado de Cultos':
                    return redirect()->route('administrador.GestionCultos.panelCultos');
                    break;
                case 'Prioste':
                    return redirect()->route('administrador.GestionPatrimonio.panelPatrimonio');
                    break;
                default:
                    return redirect()->route('hermanos.paginaHermanos', ['hermano' => $hermano, 'cultos' => $cultos, 'patrimonios' => $patrimonios]);
                break;
            }
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas' . $email)->withInput($request->only('email'));
    }

    /**
     * Cierra la sesión del usuario actual.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Cerrar sesión
        Auth::logout();
        return redirect()->route('hermanos.accesoHermanos');
    }

    /**
     * Busca un hermano por su DNI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function buscarHermano(Request $request)
    {
        $dniBuscar = $request->input('dniBuscar');

        // Realiza la búsqueda por DNI
        $hermanos = Hermano::where('dni', 'LIKE', "%{$dniBuscar}%")->get();

        return view('administrador.GestionHermano.panelHermano', compact('hermanos'));
    }



    /**
     * Consulta un hermano por nombre.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function consultarHermanoNombre(Request $request)
    {
        // Realiza la búsqueda por nombre
        $hermanos = Hermano::where('nombre', 'LIKE', "%{$request->nombre}%")->paginate(5);
        return view('administrador.GestionHermano.datosHermano', compact('hermanos'));
    }


    /**
     * Consulta un hermano por su DNI.
     *
     * Realiza una búsqueda en la base de datos de hermanos por el número de DNI proporcionado.
     * Devuelve una vista que muestra los hermanos encontrados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function consultarHermanoDNI(Request $request)
    {
        $hermanos = Hermano::where('dni', 'LIKE', "%{$request->dni}%")->get();

        return view('administrador.GestionHermano.panelHermano', compact('hermanos'));
    }

    /**
     * Consulta los hermanos que ocupan un cargo en la junta de gobierno.
     *
     * @return \Illuminate\View\View
     */
    public function consultarJuntaGobierno()
    {
        // Devuelve todos los hermanos que tienen un cargo distinto a cargo_id = 2 (Hermano)
        $hermanos = Hermano::where('cargo_id', '!=', 2)->paginate(5);
        return view('hermanos.consultarJunta', compact('hermanos'));
    }

    /**
     * Método para redirigir al panel correspondiente según el cargo del hermano autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function menuHermano(Request $request)
    {
        // Obtengo el cargo del hermano autenticado
        $cargo = $request->user()->cargo->nombre;

        // Switch para redirigir al panel correspondiente
        switch ($cargo) {
            case 'Hermano Mayor':
                return redirect()->route('administrador.hermanoMayor');
            case 'Secretario':
                return redirect()->route('administrador.GestionHermano.panelHermano');
            case 'Tesorero':
                return redirect()->route('administrador.gestionCuotas.panelCuotas');
            case 'Diputado de Cultos':
                return redirect()->route('administrador.GestionCultos.panelCultos');
            default:
                // Si el cargo no coincide con ninguno de los anteriores, redireccionar a una página predeterminada
                return redirect()->route('hermanos.paginaHermanos');
        }
    }

    /*
        Recuperar Contraseña
        public function recuperarContrasena(Request $request)
        {
            $this->validate($request, ['email' => 'required|email']);

            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

            return $response == Password::RESET_LINK_SENT
                ? redirect()->route('hermanos.accesoHermanos')->with('status', trans($response))
                : redirect()->route('hermanos.recuperarContrasena')->with('error', trans($response));
        }

        protected function broker()
        {
            return Password::broker('users');
        }



    */



}
