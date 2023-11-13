<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $skills = Skill::all();

        Card::factory()
            ->count(20)
            ->create()
            ->each(function ($card) use ($categories, $skills) {
                $card->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());

                $card->skills()->attach($skills->random(rand(1, 5))->pluck('id')->toArray());
            });
    }
}
