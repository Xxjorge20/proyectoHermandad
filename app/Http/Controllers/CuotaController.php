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
use PDF;


class CuotaController extends Controller
{






     // Panel cuotas
     public function panelCuotas()
     {
        $cuotas = Cuota::all();
        return view('administrador.gestionCuotas.panelCuotas', compact('cuotas'));
     }

     // Crear cuota
     public function crearCuota()
     {
         return view('administrador.gestionCuotas.anadirCuota');
     }

     // Store cuota
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

    // Consultar cuotas
    public function consultarCuotas()
    {
        // Devuelvo todas las cuotas del hermano autenticado
        $cuotas = Auth::user()->cuotas;

        return view('hermanos.consultarCuotas', compact('cuotas'));
    }

    // Mostrar Cuota
    public function mostrarCuota($cuotaId)
    {
        // Lógica para obtener la cuota y mostrarla en la vista
        $cuota = Cuota::findOrFail($cuotaId);

        return view('hermanos.mostrarCuota', compact('cuota'));
    }


    public function pagarCuota($cuotaId)
    {
        // Lógica para obtener la cuota y procesar el pago
        $cuota = Cuota::findOrFail($cuotaId);

        // Configuración del contexto de la API de PayPal
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
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
                            'currency' => 'USD', // Puedes ajustar la moneda según tus necesidades
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
                config('services.paypal.client_id'),
                config('services.paypal.secret')
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
        // Obtén el ID de la cuota desde la descripción del pago
        $descripcionPago = $result->transactions[0]->description;
        if (empty($descripcionPago)) {
            return null;
        }
        preg_match('/Pago de cuota ID: (\d+)/', $descripcionPago, $matches);


        // Devuelve el ID de la cuota si se encuentra, de lo contrario, devuelve null
        return isset($matches[1]) ? $matches[1] : null;
    }


    public function crearCuotaAutomatica()
    {
        // Obtengo todos los hermanos
        $hermanos = Hermano::all();

        // Obtengo la fecha y hora actual
        $fecha = Carbon::now();

        // Fecha de vencimiento es la fecha actual + 1 hora
        $fecha_vencimiento = $fecha->copy()->addHour();

        foreach ($hermanos as $hermano) {
            // Creo una nueva cuota con la fecha actual y el id del hermano
            $cuota = Cuota::create([
                'nombre' => 'Cuota horaria',
                'descripcion' => 'Cuota horaria',
                'importe' => 10,
                'fecha_emision' => $fecha->toDateTimeString(),
                'fecha_vencimiento' => $fecha_vencimiento->toDateTimeString(),
                'pagada' => false,
            ]);

            // Asocio la cuota al hermano
            $cuota->hermanos()->attach($hermano->id, ['asignado_por' => 'Administrador']);
        }
    }



        // Crear Cuota Automatica
    /*
        public function crearCuotaAutomatica()
        {
            // Obtengo todos los hermanos
            $hermanos = Hermano::all();

            // Obtengo la fecha actual
            $fecha = Carbon::now();

            // Fecha de vencimiento es la fecha actual + 1 mes
            $fecha_vencimiento = $fecha->copy()->addMonth();

            // Recorro todos los hermanos
            foreach ($hermanos as $hermano) {
                // Creo una nueva cuota con la fecha actual y el id del hermano
                $cuota = Cuota::create([
                    'nombre' => 'Cuota mensual',
                    'descripcion' => 'Cuota mensual',
                    'importe' => 10,
                    'fecha_emision' => $fecha->toDateString(),
                    'fecha_vencimiento' => $fecha_vencimiento->toDateString(),
                    'pagada' => false,
                ]);

                // Asocio la cuota al hermano
                $cuota->hermanos()->attach($hermano->id, ['asignado_por' => 'Administrador']);
            }
        }
    */



    public function consultarCuotaDNI(Request $request)
    {
        // Obtengo todas las cuotas del hermano con el DNI proporcionado
        $cuotas = Hermano::where('dni', $request->dni)->first()->cuotas;

        return view('administrador.gestionCuotas.consultarCuotasDNI', compact('cuotas'));
    }



    public function imprimirRecibo($cuotaId)
    {
        $cuota = Cuota::findOrFail($cuotaId);
        // busco en la tabla pivote el hermano que tiene la cuota

        $hermano = DB::table('cuota_hermano')->where('cuota_id', $cuotaId)->first();

        // Obtengo el hermano asociado a la cuota
        $hermanoObtenido = Hermano::find($hermano->hermano_id);




        // Personalización del PDF
        $pdf = PDF::loadView('plantillas.plantillaReciboHermano', compact('cuota','hermanoObtenido'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(['dpi' => 150]);

        // Descargar el PDF
        return $pdf->download('recibo_hermano_' . $cuota->id . '.pdf');
    }

}
