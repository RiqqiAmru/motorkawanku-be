<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LatlangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('latlong')->truncate();
        $json = file_get_contents(database_path('seeders/latlng.json'));
        $data = json_decode($json, true);
        $no = 1;
        foreach ($data as $row) {
            var_dump('ltlg' . $no++ . '/469');
            $coordinate = json_encode($row['coordinates']);
            $kodeRTRW = (isset($row['kodeRTRW'])) ? $row['kodeRTRW'] : '';
            DB::table('latlong')->insert([
                'kelurahan' => $row['kelurahan'],
                'type' => $row['type'],
                'kodeRTRW' => $kodeRTRW,
                'coordinates' => $coordinate,
            ]);
        }

        $json = file_get_contents(database_path('seeders/baru.json'));
        $data = json_decode($json, true);
        foreach ($data as $row) {
            $coordinate = json_encode($row["geometry"]['coordinates']);
            DB::table('latlong')->insert([
                'kelurahan' => $row["properties"]['KECAMATAN'],
                'type' => $row["geometry"]['type'],
                'kodeRTRW' => '',
                'coordinates' => $coordinate,
            ]);
        }
    }
}
