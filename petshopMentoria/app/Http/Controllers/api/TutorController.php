<?php

namespace App\Http\Controllers\api;

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
        return Tutor::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TutorRequest $request)
    {
        $tutor = Tutor::create($request->all());
        
        if ($tutor) {
            return response()->json(
                $tutor,
                201
            );
        }

        return response()->json(
            $tutor,
            200
        );
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
            return response()->json(
                $tutor,
                200
            );
        }

        return response()->json(
            ['status' => 'Recurso não encontrado.'],
            404
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TutorRequest $request, $id)
    {
        if (Tutor::whereId($id)->update($request->all())) {
            return response()->json(
                ['status' => 'Recurso atualizado com sucesso.'],
                200
            );
        }

        return response()->json(
            ['status' => 'Recurso não encontrado.'],
            404
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
            return response()->json(
                ['status' => 'Recurso excluído com sucesso.'],
                200
            );
        }

        return response()->json(
            ['status' => 'Recurso não encontrado.'],
            404
        );
    }
}
