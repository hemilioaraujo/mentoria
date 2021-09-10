<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function index()
    {
        $beethoven = Animal::with('tutor')->where('nome', 'Beethoven')->get()->first()->toJson();
        $nina = Animal::where('nome', 'Nina')->get()->first();
        $fran = Tutor::where('nome', 'like', 'Francielle%')->get()->first();
        $hemilio = Tutor::where('nome', 'like', 'Hem%')->get()->first();

        $animais = Animal::all();
        foreach ($animais as $animal) {
            $animal['tutor']=$animal->tutor;
        }


        // dd($beethoven, $nina, $fran, $hemilio);
        dd($animais);
    }
}
