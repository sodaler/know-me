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

        $tokens = $this->getTokens($data);
        $response = $this->authService->handle($tokens);

        return response()->json($response);
    }

    /**
     * @throws Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            User::create($data);
            $tokens = $this->getTokens($data);

            if ($this->authService->isTokenRequestSuccessful($tokens)) {
                DB::commit();

                $response = $this->authService->handle($tokens);

                return response()->json($response, 201);
            } else {
                DB::rollBack();

                return response()->json(['error' => 'Failed to generate tokens'], 500);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to register user: ' . $e->getMessage()], 500);
        }
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

        return response()->json($response);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out']);
    }

    private function getTokens(array $data)
    {
        $credentials = $this->authService->getCredentialsFromArray($data);

        return $this->authService->generateTokens(
            $credentials,
            MethodEnums::POST->value,
            GrantTypeEnums::PASSWORD->value
        );
    }
}
