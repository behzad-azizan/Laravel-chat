<?php

namespace App\Exceptions;

use HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, \Throwable $e)
    {
        if ($e instanceof ModelNotFoundException)
            return response()->json([
                'code' => 404,
                'error' => 'not_fount',
                'message' => 'رکورد یافت نشد!',
                'data' => null
            ], 404);

        elseif ($e instanceof MethodNotAllowedHttpException)
            return response()->json([
                'code' => 405,
                'error' => 'method_not_allow',
                'message' => 'متد قابل پشتیبانی در این api :' . $e->getHeaders()['Allow'],
                'data' => null
            ], 405);

        elseif ($e instanceof AuthorizationException)
            return response()->json([
                'code' => 403,
                'error' => 'unauthorized_action',
                'message' => 'شما اجازه انجام این عملیات را ندارید.',
                'data' => null
            ], 403);

        elseif ($e instanceof RouteNotFoundException || $e instanceof NotFoundHttpException)
            return response()->json([
                'code' => 404,
                'error' => 'not_fount_route',
                'message' => 'هیچ مسیری برای پاسخگویی به درخواست شما یافت نشد!',
                'data' => null
            ], 404);

        elseif ($e instanceof ValidationException) {
            $message = [];
            foreach ($e->errors() as $error)
                $message[] = implode("\n", $error);

            return response()->json([
                'code' => 400,
                'error' => 'validation_error',
                'message' => 'ورودی های ارسالی نامعتبر است.',
                'validation_message' => implode("\n", (array) $message),
                'data' => (array)$e->errors()
            ], 400);
        }

        elseif($e instanceof AuthenticationException)
            return response()->json([
                'code' => 401,
                'error' => 'Invalid_access_token',
                'message' => 'کلید اعتبارسنجی ارسالی نامعتبر است.',
                'data' => null,
            ], 401);

        elseif ($e instanceof SpecialException)
            return response()->json([
                'code' => $e->getCode(),
                'error' => $e->getErrorCode(),
                'message' => $e->getMessage(),
                'data' => null,
            ], $e->getCode());

        elseif ($e instanceof HttpException)
            return response()->json([
                'code' => $e->getStatusCode(),
                'error' => 'http_error',
                'message' => trans('m.internal_error'),
                'data' => null
            ], $e->getStatusCode());

        elseif ($e instanceof ThrottleRequestsException)
            return response()->json([
                'code' => $e->getStatusCode(),
                'error' => 'to_many_requests',
                'message' => trans('m.throttle_error'),
                'data' => [
                    'retry_after' => $e->getHeaders()['Retry-After']
                ]
            ], $e->getStatusCode());

        return response()->json([
            'code' => 500,
            'error' => 'internal_error',
            'message' => trans('m.internal_error'),
            'data' => null
        ], 500);
    }
}
