<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryWithCardsResource;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        $categories = Category::paginate(10);

        return CategoryResource::collection($categories)->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): CategoryResource
    {
        $data = $request->validated();

        $category = $this->categoryService->store($data);

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category): CategoryResource
    {
        $data = $request->validated();

        $category = $this->categoryService->update($category, $data);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->cards()->detach();
        $category->delete();

        return response()->json(['message' => 'category successfully deleted']);
    }

    public function showCards(Category $category): CategoryWithCardsResource
    {
        return new CategoryWithCardsResource($category->load(['cards.user']));
    }
}
