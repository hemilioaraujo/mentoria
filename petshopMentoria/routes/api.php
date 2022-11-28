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

Route::name("animais.")->prefix('/animais')->group(function () {
    Route::get('/', [AnimalController::class, 'listarAnimais'])->name('listar');
    Route::get('/racas', [AnimalController::class, 'racas'])->name('racas');
    Route::get('/{id}', [AnimalController::class, 'exibirAnimal'])->name('exibir');
    Route::post('/', [AnimalController::class, 'registrarAnimal'])->name('registrar');
    Route::put('/{id}', [AnimalController::class, 'alterarAnimal'])->name('alterar');
    Route::patch('/{id}', [AnimalController::class, 'corrigirAnimal'])->name('corrigir');
    Route::delete('/{id}', [AnimalController::class, 'removerAnimal'])->name('remover');
});

Route::name("tutores.")->prefix('/tutores')->group(function () {
    Route::get('/', [TutorController::class, 'listarTutores'])->name('listar');
    Route::get('/{id}', [TutorController::class, 'exibirTutor'])->name('exibir');
    Route::get('/{id}/animais', [TutorController::class, 'listarAnimaisDoTutor']);
    Route::get('/{id}/animais/{id_animal}', [TutorController::class, 'listarAnimaisDoTutorPorId']);
    Route::post('/', [TutorController::class, 'registrarTutor'])->name('registrar');
    Route::put('/{id}', [TutorController::class, 'alterarTutor'])->name('alterar');
    Route::patch('/{id}', [TutorController::class, 'corrigirTutor'])->name('corrigir');
    Route::delete('/{id}', [TutorController::class, 'removerTutor'])->name('remover');
});

Route::name("servicos.")->prefix('/servicos')->group(function () {
    Route::get('/servicos', [ServicoController::class, 'listarServicos'])->name('listar');
    Route::get('/servicos/{id}', [ServicoController::class, 'exibirServico'])->name('exibir');
    Route::post('/servicos', [ServicoController::class, 'registrarServico'])->name('registrar');
    Route::put('/servicos/{id}', [ServicoController::class, 'alterarServico'])->name('alterar');
    Route::patch('/servicos/{id}', [ServicoController::class, 'corrigirServico'])->name('corrigir');
    Route::delete('/servicos/{id}', [ServicoController::class, 'removerServico'])->name('remover');
});

Route::name("funcionarios.")->prefix('/funcionarios')->group(function () {
    Route::get('/', [FuncionarioController::class, 'listarFuncionarios'])->name('listar');
    Route::get('/{id}', [FuncionarioController::class, 'exibirFuncionario'])->name('exibir');
    Route::get('/funcionarios/{id}/agendamentos', [AgendamentoController::class, 'listarAgendamentosPorFuncionario'])->name('agendamentos');
    Route::post('/', [FuncionarioController::class, 'registrarFuncionario'])->name('registrar');
    Route::put('/{id}', [FuncionarioController::class, 'alterarFuncionario'])->name('alterar');
    Route::patch('/{id}', [FuncionarioController::class, 'corrigirFuncionario'])->name('corrigir');
    Route::delete('/{id}', [FuncionarioController::class, 'removerFuncionario'])->name('remover');
});

Route::name("funcionarios-servicos.")->prefix('/funcionarios-servicos')->group(function () {
    Route::get('/', [FuncionarioServicoController::class, 'listarFuncionarioServicos'])->name('listar');
    Route::get('/{id}', [FuncionarioServicoController::class, 'exibirFuncionarioServico'])->name('exibir');
    Route::post('/', [FuncionarioServicoController::class, 'registrarFuncionarioServico'])->name('registrar');
    Route::put('/{id}', [FuncionarioServicoController::class, 'alterarFuncionarioServico'])->name('alterar');
    Route::patch('/{id}', [FuncionarioServicoController::class, 'corrigirFuncionarioServico'])->name('corrigir');
    Route::delete('/{id}', [FuncionarioServicoController::class, 'removerFuncionarioServico'])->name('remover');
});

Route::name("agendamentos.")->prefix('/agendamentos')->group(function () {
    Route::get('/', [AgendamentoController::class, 'listarAgendamentos'])->name('listar');
    Route::get('/{id}', [AgendamentoController::class, 'exibirAgendamento'])->name('exibir');
    Route::post('/', [AgendamentoController::class, 'registrarAgendamento'])->name('registrar');
    Route::put('/{id}', [AgendamentoController::class, 'alterarAgendamento'])->name('alterar');
    // Route::patch('/{id}', [AgendamentoController::class, 'corrigirAgendamento'])->name('corrigir');
    Route::delete('/{id}', [AgendamentoController::class, 'removerAgendamento'])->name('remover');
});

Route::fallback(function () {
    return Response(['message' => 'Endpoint não encontrado.'], StatusCodeInterface::STATUS_NOT_FOUND);
});
