<?php

namespace App\Http\Controllers\api;

use Fig\Http\Message\StatusCodeInterface;
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
        return Response(Tutor::all(), StatusCodeInterface::STATUS_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $request->validate(Tutor::rules(), Tutor::messages());
        $tutor = Tutor::create($request->all());
        return Response($tutor, StatusCodeInterface::STATUS_CREATED);
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
            return Response($tutor, StatusCodeInterface::STATUS_OK);
        }

        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function patch(Request $request, $id)
    {
        if (Tutor::whereId($id)->update($request->all())) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    public function put(Request $request, int $id)
    {
        $request->validate(Tutor::rules(), Tutor::messages());
        if (Tutor::whereId($id)->update($request->all())) {
            return Response(
                ['status' => 'Recurso atualizado com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response(
            [],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Tutor::destroy($id)) {
            return Response(
                ['status' => 'Recurso excluído com sucesso.'],
                StatusCodeInterface::STATUS_OK
            );
        }

        return Response(
            ['status' => 'Recurso não encontrado.'],
            StatusCodeInterface::STATUS_NOT_FOUND
        );
    }
}
