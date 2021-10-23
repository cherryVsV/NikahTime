<?php

namespace App\Exceptions;

use App\Exceptions\ProjectExceptions\BaseError;

Use Throwable;
use Facade\FlareClient\Http\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use UnexpectedValueException;

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

        $this->renderable(function (Throwable $e, $request) {
            return $this->customHandleException($request, $e);
        });

    }

    public function customHandleException($request, Throwable $e)
    {
        if ($request->wantsJson()) {
            $response = [];
            if ($request->wantsJson() && ($e instanceof BaseError)) {
                $response = [
                    'code' => $e->getCode(),
                    'title' => $e->getTitle(),
                    'detail' => $e->getDetail()
                ];

            }
            if ( $e instanceof UnexpectedValueException) {
                $response['code'] = $e->getCode();
                $response['title'] = 'ERR_HTTP_FAILED';
                $response['detail'] = $e->getMessage();
            }
            if ($e instanceof AuthenticationException) {
                $response['code'] = 401;
                $response['title'] = 'ERR_AUTHORIZATION_CHECK_FAILED';
                $response['detail'] = $e->getMessage();
            }
            if ($e instanceof ModelNotFoundException) {
                $response['code'] = Response::HTTP_NOT_FOUND;
                $response['title'] = 'ERR_FOUND_MODEL_FAILED';
                $response['detail'] = $e->getMessage();
            }
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                $response['code'] = 422;
                $response['title'] = 'ERR_VALIDATION_FAILED';
                $response['detail'] = $e->validator->errors()->first();
            }

            if (count($response) > 0) {
                return response()->json([
                    'code' => $response['code'],
                    'title' => $response['title'],
                    'detail' => $response['detail'],

                ], $response['code']);
            }
        }
    }


}
