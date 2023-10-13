<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingScopeException;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthenticationException) {
            return response()->json([
                'code' => 'authentication_required',
                'error' => 'Autenticação necessária',
            ], Response::HTTP_UNAUTHORIZED, ['WWW-Authenticate' => 'Bearer']);
        }

        if ($e instanceof MissingScopeException) {
            return response()->json([
                'code' => 'access_denied',
                'error' => 'Este usuário não tem permissão para acessar este recurso',
            ], Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                'code' => 'validation_exception',
                'messages' => $e->validator->errors()->getMessages(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'code' => 'method_not_allowed',
                'error' => 'Este método não está disponível para esta rota',
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'code' => 'resource_not_found',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'code' => 'route_not_found',
                'error' => 'Rota não encontrada',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFound) {
            return response()->json([
                'code' => 'not_found',
                'error' => 'registro não encontrado ' . $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof UnauthorizedException) {
            return response()->json([
                'code' => 'unauthorized',
                'error' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
		}

        return response()->json([
            'code' => 'internal_server_error',
            'error' => $e->getMessage(),
            'messages' => $e->getTrace(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
