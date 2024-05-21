<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hermano;
use App\Models\Cuota;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payer;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use PDF;
use File;



class CuotaController extends Controller
{


    /**
     * Método que muestra el panel de cuotas.
     *
     * Este método recupera los justificantes de pago y los hermanos registrados,
     * y los pasa como variables a la vista 'administrador.gestionCuotas.panelCuotas'.
     *
     * @return \Illuminate\View\View
     */
    public function panelCuotas()
    {
        $justificantes = collect(Storage::files('justificantes'));
        $hermanos = Hermano::all();
        return view('administrador.gestionCuotas.panelCuotas', compact('justificantes', 'hermanos'));
    }

    /**
     * Método para crear una nueva cuota.
     *
     * @return \Illuminate\View\View
     */
    public function crearCuota()
    {
        return view('administrador.gestionCuotas.anadirCuota');
    }

    /**
     * Almacena una nueva cuota.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $hermano = Hermano::find($request->hermano_id);
            $hermanoAutenticado = Auth::user();

            // Intenta crear una nueva cuota
            $cuota =  Cuota::create($request->all());

            // Asocia la cuota al hermano
            $cuota->hermanos()->attach([$request->id , 'asinado_por' => $hermanoAutenticado->nombre]);

            // Si se crea exitosamente, redirige con un mensaje de éxito
            return redirect()->route('cuota.index')->with('success', 'Cuota creada exitosamente');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con un mensaje de error
            return redirect()->route('cuota.index')->with('error', 'Error al crear la cuota');
        }
    }

    /**
     * Consulta las cuotas del hermano autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function consultarCuotas()
    {
        // Devuelvo todas las cuotas del hermano autenticado
        $user = Auth::user();
        $cuotas = $user->cuotas()->paginate(5);

        return view('hermanos.consultarCuotas', compact('cuotas'));
    }

    /**
     * Muestra la cuota especificada.
     *
     * @param  int  $cuotaId
     * @return \Illuminate\View\View
     */
    public function mostrarCuota($cuotaId)
    {
        // Lógica para obtener la cuota y mostrarla en la vista
        $cuota = Cuota::findOrFail($cuotaId);

        return view('hermanos.mostrarCuota', compact('cuota'));
    }

    /**
     * Actualiza el estado de una cuota a "pagada".
     *
     * @param int $cuotaId El ID de la cuota que se va a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la ruta panelCuotas con un mensaje de éxito.
     */

    public function actualizarCuotaPagada($cuotaId)
    {
        // Lógica para actualizar el estado de la cuota a pagada
        $cuota = Cuota::findOrFail($cuotaId);
        $cuota->update(['pagada' => true]);

        return redirect()->route('administrador.gestionCuotas.panelCuotas', $cuotaId)->with('success', 'Cuota pagada con éxito');
    }

    /**
     * Sube un justificante de pago para una cuota específica.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $cuotaId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subirJustificante(Request $request, $cuotaId)
    {
        // Validar el archivo subido
        $request->validate([
            'justificante' => 'required|file|max:10240', // Tamaño máximo de 10 MB
        ]);

        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Obtener el nombre del usuario y crear el nombre de la carpeta
        $nombreCarpeta =  $usuario->id;

        // Obtener el archivo subido
        $justificante = $request->file('justificante');

        // Obtener el nombre del archivo
        $nombreArchivo = "JustificantePago" . '_' . $usuario->nombre . $usuario->apellidos . '_' . $cuotaId . '.' . $justificante->getClientOriginalExtension();

        // Mover el archivo a la carpeta de almacenamiento del usuario
        $rutaArchivo = $justificante->storeAs($nombreCarpeta, $nombreArchivo, 'public');

        if ($rutaArchivo) {
            // URL del archivo
            $urlArchivo = Storage::url(str_replace('\\', '/', $rutaArchivo));
            if (Storage::disk('public')->exists($rutaArchivo)) {
                return redirect()->back()->with('success', 'Justificante subido correctamente.');
            } else {
                return redirect()->back()->with('error', 'El archivo no se movió correctamente.');
            }
        } else {
            return redirect()->back()->with('error', 'Error al subir el justificante.');
        }
    }


    /**
     * Crea una cuota automática para todos los hermanos.
     *
     * Esta función obtiene todos los hermanos y crea una nueva cuota para cada uno de ellos.
     * La cuota creada tiene un nombre, una descripción, un importe, una fecha de emisión y una fecha de vencimiento.
     * La fecha de vencimiento se calcula sumando 4 años a la fecha actual.
     * La cuota se marca como no pagada y se asocia al hermano correspondiente.
     *
     * @return void
     */

