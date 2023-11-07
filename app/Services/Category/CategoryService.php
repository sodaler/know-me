<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\FileService;
use Illuminate\Http\UploadedFile;

class CategoryService
{
    public function __construct(
        private readonly FileService $fileService
    ) {}

    public function store(array $data): Category
    {
        $image = $this->extractImage($data);

        $category = Category::create($data);

        $this->attachCards($category, $data);

        $this->saveCategoryImage($category, $image);

        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        $image = $this->extractImage($data);

        $this->syncCards($category, $data);

        $category->updateOrFail($data);

        $this->saveCategoryImage($category, $image);

        return $category->fresh();
    }

    private function extractImage(array $data): ?UploadedFile
    {
        $image = $data['image'] ?? null;

        unset($data['image']);

        return $image;
    }

    private function attachCards(Category $category, array $data): void
    {
        if (!empty($data['card_ids'])) {
            $cards = $this->getCardIds($data);

            $category->cards()->attach($cards);
        }
    }

    private function syncCards(Category $category, array $data): void
    {
        if (!empty($data['card_ids'])) {
            $cards = $this->getCardIds($data);

            $category->cards()->sync($cards);
        }
    }

    private function saveCategoryImage(Category $category, ?UploadedFile $image): void
    {
        if ($image) {
            $this->fileService->save($image, $category);
        }
    }

    private function getCardIds(array $data): array
    {
        $cards = $data['card_ids'];
        unset($data['card_ids']);

        return $cards;
    }
}
