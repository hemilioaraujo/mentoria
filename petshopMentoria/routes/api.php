<?php

use App\Http\Controllers\api\AnimalController;
use App\Http\Controllers\api\TutorController;
use App\Models\Animal;
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

Route::apiResource('/animais', AnimalController::class);

/**
 * [TODO:] 
 * Fazer rotas específicas de cada método
 */

 // http://127.0.0.1:8081/api/animal/

// {
// 	"nome":"Totó",
// 	"tipo":"cachorro",
// 	"raca":"fox",
// 	"idade":2,
// 	"tutor_id":4
// }

Route::apiResource('/tutores', TutorController::class);

Route::fallback(function () {
    return Response(['message'=>'Endpoint não encontrado.'], StatusCodeInterface::STATUS_NOT_FOUND);
});
