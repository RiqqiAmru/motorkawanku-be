<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kota')->truncate();
        DB::table('kota')->insert([
            'kota' => 'Kota Pekalongan',
            'provinsi' => 'Jawa Tengah',
            'SK' => 'SK Nomor 430/1131 Tahun 2020'
        ]);
    }
}
