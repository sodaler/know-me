<?php

namespace App\Services\Auth;

use Exception;
use Illuminate\Http\Request;

class AuthService
{
    public function generateTokens(array $credentials, string $method, string $type): Request
    {
        $data = array_merge($credentials, $this->getClientData(), ['grant_type' => $type, 'scope' => '']);

        return Request::create('/oauth/token', $method, $data);
    }

    /**
     * @throws Exception
     */
    public function handle(Request $request): array
    {
        $result = app()->handle($request);

        return json_decode($result->getContent(), true);
    }

    public function getCredentialsFromRequest(Request $request): array
    {
        return [
            'username' => $request->get('email'),
            'password' => $request->get('password'),
        ];
    }

    public function getCredentialsFromArray(array $data): array
    {
        return [
            'username' => $data['email'],
            'password' => $data['password'],
        ];
    }

    private function getClientData(): array
    {
        return [
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
        ];
    }
}
