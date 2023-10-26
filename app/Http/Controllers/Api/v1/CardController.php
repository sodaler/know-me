<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Card\CardResource;
use App\Models\Card;
use App\Services\Card\CardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CardController extends Controller
{
    public function __construct(
        private readonly CardService $cardService
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        $cards = Card::with(['skills', 'user'])->paginate(10);

        return CardResource::collection($cards);
    }

    public function show(Card $card): CardResource
    {
        return new CardResource($card->load('skills'));
    }

    public function addImage(Request $request, Card $card): JsonResponse
    {
        $this->cardService->addImage($request->file('image'), $card);

        return response()->json(200);
    }
}
