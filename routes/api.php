<?php

use App\Http\Controllers\Api\AnalisisController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmergenciaController;
use App\Http\Controllers\Api\HistoriaController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ReconocimientoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AuthController
Route::post('login', [AuthController::class, 'login']);

//UserController
Route::get('/personal_med', [UserController::class, 'getPersonalMed']);
Route::get('/pacientes', [UserController::class, 'getPacientes']);
Route::get('/user/{id}', [UserController::class, 'getUserById']);
Route::post('/create_user', [UserController::class, 'createUser']);
Route::put('/update_user/{id}', [UserController::class, 'updateUser']);
Route::delete('/delete_user/{id}', [UserController::class, 'deleteUser']);
Route::post('/identify_user/{id}', [UserController::class, 'identifyUser']);

//EmergenciaController
Route::get('/emergencias', [EmergenciaController::class, 'getEmergencias']);
Route::get('/emergencia/{id}', [EmergenciaController::class, 'getEmergenciaById']);
Route::post('/create_emergencia', [EmergenciaController::class, 'createEmergencia']);
Route::put('/update_emergencia/{id}', [EmergenciaController::class, 'updateEmergencia']);
Route::delete('/delete_emergencia/{id}', [EmergenciaController::class, 'deleteEmergencia']);

//AnalisisController
Route::get('/analisis/emergencia/{id}', [AnalisisController::class, 'getAnalisisByEmergencia']);
Route::post('/create_analisis', [AnalisisController::class, 'createAnalisis']);
Route::delete('/delete_analisis', [AnalisisController::class, 'deleteAnalisis']);


//HistoriaMedicaController
Route::get('/historia/user/{id}', [HistoriaController::class, 'getHistoriaByPaciente']);
Route::post('/create_historia', [HistoriaController::class, 'createHistoria']);
Route::put('/update_historia', [HistoriaController::class, 'updateHistoria']);
Route::delete('/delete_historia/{id}', [HistoriaController::class, 'deleteHistoria']);


// ReconocimientoController

Route::post('/reconocimiento', [ReconocimientoController::class, 'reconocer']);
Route::post('/entrenamiento', [ReconocimientoController::class, 'entrenamiento']);