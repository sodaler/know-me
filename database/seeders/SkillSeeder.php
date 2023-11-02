<?php

namespace Database\Seeders;

use Database\Factories\SkillFactory;
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
