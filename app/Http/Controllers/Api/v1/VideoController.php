<?php

namespace App\Http\Controllers\Api\v1;

use App\Classes\AgoraDynamicKey\RtcTokenBuilder;
use App\Enums\Video\Helpers;
use App\Events\Video\MakeAgoraCall;
use App\Http\Controllers\Controller;
use App\Http\Requests\Video\CallUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function token(Request $request): JsonResponse
    {
        return response()->json([
            'token' => RtcTokenBuilder::buildTokenWithUserAccount(
                appID: config('services.agora.app_id'),
                appCertificate: config('services.agora.app_certificate'),
                channelName: $request->get('channel_name'),
                userAccount: auth()->user()->name,
                role: RtcTokenBuilder::RoleAttendee,
                privilegeExpireTs: now()->getTimestamp() + Helpers::ExpireTimeInSeconds->value
            ),
        ]);
    }

    public function callUser(CallUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['from'] = auth()->id();

        broadcast(new MakeAgoraCall($data))->toOthers();

        return response()->json([
            "successful called to {$data['call_to_user']}"
        ]);
    }
}
