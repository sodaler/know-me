<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\FileService;

// TODO: store, update
class CategoryService
{
    public function __construct(private readonly FileService $fileService)
    {
    }

    public function store(array $data): Category
    {
        if (!empty($data['image'])) {
            $image = $data['image'];
            unset($data['image']);
        }

        $category = Category::create($data);

        $this->fileService->saveImage("category/{$category->id}", $image);

        if (!empty($data['card_ids'])) {
            $cards = $this->getCardIds($data);

            $category->cards()->attach($cards);
        }

        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        if ($data['image']) {
            $data['image'] = $this->fileService->saveImage('/category', $data['image']);
        }

        if (!empty($data['card_ids'])) {
            $cards = $this->getCardIds($data);

            $category->cards()->sync($cards);
        }

        $category->updateOrFail($data);

        return $category->fresh();
    }

    private function getCardIds(array $data): array
    {
        $cards = $data['card_ids'];
        unset($data['card_ids']);

        return $cards;
    }
}
