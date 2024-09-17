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
            'role' => 'admin'
        ]);

        foreach ($wilayah as $w) {
            User::factory()->create([
                'name' => $w,
                'email' => $w . '@dinperkim.com',
            ]);
        }
    }
}
