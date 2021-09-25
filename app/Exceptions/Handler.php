<?php

namespace App\Exceptions;

use App\Exceptions\ProjectExceptions\BaseError;
use App\Exceptions\ProjectExceptions\GrantTypeError;
use Exception;
use Facade\FlareClient\Http\Response;
use HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->renderable(function (Exception $e, $request) {
            return $this->handleException($request, $e);
        });

    }

    public function handleException($request, Exception $e)
    {
        if ($request->wantsJson() && ($e instanceof BaseError)) {
            $response = [
                'code' => $e->getCode(),
                'title' => $e->getTitle(),
                'detail' => $e->getDetail()
            ];

            if ($e instanceof HttpException) {
                $response['code'] = $e->getStatusCode();
                $response['title'] = $e->getMessage();
                $response['detail'] = Response::$statusTexts[$e->getStatusCode()];
            } else if ($e instanceof ModelNotFoundException) {
                $response['code'] = Response::HTTP_NOT_FOUND;
                $response['title'] = $e->getMessage();
                $response['detail'] = Response::$statusTexts[Response::HTTP_NOT_FOUND];
            }

            return response()->json(["Error" =>
                [
                    'code' => $response['code'],
                    'title' => $response['title'],
                    'detail' => $response['detail'],
                ]
            ], $response['code']);
        }

    }


}
