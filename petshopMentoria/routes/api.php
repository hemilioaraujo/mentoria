<?php

use App\Http\Controllers\api\AnimalController;
use App\Http\Controllers\api\FuncionarioController;
use App\Http\Controllers\api\ServicoController;
use App\Http\Controllers\api\FuncionarioServicoController;
use App\Http\Controllers\api\TutorController;
use App\Http\Controllers\api\AgendamentoController;
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
Route::get('/animais/{id}/tutores', [AnimalController::class, 'tutores']);
Route::post('/animais', [AnimalController::class, 'post']);
Route::put('/animais/{id}', [AnimalController::class, 'put']);
Route::patch('/animais/{id}', [AnimalController::class, 'patch']);
Route::delete('/animais/{id}', [AnimalController::class, 'delete']);

/**
 * Rotas para Tutores
 */
Route::get('/tutores', [TutorController::class, 'index']);
Route::get('/tutores/{id}', [TutorController::class, 'show']);
Route::get('/tutores/{id}/animais', [TutorController::class, 'animais']);
Route::get('/tutores/{id}/animais/{id_animal}', [TutorController::class, 'animaisId']);
Route::post('/tutores', [TutorController::class, 'post']);
Route::put('/tutores/{id}', [TutorController::class, 'put']);
Route::patch('/tutores/{id}', [TutorController::class, 'patch']);
Route::delete('/tutores/{id}', [TutorController::class, 'delete']);

/**
 * Rotas para Serviços
 */
Route::get('/servicos', [ServicoController::class, 'index']);
Route::get('/servicos/{id}', [ServicoController::class, 'show']);
Route::post('/servicos', [ServicoController::class, 'post']);
Route::put('/servicos/{id}', [ServicoController::class, 'put']);
Route::patch('/servicos/{id}', [ServicoController::class, 'patch']);
Route::delete('/servicos/{id}', [ServicoController::class, 'delete']);

/**
 * Rotas para Funcionários
 */
Route::get('/funcionarios', [FuncionarioController::class, 'index']);
Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show']);
Route::post('/funcionarios', [FuncionarioController::class, 'post']);
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'put']);
Route::patch('/funcionarios/{id}', [FuncionarioController::class, 'patch']);
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'delete']);

/**
 * Rotas para Funcionários-Serviços
 */
Route::get('/funcionarios-servicos', [FuncionarioServicoController::class, 'index']);
Route::get('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'show']);
Route::post('/funcionarios-servicos', [FuncionarioServicoController::class, 'post']);
Route::put('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'put']);
Route::patch('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'patch']);
Route::delete('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'delete']);

/**
 * Rotas para Agendamentos
 */
Route::get('/agendamentos', [AgendamentoController::class, 'index']);
Route::get('/agendamentos/{id}', [AgendamentoController::class, 'show']);
// Route::post('/agendamentos', [AgendamentoController::class, 'post']);
// Route::put('/agendamentos/{id}', [AgendamentoController::class, 'put']);
// Route::patch('/agendamentos/{id}', [AgendamentoController::class, 'patch']);
Route::delete('/agendamentos/{id}', [AgendamentoController::class, 'delete']);

/**
 * Rota de Fallback
 */
Route::fallback(function () {
    return Response(['message' => 'Endpoint não encontrado.'], StatusCodeInterface::STATUS_NOT_FOUND);
});
