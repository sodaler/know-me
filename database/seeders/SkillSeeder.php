<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Skill;
use Database\Factories\SkillFactory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
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

        SkillFactory::new()->count(20)->create();
    }
}
