<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KumuhKawasan>
 */
class KumuhKawasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_kawasan' => fake()->numberBetween(1, 27), // ID kawasan antara 1 dan 27
            'tahun' => fake()->numberBetween(2020, 2023), // Tahun antara 2020 dan 2023
            '1av' => fake()->randomFloat(2, 0, 500), // Nilai acak dengan dua angka desimal antara 0 dan 500
            '1ap' => fake()->randomFloat(2, 0, 1), // Nilai acak antara 0 dan 1
            '1an' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '1an'
            '1bv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '1bv'
            '1bp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '1bp'
            '1bn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '1bn'
            '1cv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '1cv'
            '1cp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '1cp'
            '1cn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '1cn'
            '1r' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '1r'
            '2av' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '2av'
            '2ap' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '2ap'
            '2an' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '2an'
            '2bv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '2bv'
            '2bp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '2bp'
            '2bn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '2bn'
            '2r' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '2r'
            '3av' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '3av'
            '3ap' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '3ap'
            '3an' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '3an'
            '3bv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '3bv'
            '3bp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '3bp'
            '3bn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '3bn'
            '3r' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '3r'
            '4av' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '4av'
            '4ap' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '4ap'
            '4an' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '4an'
            '4bv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '4bv'
            '4bp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '4bp'
            '4bn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '4bn'
            '4cv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '4cv'
            '4cp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '4cp'
            '4cn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '4cn'
            '4r' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '4r'
            '5av' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '5av'
            '5ap' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '5ap'
            '5an' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '5an'
            '5bv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '5bv'
            '5bp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '5bp'
            '5bn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '5bn'
            '5r' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '5r'
            '6av' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '6av'
            '6ap' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '6ap'
            '6an' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '6an'
            '6bv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '6bv'
            '6bp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '6bp'
            '6bn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '6bn'
            '6r' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '6r'
            '7av' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '7av'
            '7ap' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '7ap'
            '7an' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '7an'
            '7bv' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '7bv'
            '7bp' => fake()->randomFloat(2, 0, 1), // Angka acak untuk '7bp'
            '7bn' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '7bn'
            '7r' => fake()->randomFloat(2, 0, 500), // Angka acak untuk '7r'
            'totalNilai' => fake()->randomFloat(2, 0, 80), // Total nilai, bisa lebih besar
            'tingkatKekumuhan' => fake()->randomElement(['TK', 'KR', 'KS', 'KB']), // Tingkat kekumuhan
            'ratarataKekumuhan' => fake()->randomFloat(2, 0, 1), // Rata-rata kekumuhan
            'kontribusiPenanganan' => fake()->randomFloat(2, 0, 1), // Kontribusi penanganan
        ];
    }
}