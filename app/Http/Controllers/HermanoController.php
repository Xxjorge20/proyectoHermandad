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
    public function accesoHermanos()
    {
        return view('hermanos.accesoHermanos');
    }

    public function registroHermanos()
    {
        return view('hermanos.registroHermanos');
    }

    public function olvidoContrasena()
    {
        return view('hermanos.recuperarContrasena');
    }

    // pagina Hermanos
    public function paginaHermanos()
    {
        // Obtengo el hermano autenticado
        $hermano = Auth::user();
        // Obtener los cultos mas cercanos a la fecha actual
        $cultos = Culto::All()->where('fecha', '>=', date('Y-m-d'))->sortBy('fecha');
        // Obtener el patrimonio de la hermandad mas cercano a la fecha actual
        $patrimonios = Patrimonio::where('fecha_adquisicion', '>=', date('Y-m-d'))->orderBy('fecha_adquisicion', 'asc')->get();
        return view('hermanos.paginaHermanos', compact('hermano', 'cultos', 'patrimonios'));
    }

    // Consultar Cultos
    public function consultarCultos()
    {

        $cultos = Culto::all();
        return view('hermanos.consultarCultos', compact('cultos'));
    }




    // Consultar Patrimonio
    public function consultarPatrimonio()
    {
        $patrimonio = Patrimonio::all();
        return view('hermanos.consultarPatrimonio', compact('patrimonio'));
    }


    // Panel Cuotas
    public function panelCuotas()
    {
        // Obtengo todas las cuotas del hermano logeado y las muestro
        $cuotas = Auth::user()->cuotas;
        return view('administrador.GestionCuotas.panelCuotas', compact('cuotas'));
    }




    // Panel HermanoMayor
    public function panelHermanoMayor()
    {
        return view('administrador.hermanoMayor');
    }

    // Panel Hermanos
    public function panelHermanos()
    {
        // Obtenemos todos los hermanos -> Futuros
        $hermanos = Hermano::all();
        return view('administrador.GestionHermano.panelHermano', compact('hermanos'));
    }

    // Crear Hermano
    public function crearHermano()
    {
        $cargos = Cargo::all();
        return view('administrador.GestionHermano.anadirHermano', compact('cargos'));
    }

    // Modificar Hermano
    public function modificarHermano($id)
    {
        $hermano = Hermano::find($id);
        $cargos = Cargo::all();
        return view('administrador.GestionHermano.modificarHermano', compact('hermano', 'cargos'));
    }

    // Update Hermano
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

    // Destroy Hermano
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


    // Store Hermano
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

    // Store Hermano Admin
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


    public function login(Request $request)
    {

        $credenciales = $request->only('email', 'password');
        $email = $request->input('email');

        if (Auth::attempt($credenciales)) {
            $hermano = Auth::user();
            // Obtengo el id del cargo del hermano
            $cargo = $hermano->cargo;

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
                    return redirect()->route('administrador.GestionCuotas.panelCuotas');
                    break;
                    case 'Diputado de Cultos':
                    return redirect()->route('administrador.GestionCultos.panelCultos');
                default:
                    return redirect()->route('hermanos.paginaHermanos', compact('hermano'));
                    break;
            }
        }

        return redirect()->back()->with('error', 'Credenciales incorrectas' . $email)->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('hermanos.accesoHermanos');
    }


    // Buscar por DNI
    public function buscarHermano(Request $request)
    {
        $dniBuscar = $request->input('dniBuscar');

        // Realiza la búsqueda por DNI
        $hermanos = Hermano::where('dni', 'LIKE', "%{$dniBuscar}%")->get();

        return view('administrador.GestionHermano.panelHermano', compact('hermanos'));
    }

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

    // Consultar Hermano por Nombre
    public function consultarHermanoNombre(Request $request)
    {

        // Realiza la búsqueda por nombre
        $hermanos = Hermano::where('nombre', 'LIKE', "%{$request->nombre}%")->get();

        return view('administrador.GestionHermano.panelHermano', compact('hermanos'));
    }

    // Consultar Hermano por DNI
    public function consultarHermanoDNI(Request $request)
    {

        // Realiza la búsqueda por DNI
        $hermanos = Hermano::where('dni', 'LIKE', "%{$request->dni}%")->get();

        return view('administrador.GestionHermano.panelHermano', compact('hermanos'));
    }

    // Consultar Hermanos por Cargo
    public function consultarJuntaGobierno()
    {
        // Devuelvo todos los hermanos con un cargo distinto a cargo_id = 2 (Hermano)
        $hermanos = Hermano::where('cargo_id', '!=', 2)->get();
        return view('hermanos.consultarJunta', compact('hermanos'));

    }

}