    public function crearCuotaAutomatica()
    {
        // Obtengo todos los hermanos
        $hermanos = Hermano::all();

        // Obtengo la fecha y hora actual
        $fecha = Carbon::now();

        // Fecha de vencimiento es la fecha actual + 4 años a partir de la fecha actual
        $fecha_vencimiento = $fecha->copy()->addYears(4);

        foreach ($hermanos as $hermano) {
            // Creo una nueva cuota con la fecha actual y el id del hermano
            $cuota = Cuota::create([
                'nombre' => 'Cuota Anual',
                'descripcion' => 'Cuota anual de hermano de la hermandad',
                'importe' => 7,
                'fecha_emision' => $fecha->toDateTimeString(),
                'fecha_vencimiento' => $fecha_vencimiento->toDateTimeString(),
                'pagada' => false,
            ]);

            // Asocio la cuota al hermano
            $cuota->hermanos()->attach($hermano->id, ['asignado_por' => 'Administrador']);
        }
    }


    public function crearPapeletaSitio(){
        // Obtengo todos los hermanos
        $hermanos = Hermano::all();

        // Obtengo la fecha y hora actual
        $fecha = Carbon::now();

        // Fecha de vencimiento es la fecha actual + 4 años a partir de la fecha actual
        $fecha_vencimiento = $fecha->copy()->addYears(4);

        foreach ($hermanos as $hermano) {
            // Creo una nueva cuota con la fecha actual y el id del hermano
            $cuota = Cuota::create([
                'nombre' => 'Papeleta de Sitio',
                'descripcion' => 'Papeleta de sitio para la estación de penitencia',
                'importe' => 10,
                'fecha_emision' => $fecha->toDateTimeString(),
                'fecha_vencimiento' => $fecha_vencimiento->toDateTimeString(),
                'pagada' => false,
            ]);

            // Asocio la cuota al hermano
            $cuota->hermanos()->attach($hermano->id, ['asignado_por' => 'Administrador']);
        }
    }

    /**
     * Consulta la cuota de un hermano por su DNI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function consultarCuotaDNI(Request $request)
    {
        try {
            $request->validate([
                'dni' => 'required|exists:hermanos,dni',
            ]);

            $dni = $request->input('dni');
            $hermanoSeleccionado = Hermano::where('dni', $dni)->firstOrFail();
            $justificantes = [];
            $hermanos = Hermano::all();

            // Obtener la ruta del directorio de justificantes para el hermano seleccionado
            $directorio = public_path("justificantes/{$hermanoSeleccionado->id}");

            // Verificar si el directorio existe
            if (File::isDirectory($directorio)) {
                // Obtener todos los archivos del directorio
                $files = File::files($directorio);

                // Iterar sobre los archivos y agregar la URL relativa para cada uno
                foreach ($files as $file) {
                    // Obtener la parte relativa de la URL dentro de la carpeta 'public'
                    $rutaArchivo = str_replace(public_path(), '', $file->getPathname());
                    // Reemplazar los caracteres de ruta de Windows con barras inclinadas
                    $rutaArchivo = str_replace('\\', '/', $rutaArchivo);
                    // Agregar la ruta al array de justificantes
                    $justificantes[] = url($rutaArchivo);
                }
            }

            $cuotas = Cuota::whereHas('hermanos', function ($query) use ($dni) {
                $query->where('dni', $dni);
            })->paginate(5);

            return view('administrador.gestionCuotas.panelCuotas', compact('cuotas', 'hermanoSeleccionado', 'justificantes', 'hermanos'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'No se ha encontrado ningún hermano con el DNI proporcionado.');
        }
    }

    /**
     * Consulta las cuotas por nombre de hermano.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function consultarCuotasPorNombre(Request $request)
    {
        try {
            $request->validate([
                'hermano' => 'required|exists:hermanos,id',
            ]);

            $hermanoId = $request->input('hermano');
            $hermanoSeleccionado = Hermano::findOrFail($hermanoId);
            $justificantes = [];
            $hermanos = Hermano::all();

            // Obtener la ruta del directorio de justificantes para el hermano seleccionado
            $directorio = public_path("justificantes/{$hermanoId}");

            // Verificar si el directorio existe
            if (File::isDirectory($directorio)) {
                // Obtener todos los archivos del directorio
                $files = File::files($directorio);

                // Iterar sobre los archivos y agregar la URL relativa para cada uno
                foreach ($files as $file) {
                    // Obtener la parte relativa de la URL dentro de la carpeta 'public'
                    $rutaArchivo = str_replace(public_path(), '', $file->getPathname());
                    // Reemplazar los caracteres de ruta de Windows con barras inclinadas
                    $rutaArchivo = str_replace('\\', '/', $rutaArchivo);
                    // Agregar la ruta al array de justificantes
                    $justificantes[] = url($rutaArchivo);
                }
            }

            $cuotas = Cuota::whereHas('hermanos', function ($query) use ($hermanoId) {
                $query->where('hermano_id', $hermanoId);
            })->paginate(5);

            return view('administrador.gestionCuotas.panelCuotas', compact('cuotas', 'hermanoSeleccionado', 'justificantes', 'hermanos'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'No se ha encontrado ningún hermano con el ID proporcionado.');
        }
    }

    /**
     * Método para imprimir un recibo de cuota.
     *
     * @param int $cuotaId El ID de la cuota.
     * @return \Illuminate\Http\Response La respuesta HTTP con el PDF del recibo para descargar.
     */
    public function imprimirRecibo($cuotaId)
    {
        $cuota = Cuota::findOrFail($cuotaId);

        // Buscar en la tabla pivote el hermano que tiene la cuota
        $hermano = DB::table('cuota_hermano')->where('cuota_id', $cuotaId)->first();

        // Obtener el hermano asociado a la cuota
        $hermanoObtenido = Hermano::find($hermano->hermano_id);

        // Vista blade a la que renderizar para generar el PDF
        $view = view('plantillas.plantillaReciboHermano', compact('cuota', 'hermanoObtenido'))->render();

        // Crear instancia de Dompdf
        $dompdf = new Dompdf();

        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml(ob_get_clean());

        // Cargar HTML en Dompdf
        $dompdf->loadHtml($view);

        // (Opcional) Configurar opciones de Dompdf, como tamaño de papel y orientación
        $dompdf->setPaper('A4', 'portrait');



        // Renderizar el PDF
        $dompdf->render();

        // Nombre del archivo PDF para descargar
        $filename = 'recibo_hermano_' . $cuota->id . '.pdf';

        // Devolver el PDF como una respuesta para descargar
        return $dompdf->stream($filename);
    }

