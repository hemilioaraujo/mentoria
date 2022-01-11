<?php

use App\Http\Controllers\TesteController;
use App\Http\Controllers\web\AnimaisController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    echo "show";
});

Route::get('/animais',[AnimaisController::class,'listarAnimais'])->name('listarAnimais');
Route::post('/animais',[AnimaisController::class,'registrarAnimal'])->name('registrarAnimais');