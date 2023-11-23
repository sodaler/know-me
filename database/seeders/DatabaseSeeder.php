<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected array $toTruncate = [
        'users', 'categories', 'skills', 'cards', 'card_skill',
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->delete();
        }

        $this->call([
            SkillSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            CardSeeder::class,
        ]);

        Model::reguard();
    }
}
