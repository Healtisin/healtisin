<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\Handler as HttpExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Helpers\LogHelper;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Mencatat error ke dalam log sistem
            if (app()->environment('production')) {
                LogHelper::error('system', "Error: {$e->getMessage()}", [
                    'exception' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        });
    }

    /**
     * A list of the HTTP status codes that should not be reported.
     *
     * @var array<int, int>
     */
    protected $dontReportHttpStatusCodes = [
        Response::HTTP_NOT_FOUND,
        Response::HTTP_INTERNAL_SERVER_ERROR,
        Response::HTTP_BAD_REQUEST,
        Response::HTTP_UNAUTHORIZED,
        Response::HTTP_FORBIDDEN,
        Response::HTTP_METHOD_NOT_ALLOWED,
        Response::HTTP_CONFLICT,
        Response::HTTP_UNPROCESSABLE_ENTITY,
        Response::HTTP_TOO_MANY_REQUESTS,
        Response::HTTP_SERVICE_UNAVAILABLE,
    ];

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReportExceptionTypes = [
        NotFoundHttpException::class,
        ValidationException::class,
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
        if (app()->environment('production')) {
            $this->logException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'The requested resource could not be found.',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'error' => 'Validation Error',
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return parent::render($request, $exception);
    }

    /**
     * Log the exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    protected function logException(Throwable $exception)
    {
        // Implementasi logException
    }
} 