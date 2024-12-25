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
        $no = 1;
        foreach ($data as $row) {
            (isset($row['anggaran'])) ? $anggaran = $row['anggaran'] : $anggaran = 0;
            (isset($row['sumberAnggaran'])) ? $sumberAnggaran = $row['sumberAnggaran'] : $sumberAnggaran = '';
            DB::table('investasi')->insert([
                'tahun' => $row['tahun'],
                'id_kawasan' => $row['idKawasan'],
                'id_rtrw' => $row['idRTRW'],
                'idKriteria' => $row['idKriteria'],
                'volume' => $row['volume'],
                'kegiatan' => $row['kegiatan'],
                'sumberAnggaran' => $sumberAnggaran,
                'anggaran' => $anggaran,
                'locked' => 1
            ]);
            var_dump('inv' . $no++ . '/1031');
        }
    }
}
