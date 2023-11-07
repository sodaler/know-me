<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Card::factory()
            ->count(10)
            ->create()
            ->each(function (Card $card) {
                $user = $card->user;

                $card->categories()->attach($user->categories->pluck('id'));
                $card->skills()->attach($user->skills->pluck('id'));
            });
    }
}
