<?php

namespace App\Exceptions;

use App\Classes\HttpResponses;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Recurso de ' . 'App\\' . $exception->getModel() . ' não foi encontrado.'
            ], HttpResponses::HTTP_NOT_FOUND);
        }
        if ($exception instanceof QueryException) {
            return Response([
                'error' => 'Serviço temporariamente indisponivel.'
            ], HttpResponses::HTTP_SERVICE_UNAVAILABLE);
        }

        return parent::render($request, $exception);
    }
}

/**
 * MÉTODOS DA EXCEPTION QUERYEXCEPTION
 *       0 => "__construct"
 *       1 => "getSql"
 *       2 => "getBindings"
 *       3 => "__wakeup"
 *       4 => "getMessage"
 *       5 => "getCode"
 *       6 => "getFile"
 *       7 => "getLine"
 *       8 => "getTrace"
 *       9 => "getPrevious"
 *       10 => "getTraceAsString"
 *       11 => "__toString"
 */
