<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\FileService;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function __construct(private readonly FileService $fileService)
    {
    }

    public function store(array $data): Category
    {
        $data['image'] = !empty($data['image'])
            ? $this->fileService->saveImage('/category', $data['image'])
            : 'default';

        $category = Category::create($data);

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
