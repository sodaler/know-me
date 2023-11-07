<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordLinkRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    public function link(ResetPasswordLinkRequest $request): JsonResponse
    {
        return response()->json([
            'message' => __(Password::sendResetLink($request->validated())),
        ]);
    }

    public function reset(Request $request): JsonResponse
    {
        return response()->json(
            $request->only(['token', 'email'])
        );
    }

    public function store(ResetPasswordRequest $request): JsonResponse
    {
        return response()->json([
            'message' => __(
                Password::reset(
                    $request->validated(),
                    function ($user) use ($request) {
                        $user->forceFill([
                            'password' => Hash::make($request->password),
                        ])->save();

                        event(new PasswordReset($user));
                    }
                )
            ),
        ]);
    }
}
