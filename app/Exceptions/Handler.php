<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Authentication\AuthException;
use Illuminate\Validation\ValidationException;
use App\Custom\NotValidJsonException;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException) {
            return response([
                'Status' => 'Not Found',
                // 'Class' => get_class($exception)
            ],404);
        }

        if($exception instanceof AuthException) {
            return response([
                'Status' => 'Unauthorized',
                'Errors' => $exception->getErrors()
            ],401);
        }

        if ($exception instanceof ValidationException) {
            $errors = [];
            foreach($exception->errors() as $exception_error) {
                foreach($exception_error as $error) {
                    $errors[] = $error;
                }
            } 
            return response()->json([
                'Status' => 'Unprocessable Entity',
                'Errors' => $errors
            ], 422);
        }

        if ($exception instanceof NotValidJsonException) {
            return response()->json([
                'Status' => 'Unsupported Media Type',
                'Errors' => [
                    $exception->getError()
                ]
            ], 415);
        } 

        return parent::render($request, $exception);
    }
}
