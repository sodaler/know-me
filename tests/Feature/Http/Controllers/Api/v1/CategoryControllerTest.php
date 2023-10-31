<?php

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'accept' => 'application/json'
        ]);

        $this->user = UserFactory::new()->create();
    }

    public function test_it_index_response_successful()
    {
        $this->withoutExceptionHandling();

        $categories = Category::factory(5)->create();
        $response = $this->actingAs($this->user)->get('/api/v1/categories');

        $json = $this->transformToArray($categories);

        $response->assertStatus(200);
        $response->assertJson($json);
    }

    public function test_it_access_route_by_only_auth_user()
    {
        Category::factory()->create();

        $response = $this->get('/api/v1/categories');

        $response->assertUnauthorized();
    }

    public function test_attribute_title_is_required_for_storing()
    {
        $data = $this->validParams(['title' => '']);

        $response = $this->actingAs($this->user)->post('/api/v1/categories', $data);

        $response->assertStatus(422);
        $response->assertInvalid('title');
    }

    public function test_it_created_successful()
    {
        $this->withoutExceptionHandling();

        $data = $this->validParams();

        $response = $this->actingAs($this->user)->post('/api/v1/categories', $data);
        $this->assertDatabaseCount('categories', 1);

        $category = Category::first();

        $this->assertEquals($data['title'], $category->title);
        $this->assertEquals($data['description'], $category->description);

        $response->assertJson([
            'id' => $category->id,
            'title' => $category->title,
            'description' => $category->description,
        ]);
    }

    private function transformToArray(Collection $categories): array
    {
        return $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category->title,
                'description' => $category->description,
                'slug' => $category->slug,
                'image' => $category->image,
                'alt' => $category->image_alt,
            ];
        })->toArray();
    }

    private function validParams($overrides = [])
    {
        return array_merge([
            'title' => 'hello world',
            'description' => "I'm a content",
        ], $overrides);
    }
}
