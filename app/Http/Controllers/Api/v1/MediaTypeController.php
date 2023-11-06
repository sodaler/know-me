<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaType\StoreRequest;
use App\Models\MediaType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaTypeController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        return response()->json([
            MediaType::create($request->validated()),
        ]);
    }

    public function destroy(MediaType $mediaType): JsonResponse
    {
        $mediaType->delete();
        
        return response()->json([
            'message' => __('messages.success_delete'),
        ]);
    }
}
