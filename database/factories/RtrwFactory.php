<?php

namespace Database\Factories;

use App\Models\Rtrw;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rtrw>
 */
class RtrwFactory extends Factory
{
    protected $model = Rtrw::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kawasan' => 1, // Nama kawasan (kota)
            'rtrw' => $this->faker->regexify('[0-9]{2}/[0-9]{2}'), // Format RT/RW (contoh: 01/02)
            'luasFlag' => $this->faker->randomFloat(2, 0, 500), // Luas flag dalam hektar
            'luasVerifikasi' => $this->faker->randomFloat(2, 0, 500), // Luas setelah verifikasi dalam hektar
            'jumlahBangunan' => $this->faker->numberBetween(50, 500), // Jumlah bangunan
            'jumlahPenduduk' => $this->faker->numberBetween(1000, 50000), // Jumlah penduduk
            'jumlahKK' => $this->faker->numberBetween(200, 10000), // Jumlah Kepala Keluarga
            'panjangJalanIdeal' => $this->faker->randomFloat(2, 1, 50), // Panjang jalan ideal dalam kilometer
            'panjangDrainaseIdeal' => $this->faker->randomFloat(2, 1, 50),
        ];
    }
}
