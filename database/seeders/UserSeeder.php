<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayah = ['Podosugih', 'Medono', 'Tirto', 'Pringrejo', 'Bendan', 'PasirKratonKramat', 'Sapuro Kebulen', 'Jenggot', 'KuripanYosorejo', 'Sokoduwet', 'KuripanKertoharjo', 'Buaran', 'Banyurip', 'Klego', 'Poncol', 'Gamer', 'Kauman', 'Noyontaansari', 'KaliBaros', 'Setono', 'Bandengan', 'Degayu', 'KandangPanjang', 'PanjangWetan', 'PanjangBaru', 'Kraton', 'Krapyak'];
        DB::table('users')->truncate();
        User::factory()->create([
            'name' => 'Admin Dinperkim',
            'email' => 'admin.dinperkim@gmail.com',
            'role' => 'admin',
            'kawasan_id' => null
        ]);
        User::factory()->count(4)->create([
            'role' => 'admin',
            'kawasan_id' => null
        ]);
        User::factory()->count(4)->create();
        $wilayahID = 1;
        foreach ($wilayah as $w) {
            User::factory()->create([
                'name' => $w,
                'email' => $w . '@dinperkim.com',
                'kawasan_id' => $wilayahID,
            ]);
            $wilayahID++;
        }
    }
}
