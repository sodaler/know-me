<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\Card\CardCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Card\AddImageRequest;
use App\Http\Requests\Card\StoreRequest;
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

    public function store(StoreRequest $request): CardResource
    {
        $requestData = $request->validated();

        $mentorId = auth()->user()->getAuthIdentifier();
        $requestData['user_id'] = $mentorId;

        $card = Card::create($requestData);

        event(new CardCreated($card));

        return new CardResource($card);
    }

    public function addImage(AddImageRequest $request, Card $card, FileService $fileService): JsonResponse
    {
        $card->update([
            'image' => $fileService
                ->saveImage("card/{$card->id}", $request->file('image')),
        ]);

        return response()->json([
            'message' => __('messages.success_update'),
        ]);
    }
}
