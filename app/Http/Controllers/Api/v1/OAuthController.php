<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\Auth\GrantTypeEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Response;

class OAuthController extends Controller
{
    /**
     * @throws Exception
     */
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        return response()->json(
            $authService->getTokensByCredentials($request->validated())
        );
    }

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request, UserService $userService, AuthService $authService): JsonResponse
    {
        return response()->json( //TODO. No key, but is new user. Need to full secu for action
            ...$userService->store($request->validated(), $authService)
        );
    }

    /**
     * @throws Exception
     */
    public function refresh(Request $request, AuthService $authService): Response
    {
        $response = $authService->handle(
            $authService->generateTokens(
                $request->only('refresh_token'),
                HttpRequest::METHOD_GET,
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
