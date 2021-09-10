<?php

use App\Classes\HttpResponses;
use App\Http\Controllers\api\AnimalController;
use App\Http\Controllers\api\TutorController;
use App\Models\Animal;
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
Route::apiResource('/tutores', TutorController::class);
Route::fallback(function(){
    return Response(['message'=>'Endpoint não encontrado.'], HttpResponses::HTTP_NOT_FOUND);
});
