<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SK24RTRWSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sk24_rtrw')->truncate();
        $json = file_get_contents(database_path('seeders/rtrw24.json'));
        $data = json_decode($json, true);
        foreach ($data as $row) {
            DB::table('sk24_rtrw')->insert([
                'kawasan' => $row['kawasan'],
                'rtrw' => $row['rtrw'],
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
