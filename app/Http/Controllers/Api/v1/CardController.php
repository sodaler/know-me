<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\AddImageRequest;
use App\Http\Resources\Card\CardResource;
use App\Models\Card;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CardController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $cards = Card::with(['skills', 'user'])->paginate(10);

        return CardResource::collection($cards);
    }

    public function show(Card $card): CardResource
    {
        return new CardResource($card->load('skills'));
    }

    public function addImage(AddImageRequest $request, Card $card, FileService $fileService): JsonResponse
    {
        $fileService->save($request->validated()['image'], $card);

        return response()->json([
            'message' => __('messages.success_update'),
        ]);
    }
}
