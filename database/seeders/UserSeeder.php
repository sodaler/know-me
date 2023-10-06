<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Database\Factories\SkillFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Skill::factory())
            ->count(10)
            ->create();
    }
}
