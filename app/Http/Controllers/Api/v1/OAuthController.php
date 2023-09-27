<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\Auth\GrantTypeEnums;
use App\Enums\Http\MethodEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use Symfony\Component\HttpFoundation\Response;

class OAuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $tokens = $this->authService->generateTokens(
            $this->authService->getCredentialsFromArray($data),
            MethodEnums::POST->value, GrantTypeEnums::PASSWORD->value);

        $response = $this->authService->handle($tokens);

        return response()->json(['data' => [$response]], 200);
    }

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            User::create($data);

            $tokens = $this->authService->generateTokens(
                $this->authService->getCredentialsFromArray($data),
                MethodEnums::POST->value, GrantTypeEnums::PASSWORD->value);

            $response = $this->authService->handle($tokens);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['data' => [
                'message' => $e->getMessage()
            ]], 500);
        }

        return response()->json(['data' => [$response]], 200);
    }

    /**
     * @throws Exception
     */
    public function refresh(Request $request): Response
    {
        $tokens = $this->authService->generateTokens(
            $request->only('refresh_token'),
            MethodEnums::POST->value, GrantTypeEnums::REFRESH_TOKEN->value);

        $response = $this->authService->handle($tokens);

        return response()->json(['data' => [$response]], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json(['data' => ['message' => 'Successfully logged out']]);
    }
}
