<?php

namespace App\Services\Card;

use App\Models\Card;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CardService
{
    public function addImage(UploadedFile $file, Card $card): bool
    {
        return $card->updateOrFail(
            [
                'image' => Storage::disk('public')
                    ->putFileAs(
                        "/card/{$card->id}",
                        $file,
                        $file->getClientOriginalName()
                    )
            ]
        );
    }
}