<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\CreateUserAction;
use App\Enums\Auth\GrantTypeEnums;
use App\Enums\DBCodeEnums;
use App\Enums\Http\MethodEnums;
use App\Enums\Http\StatusCodeEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordLinkRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use PDOException;
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
        $data = $request->validated();

        $tokens = $this->authService->generateTokens(
            $this->authService->getCredentialsFromArray($data),
            MethodEnums::POST->value,
            GrantTypeEnums::PASSWORD->value
        );

        $response = $this->authService->handle($tokens);

        return response()->json(['data' => [$response]]);
    }

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request, CreateUserAction $createUserAction): JsonResponse
    {
        return response()->json(...$createUserAction->execute($request->validated()));
    }

    /**
     * @throws Exception
     */
    public function refresh(Request $request): Response
    {
        $tokens = $this->authService->generateTokens(
            $request->only('refresh_token'),
            MethodEnums::POST->value,
            GrantTypeEnums::REFRESH_TOKEN->value
        );

        $response = $this->authService->handle($tokens);

        return response()->json(['data' => [$response]]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json(['data' => ['message' => 'Successfully logged out']]);
    }
}
