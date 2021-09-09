<?php

namespace App\Http\Controllers\api;

use App\Classes\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tutor\TutorRequest;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response(Tutor::all(), HttpResponses::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Tutor::rules(), Tutor::messages());
        $tutor = Tutor::create($request->all());
        return Response($tutor, HttpResponses::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutor = Tutor::find($id);
        if ($tutor) {
            return Response($tutor, HttpResponses::HTTP_OK);
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
    public function update(Request $request, $id)
    {
        if ($request->method() === 'PATCH') {
            if (Tutor::whereId($id)->update($request->all())) {
                return Response(
                    ['status' => 'Recurso atualizado com sucesso.'],
                    HttpResponses::HTTP_OK
                );
            }
        } elseif ($request->method() === 'PUT') {
            $request->validate(Tutor::rules(), Tutor::messages());
            if (Tutor::whereId($id)->update($request->all())) {
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
        if (Tutor::destroy($id)) {
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
