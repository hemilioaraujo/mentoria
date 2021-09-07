<?php

use App\Http\Controllers\api\AnimalController;
use App\Http\Controllers\api\TutorController;
use App\Models\Animal;
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

Route::apiResource('/animais', AnimalController::class);
Route::apiResource('/tutores', TutorController::class);
