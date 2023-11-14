<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryWithCardsResource;
use App\Models\Category;
use App\Services\Category\CategoryService;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): array
    {
        $categories = Category::paginate(10);

        return CategoryResource::collection($categories)->resolve();
    }

    public function store(StoreRequest $request, CategoryService $categoryService, FileService $fileService): CategoryResource
    {
        $data = $request->validated();

        $category = $categoryService->store($data, $fileService);

        return new CategoryResource($category);
    }

    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function update(UpdateRequest $request, Category $category, CategoryService $categoryService, FileService $fileService): CategoryResource
    {
        return new CategoryResource(
            $categoryService->update($category, $request->validated(), $fileService)
        );
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->cards()->detach();
        $category->delete();

        return response()->json([
            'message' => __('messages.success_delete'),
        ]);
    }

    public function showCards(Category $category): CategoryWithCardsResource
    {
        return new CategoryWithCardsResource($category->load(['cards.user']));
    }
}
