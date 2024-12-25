<?php

namespace Database\Seeders;

use App\Models\Kawasan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KawasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // import from json
        DB::table('investasi')->truncate();
        DB::table('kumuh_rt')->truncate();
        DB::table('kumuh_kawasan')->truncate();
        DB::table('rtrw')->truncate();
        DB::table('kawasan')->truncate();
        $json = file_get_contents(database_path('seeders/kawasan.json'));
        $data = json_decode($json, true);
        $no = 1;

        foreach ($data as $row) {
            DB::table('kawasan')->insert([
                'kawasan' => $row['kawasan'],
                'wilayah' => $row['wilayah'],
                'rt-rw' => $row['rt-rw'],
                'luasFlag' => $row['luasFlag'],
                'luasVerifikasi' => $row['luasVerifikasi'],
                'jumlahBangunan' => $row['jumlahBangunan'],
                'jumlahPenduduk' => $row['jumlahPenduduk'],
                'jumlahKK' => $row['jumlahKK'],
                'panjangJalanIdeal' => $row['panjangJalanIdeal'],
                'panjangDrainaseIdeal' => $row['panjangDrainaseIdeal']
            ]);
            var_dump('kawasan' . $no++ . '/27');
        }
    }
}
