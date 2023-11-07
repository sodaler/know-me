<?php

namespace App\Actions\User;

use App\Enums\Http\StatusCodeEnums;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateUserAction
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    public function execute(array $data): array
    {
        try {
            DB::beginTransaction();
            User::create($data);

            $response['data'] = $this->authService->getTokensByCredentials($data);
            $response['status'] = StatusCodeEnums::OK->value;

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            $response['data']['message'] = __('errors.any');
            $response['status'] = StatusCodeEnums::SERVER_ERROR->value;
        } finally {
            return $response;
        }
    }
}
