<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KumuhRTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kumuh_rt')->truncate();
        $json = file_get_contents(database_path('seeders/kumuhRT.json'));
        $data = json_decode($json, true);
        $no = 1;
        foreach ($data as $row) {
            var_dump('k_rt' . $no++ . '/2160');
            DB::table('kumuh_rt')->insert([
                'id_rtrw' => $row['rt'],
                'id_kawasan' => $row['kawasan'],
                'tahun' => $row['tahun'],
                '1av' => $row['1av'],
                '1ap' => $row['1ap'],
                '1an' => $row['1an'],
                '1bv' => $row['1bv'],
                '1bp' => $row['1bp'],
                '1bn' => $row['1bn'],
                '1cv' => $row['1cv'],
                '1cp' => $row['1cp'],
                '1cn' => $row['1cn'],
                '1r' => $row['1r'],
                '2av' => $row['2av'],
                '2ap' => $row['2ap'],
                '2an' => $row['2an'],
                '2bv' => $row['2bv'],
                '2bp' => $row['2bp'],
                '2bn' => $row['2bn'],
                '2r' => $row['2r'],
                '3av' => $row['3av'],
                '3ap' => $row['3ap'],
                '3an' => $row['3an'],
                '3bv' => $row['3bv'],
                '3bp' => $row['3bp'],
                '3bn' => $row['3bn'],
                '3r' => $row['3r'],
                '4av' => $row['4av'],
                '4ap' => $row['4ap'],
                '4an' => $row['4an'],
                '4bv' => $row['4bv'],
                '4bp' => $row['4bp'],
                '4bn' => $row['4bn'],
                '4cv' => $row['4cv'],
                '4cp' => $row['4cp'],
                '4cn' => $row['4cn'],
                '4r' => $row['4r'],
                '5av' => $row['5av'],
                '5ap' => $row['5ap'],
                '5an' => $row['5an'],
                '5bv' => $row['5bv'],
                '5bp' => $row['5bp'],
                '5bn' => $row['5bn'],
                '5r' => $row['5r'],
                '6av' => $row['6av'],
                '6ap' => $row['6ap'],
                '6an' => $row['6an'],
                '6bv' => $row['6bv'],
                '6bp' => $row['6bp'],
                '6bn' => $row['6bn'],
                '6r' => $row['6r'],
                '7av' => $row['7av'],
                '7ap' => $row['7ap'],
                '7an' => $row['7an'],
                '7bv' => $row['7bv'],
                '7bp' => $row['7bp'],
                '7bn' => $row['7bn'],
                '7r' => $row['7r'],
                'totalNilai' => $row['totalNilai'],
                'tingkatKekumuhan' => $row['tingkatKekumuhan'],
                'ratarataKekumuhan' => $row['ratarataKekumuhan'],
                'kontribusiPenanganan' => $row['kontribusiPenanganan']
            ]);
        }
    }
}
