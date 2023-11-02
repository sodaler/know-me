<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //        User::factory()
        //            ->has(Skill::factory())
        //            ->has(Category::factory())
        //            ->count(10)
        //            ->create();

        User::factory()
            ->hasAttached(Category::query()->inRandomOrder()->take(rand(1, 3))->get())
            ->hasAttached(Skill::query()->inRandomOrder()->take(rand(1, 3))->get())
            ->count(10)
            ->create();
    }
}
