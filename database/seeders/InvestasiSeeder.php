<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class InvestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('investasi')->truncate();
        $json = file_get_contents(database_path('seeders/investasi.json'));
        $data = json_decode($json, true);
        foreach ($data as $row) {
            (isset($row['anggaran'])) ? $anggaran = $row['anggaran'] : $anggaran = 0;
            (isset($row['sumberAnggaran'])) ? $sumberAnggaran = $row['sumberAnggaran'] : $sumberAnggaran = '';
            DB::table('investasi')->insert([
                'tahun' => $row['tahun'],
                'idKawasan' => $row['idKawasan'],
                'idRTRW' => $row['idRTRW'],
                'idKriteria' => $row['idKriteria'],
                'volume' => $row['volume'],
                'kegiatan' => $row['kegiatan'],
                'sumberAnggaran' => $sumberAnggaran,
                'anggaran' => $anggaran
            ]);
        }
    }
}