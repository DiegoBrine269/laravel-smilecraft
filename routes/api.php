<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\TonoController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\DescripcionController;
use App\Http\Controllers\EstadisticasController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::apiResource('/pagos', PagoController::class);
    Route::get('/estadisticas', [EstadisticasController::class, 'index'] );
    Route::get('/estadisticas/{anio}', [EstadisticasController::class, 'anual'] );
    Route::apiResource('/trabajos', TrabajoController::class);
    Route::get('/trabajos/{trabajo}/pagos', [TrabajoController::class, 'pagos']);
    Route::get('/trabajos/deudas/{id_doctor}', [TrabajoController::class, 'deudas']);
    Route::apiResource('/descripciones', DescripcionController::class)->parameters([
        'descripciones' => 'descripcion'
    ]);
    
    Route::apiResource('/doctores', DoctorController::class)->parameters([
        'doctores' => 'doctor'
    ]);
});

Route::get('/tonos', [TonoController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
// Rutas no protegidas




// Route::post('register', [AuthController::class, 'register']);
