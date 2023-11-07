<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Services\FileService;

class CategoryService
{
    public function __construct(
        private readonly FileService $fileService
    ) {
    }

    public function store(array $data): Category
    {
        $skills = $this->getSkillIds($data);
        $category = Category::createOrFail($data);
        $category->skills()->attach($skills);
        $this->fileService->save($data['image'], $category);

        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        $skills = $this->getSkillIds($data);

        $category->updateOrFail($data);
        $category->skills()->sync($skills);

        return $category->fresh();
    }

    private function getSkillIds(array $data): array
    {
        $skills = $data['skill_ids'];
        unset($data['skill_ids']);

        return $skills;
    }
}