    /*

           \\ PAYPAL //


        public function pagarCuota($cuotaId)
        {
            // Lógica para obtener la cuota y procesar el pago
            $cuota = Cuota::findOrFail($cuotaId);

            // Configuración del contexto de la API de PayPal
            $apiContext = new ApiContext(
                new OAuthTokenCredential(
                    config('ATrM06oJ54nD4tFoH3ombMYlBg2hHYf4RT3izVuKspDam3y6pU9VLpB8DoDwDARqaLhMZ3WquueCt_ZG'),
                    config('ECiyRo4rhzeqY3LnzyKIb0HbON6-CQSGQxo5WCpiPgGG3Hwoj0l2mK8iUougGIm7k7RVqm2bDDNAW8Hn')
                )
            );

            // Lógica para crear un pago de PayPal
            $payment = new Payment();
            // Configurar detalles del pago, como el total y la moneda
            $payment->setIntent('sale')
                    ->setPayer(new Payer(['payment_method' => 'paypal']))
                    ->setTransactions([
                        new Transaction([
                            'amount' => [
                                'total' => $cuota->importe,
                                'currency' => 'EUR', // Puedes ajustar la moneda según tus necesidades
                            ],
                            'description' => 'Pago de cuota ID: ' . $cuota->id, // Incluye el ID de la cuota en la descripción
                        ]),
                    ])
                    ->setRedirectUrls([
                        'return_url' => route('cuota.executePayment', $cuotaId),
                        'cancel_url' => route('cuota.cancelPayment', $cuotaId),
                    ]);

            // Crear el pago y obtener la URL de aprobación
            $approvalUrl = $payment->create($apiContext)->getApprovalLink();

            // Redirigir al usuario a la URL de aprobación de PayPal
            return redirect()->to($approvalUrl);
        }

        // En tu controlador CuotaController
        public function executePayment(Request $request)
        {
            // Lógica para ejecutar el pago de PayPal y actualizar el estado de la cuota
            $paymentId = $request->get('paymentId');
            $payerId = $request->get('PayerID');

            $apiContext = new ApiContext(
                new OAuthTokenCredential(
                    config('ATrM06oJ54nD4tFoH3ombMYlBg2hHYf4RT3izVuKspDam3y6pU9VLpB8DoDwDARqaLhMZ3WquueCt_ZG'),
                    config('ECiyRo4rhzeqY3LnzyKIb0HbON6-CQSGQxo5WCpiPgGG3Hwoj0l2mK8iUougGIm7k7RVqm2bDDNAW8Hn')
                )
            );

            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            try {
                // Ejecutar el pago
                $result = $payment->execute($execution, $apiContext);

                // Cambiar el estado de la cuota a pagada
                $cuota = Cuota::findOrFail($cuotaId);
                $cuota->update(['pagada' => true]);

                return redirect()->route('hermanos.consultarCuotas')->with('success', 'Pago ejecutado con éxito');
            } catch (PayPalConnectionException $e) {
                // Manejar errores de conexión con PayPal
                return redirect()->route('hermanos.consultarCuotas')->with('error', 'Error al ejecutar el pago: ' . $e->getMessage());
            }
        }

        // Cancelar el pago si el usuario decide cancelar
        public function cancelPayment(Request $request, $cuotaId)
        {
            // Lógica para manejar la cancelación del pago
            // ...

            return redirect()->route('hermanos.consultarCuotas');
        }



        private function obtenerIdCuotaDesdeResult($result)
        {
            try {
                preg_match('/Pago de cuota ID: (\d+)/', $descripcionPago, $matches);
                // Devuelve el ID de la cuota si se encuentra, de lo contrario, devuelve null
                return isset($matches[1]) ? $matches[1] : null;
            } catch (Exception $e) {
                // Manejar error de expresión regular
                return null;
            }
        }
    */

}
