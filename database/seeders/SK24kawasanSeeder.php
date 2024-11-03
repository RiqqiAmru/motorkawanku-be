<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SK24kawasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sk24_kumuh_rt')->truncate();
        DB::table('sk24_kumuh_kawasan')->truncate();
        DB::table('sk24_rtrw')->truncate();
        DB::table('sk24_kawasan')->truncate();
        $json = file_get_contents(database_path('seeders/kawasan24.json'));
        $data = json_decode($json, true);
        foreach ($data as $row) {
            DB::table('sk24_kawasan')->insert([
                'id' => $row['id'],
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
        }
    }
}
