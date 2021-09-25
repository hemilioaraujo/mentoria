<?php

/**
 * [TODO:]
 * Criar requests para cada verbo HTTP
 * Estudar services e repositores
 */

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\AnimalRequest;
use App\Models\Animal;
use App\Models\Tutor;
use Fig\Http\Message\StatusCodeInterface;
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
        return Response($animais, StatusCodeInterface::STATUS_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function post(AnimalRequest $request)
    {
        $request->validate(Animal::rules(), Animal::messages());
        $animal = Animal::Create($request->all());
        return Response($animal, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::with('tutor')->findOrFail($id);
        // try {
        // } catch (\Throwable $th) {
        //     // dd($th);
        //     return Response($th->getMessage(), StatusCodeInterface::HTTP_OK);
        // }
        if ($animal) {
            return Response($animal, StatusCodeInterface::STATUS_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function patch(Request $request, $id)
    {
        if (Animal::whereId($id)->update($request->all())) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response(
            ['status' => 'Recurso não encontrado.'],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    public function put(Request $request, $id)
    {
        $request->validate(Animal::rules(), Animal::messages());
        if (Animal::whereId($id)->update($request->all())) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response(
            ['status' => 'Recurso não encontrado.'],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Animal::destroy($id)) {
            return Response(
                [],
                StatusCodeInterface::STATUS_OK
            );
        }

        /**
         * Sempre retorna vazio no response de destroy
         * e NO_CONTENT no status
         */
        return Response(
            [],
            StatusCodeInterface::STATUS_NO_CONTENT
        );
    }
}
