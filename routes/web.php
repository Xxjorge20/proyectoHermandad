<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HermanoController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\CultoController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\GraficosController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\CorreoController;
use App\Models\Hermano;
use App\Models\Cuota;
use App\Models\Culto;
use App\Models\Patrimonio;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas antes del login

// Página de inicio
Route::get('/', function () {
    return view('paginaInicio');
})->name('paginaInicio');

// Pagina historia hermandad
Route::get('historiaHermandad', function () {
    return view('historiaHermandad');
})->name('historiaHermandad'); // Mueve la llamada a name() al final de la definición de la ruta

Route::get('fototecaHermandad', function () {
    return view('fototecaHermandad');
})->name('fototecaHermandad');

Route::get('contactoHermandad', function () {
    return view('contactoHermandad');
})->name('contactoHermandad');

Route::post('/enviar-correo', [CorreoController::class, 'enviarCorreo'])->name('enviarCorreo');


Route::get('/hermanos/accesoHermanos',[HermanoController::class,'accesoHermanos'])->name('hermanos.accesoHermanos');
Route::post('/hermanos/login',[HermanoController::class,'login'])->name('hermanos.login');
Route::get('/hermanos/olvioContrasena',[HermanoController::class,'olvidoContrasena'])->name('hermanos.olvidoContrasena');
Route::get('/hermanos/cerrarSesion',[HermanoController::class,'logout'])->name('hermanos.cerrarSesion');

// Registro de hermanos
Route::get('/hermanos/registroHermanos',[HermanoController::class,'registroHermanos'])->name('hermanos.registroHermanos');
Route::post('/hermanos/store',[HermanoController::class,'store'])->name('hermano.store');

// Olvido contraseña
Route::get('/hermanos/olvidoContraseña',[HermanoController::class,'olvidoContrasena'])->name('hermanos.olvidoContraseña');
Route::get('/hermanos/enviarCorreo',[HermanoController::class,'recuperarContrasena'])->name('hermanos.recuperarContrasena');
Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');



// Rutas después del login - Hermanos
Route::get('/hermanos/paginaHermanos/{hermano?}{cultos?}{patrimonios?}', [HermanoController::class, 'paginaHermanos'])->name('hermanos.paginaHermanos');
// Consultar Cultos
Route::get('/hermanos/consultarCultos/{cultos?}',[HermanoController::class,'consultarCultos'])->name('hermanos.consultarCultos');
// Consultar Culto por nombre
Route::get('/hermanos/consultar-culto-nombre', [CultoController::class, 'consultarCultoNombre'])->name('consultarCultoNombre');
// Consultar Culto por mes
Route::get('/hermanos/consultar-culto-mes', [CultoController::class, 'consultarCultoPorMes'])->name('consultarCultoPorMes');

// Consultar Cultos por mes admin
Route::get('/administrador/GestionCultos/consultarCultoPorMesAdmin', [CultoController::class, 'consultarCultoPorMesAdmin'])->name('consultarCultoPorMesAdmin');

// Consultar Patrimonio
Route::get('/hermanos/consultarPatrimonio/{patrimonio?}',[PatrimonioController::class,'consultarPatrimonio'])->name('hermanos.consultarPatrimonio');
// Consultar Patrimonio por nombre
Route::get('/hermanos/consultar-patrimonio-nombre', [PatrimonioController::class, 'consultarPatrimonioNombre'])->name('consultarPatrimonioNombre');
// Consultar Junta de Gobierno
Route::get('/hermanos/consultarJunta/{hermanos?}',[HermanoController::class,'consultarJuntaGobierno'])->name('hermanos.consultarJunta');
// Consultar Cuotas
Route::get('/hermanos/consultarCuotas/{cuotas?}',[CuotaController::class,'consultarCuotas'])->name('hermanos.consultarCuotas');
// Mostrar Cuota
Route::get('/hermanos/mostrarCuota/{cuotaId}',[CuotaController::class,'mostrarCuota'])->name('hermanos.mostrar');
// Pagar Cuotas
Route::get('/hermanos/pagoCuotas/{cuotaId}', [CuotaController::class, 'pagarCuota'])->name('cuota.pagarCuotas');
Route::get('/hermanos/executePayment', [CuotaController::class, 'executePayment'])->name('cuota.executePayment');
Route::get('/hermanos/cancelPayment', [CuotaController::class, 'cancelPayment'])->name('cuota.cancelPayment');
Route::get('/hermanos/actualizarCuotaPagada/{cuotaId}', [CuotaController::class, 'actualizarCuotaPagada'])->name('cuota.actualizarCuotaPagada');
// Adjuntar justificante
Route::post('subir-justificante/{cuotaId}', [CuotaController::class, 'subirJustificante'])->name('subirJustificante');
// Menu del hermano
Route::get('/menu-hermano', [HermanoController::class, 'menuHermano'])->name('menu.hermano');

// Imprimir recibo
Route::get('/hermanos/imprimirRecibo/{cuotaId}', [CuotaController::class, 'imprimirRecibo'])->name('cuota.imprimirRecibo');


// Rutas después del login - Administrador - Cuotas
Route::get('/administrador/GestionCuotas/panelCuotas',[CuotaController::class,'panelCuotas'])->name('administrador.gestionCuotas.panelCuotas')->middleware('auth');
Route::get('/administrador/GestionCuotas/anadirCuota',[CuotaController::class,'crearCuota'])->name('administrador.gestionCuotas.anadirCuota')->middleware('auth');
Route::post('/administrador/GestionCuotas/store',[CuotaController::class,'store'])->name('administrador.cuotas.store')->middleware('auth');
Route::match(['get', 'post'], '/administrador/GestionCuotas/consultarCuotasDNI',[CuotaController::class,'consultarCuotaDNI'])->name('administrador.gestionCuotas.consultarCuotaDNI')->middleware('auth');
Route::match(['get', 'post'] ,'/administrador/GestionCuotas/consultarCuotasNombre', [CuotaController::class, 'consultarCuotasPorNombre'])
    ->name('administrador.gestionCuotas.consultarCuotasNombre')
    ->middleware('auth');



