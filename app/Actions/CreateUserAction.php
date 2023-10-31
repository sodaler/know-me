<?php

namespace App\Actions;

use App\Enums\Auth\GrantTypeEnums;
use App\Enums\DBCodeEnums;
use App\Enums\Http\MethodEnums;
use App\Enums\Http\StatusCodeEnums;
use App\Models\User;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;

class CreateUserAction
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }

    public function execute(array $data)
    {
        DB::beginTransaction();

        try {
            User::create($data);
            $tokens = $this->authService->generateTokens(
                $this->authService->getCredentialsFromArray($data),
                MethodEnums::POST->value,
                GrantTypeEnums::PASSWORD->value
            );
            $response['data'] = $this->authService->handle($tokens);

            DB::commit();
        } catch (PDOException $e) {
            DB::rollBack();

            Log::error($e);
            $response['data'] = match (intval($e->getCode())) {
                DBCodeEnums::DUPLICATE->value => __('errors.user_exists'),
                default => __('errors.database_error'),
            };
            $response['status'] = StatusCodeEnums::SERVER_ERROR->value;
        } catch (Exception $e) {
            DB::rollBack();

            $response['data'] = $e->getMessage();
            $response['status'] = StatusCodeEnums::SERVER_ERROR->value;
        } finally {
            return $response;
        }
    }
}