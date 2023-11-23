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
        $skills = Skill::all();

        Card::factory()
            ->count(50)
            ->create()
            ->each(function ($card) use ($skills) {
                $card->skills()->attach($skills->random(rand(1, 5))->pluck('id')->toArray());
            });
    }
}
