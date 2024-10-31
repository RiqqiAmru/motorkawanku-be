<?php

namespace Database\Seeders;

use App\Models\Investasi;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class clearInvestasi2024 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Investasi::where('tahun', 2024)->delete();
        KumuhKawasan::where('tahun', 2024)->delete();
        KumuhRT::where('tahun', 2024)->delete();
    }
}