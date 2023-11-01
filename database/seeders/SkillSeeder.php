<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Skill;
use Database\Factories\CategoryFactory;
use Database\Factories\SkillFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkillFactory::new()->count(20)->create();
    }
}