// Rutas después del login - Administrador - Cultos
Route::get('/administrador/GestionCultos/panelCultos',[CultoController::class,'panelCultos'])->name('administrador.GestionCultos.panelCultos')->middleware('auth');
Route::get('/administrador/GestionCultos/anadirCultos',[CultoController::class,'crearCulto'])->name('administrador.GestionCultos.crearCulto')->middleware('auth');
Route::post('/administrador/GestionCultos/store',[CultoController::class,'store'])->name('administrador.GestionCultos.store')->middleware('auth');
Route::get('/administrador/GestionCultos/modificarCultos/{id}',[CultoController::class,'modificarCulto'])->name('administrador.GestionCultos.editarCultos')->middleware('auth');
Route::put('/administrador/GestionCultos/update/{id}',[CultoController::class,'update'])->name('administrador.GestionCultos.update')->middleware('auth');
Route::delete('/administrador/GestionCultos/eliminarCulto/{id}', [CultoController::class, 'destroy'])->name('administrador.GestionCultos.eliminarCulto')->middleware('auth');
Route::get('/administrador/GestionCultos/consultarCultoNombreAdmin',[CultoController::class,'consultarCultoNombreAdmin'])->name('administrador.GestionCultos.consultarCultoNombreAdmin')->middleware('auth');


// Rutas después del login - Administrador - Patrimonio
Route::get('/administrador/GestionPatrimonio/panelPatrimonio',[PatrimonioController::class,'panelPatrimonio'])->name('administrador.GestionPatrimonio.panelPatrimonio')->middleware('auth');
Route::get('/administrador/GestionPatrimonio/anadirPatrimonio',[PatrimonioController::class,'crearPatrimonio'])->name('administrador.GestionPatrimonio.anadirPatrimonio')->middleware('auth');
Route::post('/administrador/GestionPatrimonio/store',[PatrimonioController::class,'store'])->name('administrador.patrimonio.store')->middleware('auth');
Route::get('/administrador/GestionPatrimonio/modificarPatrimonio/{id}',[PatrimonioController::class,'modificarPatrimonio'])->name('administrador.GestionPatrimonio.modificarPatrimonio')->middleware('auth');
Route::put('/administrador/GestionPatrimonio/update/{id}',[PatrimonioController::class,'update'])->name('administrador.GestionPatrimonio.update')->middleware('auth');
Route::delete('/administrador/GestionPatrimonio/eliminarPatrimonio/{id}',[PatrimonioController::class,'destroy'])->name('administrador.GestionPatrimonio.eliminarPatrimonio')->middleware('auth');
Route::get('/administrador/GestionPatrimonio/consultarPatrimonioNombreAdmin',[PatrimonioController::class,'consultarPatrimonioNombreAdmin'])->name('administrador.GestionPatrimonio.consultarPatrimonioNombreAdmin')->middleware('auth');

// Rutas después del login - Administrador - Hermanos
Route::get('/administrador/GestionHermano/panelHermanos',[HermanoController::class,'panelHermanos'])->name('administrador.GestionHermano.panelHermano')->middleware('auth');
Route::get('/administrador/GestionHermano/anadirHermano',[HermanoController::class,'crearHermano'])->name('administrador.GestionHermano.crearHermano')->middleware('auth');
Route::post('/administrador/GestionHermano/store',[HermanoController::class,'AdminStore'])->name('administrador.hermano.store')->middleware('auth');
Route::get('/administrador/GestionHermano/modificarHermano/{id}{cargos?}',[HermanoController::class,'modificarHermano'])->name('administrador.GestionHermano.modificarHermano')->middleware('auth');
Route::put('/administrador/GestionHermano/update/{id}',[HermanoController::class,'update'])->name('administrador.GestionHermano.update')->middleware('auth');
Route::delete('/administrador/GestionHermano/eliminarHermano/{id}',[HermanoController::class,'destroy'])->name('administrador.GestionHermano.eliminarHermano')->middleware('auth');
Route::get('/administrador/GestionHermano/consultarHermanoDNI',[HermanoController::class,'consultarHermanoDNI'])->name('administrador.GestionHermano.buscarHermano')->middleware('auth');
Route::get('/administrador/GestionHermano/consultarHermanoNombre',[HermanoController::class,'consultarHermanoNombre'])->name('administrador.GestionHermano.consultarHermanoNombre')->middleware('auth');


// Rutas después del login - Administrador - HermanoMayor
Route::get('/administrador/hermanoMayor',[HermanoController::class,'panelHermanoMayor'])->name('administrador.hermanoMayor')->middleware('auth');

/* Rutas para los gráficos */

Route::get('/grafico-hermanos-por-ano', [GraficosController::class,'graficoHermanosPorAno'])->name('grafico.hermanos.por.ano');
Route::get('/grafico-cultos-por-ano', [GraficosController::class,'graficoCultosPorAno'])->name('grafico.cultos.por.ano');

/* Ruta pago paypal */

Route::get('/hermanos/paywithpaypal/{cuotaId}', [PaypalController::class, 'payWithPaypal'])->name('hermanos.paywithpaypal');
Route::post('/hermanos/paypal', [PaypalController::class, 'postPaymentWithpaypal'])->name('hermanos.paypal');
Route::get('/hermanos/paypal', [PaypalController::class, 'getPaymentStatus'])->name('hermanos.status');
