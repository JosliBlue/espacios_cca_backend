<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LocationsSeeder::class,
            UserSeeder::class,
            WorkshopsSeeder::class,
            WorkshopSchedulesSeeder::class,
        ]);
    }
}
