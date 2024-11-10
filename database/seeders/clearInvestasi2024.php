<?php

namespace Database\Seeders;

use App\Models\Investasi;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\SK24KumuhKawasan;
use App\Models\SK24KumuhRT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class clearInvestasi2024 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Investasi::where('tahun', 2024)->delete();
        SK24KumuhKawasan::where('tahun', 2024)->delete();
        SK24KumuhRT::where('tahun', 2024)->delete();
        // SK24KumuhKawasan::where('tahun', 2023)->delete();
        // SK24KumuhRT::where('tahun', 2023)->delete();
    }
}
