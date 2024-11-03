<?php

namespace Database\Seeders;

use App\Models\SK24Kawasan;
use App\Models\SK24Rtrw;
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
        // DB::table('users')->truncate();
        // // User::factory(10)->create();

        // $this->call([
        //     UserSeeder::class,
        //     KotaSeeder::class,
        //     KawasanSeeder::class,
        //     RtrwSeeder::class,
        //     KumuhKawasanSeeder::class,
        //     KumuhRTSeeder::class,
        //     InvestasiSeeder::class,
        //     LatlangSeeder::class,
        // ]);

        // sk24
        $this->call([
            SK24kawasanSeeder::class,
            SK24RTRWSeeder::class,
            SK24KumuhKawasanSeeder::class,
            Update24Sandingan::class,
            // update2024
        ]);
    }
}
