<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException)
        {
            return response()->json(
            [
                'result' => 'error',
                'error' => [
                    'code' => 'NOT_FOUND'
                ]
            ], Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof NotFoundHttpException)
        {
            return response()->json(
            [
                'result' => 'error', 
                'error' => [
                    'code' => 'URL_NOT_FOUND'
                ]
            ], 404);
        }
        if ($exception instanceof QueryException) 
        {
            return response()->json(
            [
                'result' => 'error',
                'error' => [
                    'code' => 'The server encountered a temporary error and could not complete your request'
                ]
            ], 502);
        }
        if ($exception instanceof PDOException) 
        {
            return response()->json(
            [
                'result' => 'error',
                'error' => [
                    'code' => 'SERVER_ERROR'
                ]
            ], 500);
        }
        return parent::render($request, $exception);
    }
}
