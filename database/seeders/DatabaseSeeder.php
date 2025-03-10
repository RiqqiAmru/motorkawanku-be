<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        // User::factory(10)->create();
        
        $this->call([
            UserSeeder::class,
            KotaSeeder::class,
            KawasanSeeder::class,
            RtrwSeeder::class,
            KumuhKawasanSeeder::class,
            KumuhRTSeeder::class,
            InvestasiSeeder::class,
            LatlangSeeder::class,
        ]);
    }
}
