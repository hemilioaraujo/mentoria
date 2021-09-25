<?php

/**
 * Classe TutorController
 *
 * Classe que faz o controle dos recursos de tutores
 *
 * PHP version 8.0.10
 *
 * LICENSE: MIT
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

namespace App\Http\Controllers\api;

use Fig\Http\Message\StatusCodeInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tutor\TutorRequest;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Undocumented class
 *
 * @category Controller
 * @package  Controllers
 * @author   Hemílio <hemilioaraujo@gmail.com>
 * @license  MIT <www.wwwww.com>
 * @link     <www.wwwww.com>
 */
class TutorController extends Controller
{
    public function index()
    {
        return Response(Tutor::all(), StatusCodeInterface::STATUS_OK);
    }

    public function post(Request $request)
    {
        $request->validate(Tutor::rules(), Tutor::messages());
        $tutor = Tutor::create($request->all());
        return Response($tutor, StatusCodeInterface::STATUS_CREATED);
    }

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
     * @param int $id []
     *
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
