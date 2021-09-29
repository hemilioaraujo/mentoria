<?php

use App\Http\Controllers\api\AnimalController;
use App\Http\Controllers\api\TutorController;
use App\Models\Animal;
use App\Models\Tutor;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

/**
 * Rotas para Animais
 */
Route::get('/animais', [AnimalController::class, 'index']);
Route::get('/animais/{id}', [AnimalController::class, 'show']);
Route::post('/animais', [AnimalController::class, 'post']);
Route::put('/animais/{id}', [AnimalController::class, 'put']);
Route::patch('/animais/{id}', [AnimalController::class, 'patch']);
Route::delete('/animais/{id}', [AnimalController::class, 'delete']);

/**
 * Rotas para Tutores
 */
Route::get('/tutores', [TutorController::class, 'index']);
Route::get('/tutores/{id}', [TutorController::class, 'show']);
Route::post('/tutores', [TutorController::class, 'post']);
Route::put('/tutores/{id}', [TutorController::class, 'put']);
Route::patch('/tutores/{id}', [TutorController::class, 'patch']);
Route::delete('/tutores/{id}', [TutorController::class, 'delete']);

/**
 * Rota de Fallback
 */
Route::fallback(function () {
    return Response(['message' => 'Endpoint não encontrado.'], StatusCodeInterface::STATUS_NOT_FOUND);
});
