<?php

namespace App\Http\Controllers\api;

use App\Classes\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Animal\AnimalRequest;
use App\Models\Animal;
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
        return Response(Animal::all(), HttpResponses::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
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
        $animal = Animal::find($id);
        if ($animal) {
            return Response($animal, HttpResponses::HTTP_OK);
        }

        return Response(
            ['status' => 'Recurso não encontrado.'],
            HttpResponses::HTTP_NOT_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, $id)
    {
        if (Animal::whereId($id)->update($request->all())) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                HttpResponses::HTTP_OK
            );
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
