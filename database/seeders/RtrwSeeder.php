<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RtrwSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rtrw')->truncate();
        $json = file_get_contents(database_path('seeders/rtrw.json'));
        $data = json_decode($json, true);
        $no = 1;
        foreach ($data as $row) {
            var_dump('k_k' . $no++ . '/432');
            DB::table('rtrw')->insert([
                'id_kawasan' => $row['kawasan'],
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
