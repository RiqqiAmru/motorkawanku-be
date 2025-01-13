<?php

namespace Database\Seeders;

use App\Livewire\AdminDashboard;
use App\Livewire\Investasi;
use App\Models\Investasi as ModelsInvestasi;
use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class inputKumuhAkhirTanpaInvestasi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KumuhRT::where('tahun', 2025)->delete();
        KumuhKawasan::where('tahun', 2025)->delete();
        $adminDashboard = new AdminDashboard();
        // sekarang akhir tahun 2024
        // tombol unntuk input data kumuh akhir tanpa investasi
        // foreach data investasi dan ambil data kawasan
        $investasi = ModelsInvestasi::where('tahun', 2024)->get()?->toArray();
        $daftarKawasan = Kawasan::all()->toArray();

        if (empty($investasi)) {
            // jika tidak ada investasi, maka semua kawasan akan dijadikan kumuh akhir
            foreach ($daftarKawasan as $kawasan) {
                $adminDashboard->lock($kawasan['id_kawasan'], $kawasan['kawasan'], 2024);
                var_dump('in' . $kawasan['kawasan']);
            }
        } else {
            // bandingkan dengan seluruh kawasan, dapatkan daftar kawasan yang tidak ada investasi
            $kawasanTanpaInvestasi = [];
            foreach ($daftarKawasan as $kawasan) {
                $idKawasan = $kawasan['id_kawasan'];
                $adaInvestasi = false;
                foreach ($investasi as $dataInvestasi) {
                    if ($dataInvestasi['id_kawasan'] === $idKawasan) {
                        $adaInvestasi = true;
                        break;
                    }
                }
                if (!$adaInvestasi) {
                    $kawasanTanpaInvestasi[] = $kawasan;
                }
            }

            foreach ($kawasanTanpaInvestasi as $kawasan) {
                $adminDashboard->lock($kawasan['id_kawasan'], $kawasan['kawasan'], 2024);
                var_dump('in' . $kawasan['kawasan']);
            }
        }
    }
}