<?php

namespace App\Exceptions;

use App\Enums\ResponseMessage;
use App\Enums\ResponseType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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

    public function render($request, Throwable $e): JsonResponse
    {
        switch($e)
        {
            case $e instanceof AccessDeniedHttpException:
                return response()->json(
                    $this->serializeResponse($e),
                    Response::HTTP_FORBIDDEN
                );
            case $e instanceof ModelNotFoundException:
                return response()->json(
                    $this->serializeResponse($e),
                    Response::HTTP_NOT_FOUND
                );
            case $e instanceof ValidationException:
                return response()->json(
                    $this->serializeResponse($e),
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            default:
                return response()->json(
                    $this->serializeResponse($e),
                    Response::HTTP_BAD_REQUEST
                );
        }
    }

    private function serializeResponse(mixed $e): array
    {
        return [
            'message' => ResponseMessage::ERROR,
            'type' => ResponseType::EXCEPTION,
            'data' => [
                'message' => $e->getMessage(),
            ],
        ];
    }
}
