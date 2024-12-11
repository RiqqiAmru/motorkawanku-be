<?php

namespace Database\Factories;

use App\Models\Investasi;
use App\Models\Kawasan;
use App\Models\Rtrw;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investasi>
 */
class InvestasiFactory extends Factory
{
    protected $model = Investasi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tahun' => $this->faker->year(), // Tahun investasi
            'idKawasan' => Kawasan::factory(), // Relasi ke model Kawasan
            'idRTRW' => Rtrw::factory(), // Relasi ke model RTRW
            'idkriteria' => $this->faker->regexify('[1-7][a-c]'), // ID kriteria (contoh: 1a, 2b)
            'volume' => $this->faker->randomFloat(2, 1, 1000), // Volume kegiatan
            'kegiatan' => $this->faker->sentence(), // Deskripsi kegiatan
            'locked' => $this->faker->boolean(), // Status terkunci (1/0)
            'ket' => $this->faker->optional()->sentence(), // Keterangan opsional
            'id_user' => User::factory(), // Relasi ke model User
            'sumberAnggaran' => $this->faker->randomElement(['APBD', 'APBN', 'Swasta', 'CSR']), // Sumber anggaran
            'anggaran' => $this->faker->numberBetween(10000000, 1000000000), // Jumlah anggaran
        ];
    }
}
