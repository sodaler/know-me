<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //        Category::factory()
        //            ->hasAttached(Skill::query()->inRandomOrder()->get())
        //            ->count(10)
        //            ->create();

        Category::factory()
            ->hasAttached(Skill::query()->inRandomOrder()->take(rand(1, 3))->get())
            ->count(10)
            ->create();
    }
}
