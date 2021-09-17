<?php

namespace App\Http\Controllers\api;

use App\Classes\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\AnimalRequest;
use App\Models\Animal;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Método GET
     */
    public function index()
    {
        $animais = Animal::all();
        foreach ($animais as $animal) {
            $animal['tutor'] = $animal->tutor;
        }
        return Response($animais, HttpResponses::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        $request->validate(Animal::rules(), Animal::messages());
        $animal = Animal::Create($request->all());
        return Response($animal, HttpResponses::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::with('tutor')->findOrFail($id);
        // try {
        // } catch (\Throwable $th) {
        //     // dd($th);
        //     return Response($th->getMessage(), HttpResponses::HTTP_OK);
        // }
        if ($animal) {
            return Response($animal, HttpResponses::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->method() === 'PATCH') {
            if (Animal::whereId($id)->update($request->all())) {
                return Response(
                    ['status' => 'Recurso atualizado com sucesso.'],
                    HttpResponses::HTTP_OK
                );
            }
        } elseif ($request->method() === 'PUT') {
            $request->validate(Animal::rules(), Animal::messages());
            if (Animal::whereId($id)->update($request->all())) {
                return Response(
                    ['status' => 'Recurso atualizado com sucesso.'],
                    HttpResponses::HTTP_OK
                );
            }
        }

        return Response(
            ['status' => 'Recurso não encontrado.'],
            HttpResponses::HTTP_NOT_FOUND
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Animal::destroy($id)) {
            return Response(
                ['status' => 'Recurso excluído com sucesso.'],
                HttpResponses::HTTP_OK
            );
        }

        return Response(
            ['status' => 'Recurso não encontrado.'],
            HttpResponses::HTTP_NOT_FOUND
        );
    }
}
