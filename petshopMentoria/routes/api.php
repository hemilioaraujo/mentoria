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
Route::get('/animais', [AnimalController::class, 'listarAnimais']);
Route::get('/animais/racas', [AnimalController::class, 'racas']);
Route::get('/animais/{id}', [AnimalController::class, 'exibirAnimal']);
Route::post('/animais', [AnimalController::class, 'registrarAnimal']);
Route::put('/animais/{id}', [AnimalController::class, 'alterarAnimal']);
Route::patch('/animais/{id}', [AnimalController::class, 'corrigirAnimal']);
Route::delete('/animais/{id}', [AnimalController::class, 'removerAnimal']);

/**
 * Rotas para Tutores
 */
Route::get('/tutores', [TutorController::class, 'listarTutores'])->name('tutores.listar');
Route::get('/tutores/{id}', [TutorController::class, 'exibirTutor'])->name('tutores.exibir');
Route::get('/tutores/{id}/animais', [TutorController::class, 'listarAnimaisDoTutor']);
Route::get('/tutores/{id}/animais/{id_animal}', [TutorController::class, 'listarAnimaisDoTutorPorId']);
Route::post('/tutores', [TutorController::class, 'registrarTutor'])->name('tutores.registrar');
Route::put('/tutores/{id}', [TutorController::class, 'alterarTutor'])->name('tutores.alterar');
Route::patch('/tutores/{id}', [TutorController::class, 'corrigirTutor'])->name('tutores.corrigir');
Route::delete('/tutores/{id}', [TutorController::class, 'removerTutor'])->name('tutores.remover');

/**
 * Rotas para Serviços
 */
Route::get('/servicos', [ServicoController::class, 'listarServicos']);
Route::get('/servicos/{id}', [ServicoController::class, 'exibirServico']);
Route::post('/servicos', [ServicoController::class, 'registrarServico']);
Route::put('/servicos/{id}', [ServicoController::class, 'alterarServico']);
Route::patch('/servicos/{id}', [ServicoController::class, 'corrigirServico']);
Route::delete('/servicos/{id}', [ServicoController::class, 'removerServico']);

/**
 * Rotas para Funcionários
 */
Route::get('/funcionarios', [FuncionarioController::class, 'listarFuncionarios']);
Route::get('/funcionarios/{id}', [FuncionarioController::class, 'exibirFuncionario']);
Route::get('/funcionarios/{id}/agendamentos', [AgendamentoController::class, 'listarAgendamentosPorFuncionario']);
Route::post('/funcionarios', [FuncionarioController::class, 'registrarFuncionario']);
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'alterarFuncionario']);
Route::patch('/funcionarios/{id}', [FuncionarioController::class, 'corrigirFuncionario']);
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'removerFuncionario']);

/**
 * Rotas para Funcionários-Serviços
 */
Route::get('/funcionarios-servicos', [FuncionarioServicoController::class, 'listarFuncionarioServicos']);
Route::get('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'exibirFuncionarioServico']);
Route::post('/funcionarios-servicos', [FuncionarioServicoController::class, 'registrarFuncionarioServico']);
Route::put('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'alterarFuncionarioServico']);
Route::patch('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'corrigirFuncionarioServico']);
Route::delete('/funcionarios-servicos/{id}', [FuncionarioServicoController::class, 'removerFuncionarioServico']);

/**
 * Rotas para Agendamentos
 */
Route::get('/agendamentos', [AgendamentoController::class, 'listarAgendamentos']);
Route::get('/agendamentos/{id}', [AgendamentoController::class, 'exibirAgendamento']);
Route::post('/agendamentos', [AgendamentoController::class, 'registrarAgendamento']);
Route::put('/agendamentos/{id}', [AgendamentoController::class, 'alterarAgendamento']);
// Route::patch('/agendamentos/{id}', [AgendamentoController::class, 'corrigirAgendamento']);
Route::delete('/agendamentos/{id}', [AgendamentoController::class, 'removerAgendamento']);

/**
 * Rota de Fallback
 */
Route::fallback(function () {
    return Response(['message' => 'Endpoint não encontrado.'], StatusCodeInterface::STATUS_NOT_FOUND);
});
