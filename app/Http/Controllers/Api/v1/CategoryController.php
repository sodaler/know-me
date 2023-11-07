<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
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
    ) {
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
    public function store(StoreRequest $request): JsonResponse
    {
        $category = $this->categoryService->store($request->validated());

        return response()->json([
            'message' => __('messages.success_create'),
            'item' => [
                'id' => $category->id,
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryWithCardsResource
    {
        return new CategoryWithCardsResource($category->load(['cards.user']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): CategoryResource
    {
        return new CategoryResource(
            $this->categoryService->update($category, $request->validated())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->skills()->detach();
        $category->delete();

        return response()->json([
            'message' => __('messages.success_delete'),
        ]);
    }
}
