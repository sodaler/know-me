<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\User\CreateUserAction;
use App\Enums\Auth\GrantTypeEnums;
use App\Enums\Http\MethodEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OAuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json(
            $this->authService
                ->getTokensByCredentials($request->validated())
        );
    }

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request, CreateUserAction $createUserAction): JsonResponse
    {
        return response()->json( //TODO. No key, but is new user. Need to full secu for action
            ...$createUserAction->execute($request->validated())
        );
    }

    /**
     * @throws Exception
     */
    public function refresh(Request $request): Response
    {
        $response = $this->authService->handle(
            $this->authService->generateTokens(
                $request->only('refresh_token'),
                MethodEnums::POST->value,
                GrantTypeEnums::REFRESH_TOKEN->value
            )
        );

        return response()->json($response);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => __('messages.success_logout'),
        ]);
    }
}
