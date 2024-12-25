<?php

namespace App\Livewire;

use App\Livewire\Attributes\rumusKumuh;
use App\Livewire\Forms\InvForm;
use App\Models\Kawasan;
use App\Models\Rtrw;
use App\Models\Investasi as InvestasiModel;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Number;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Investasi extends Component
{
    public $user = null;
    public $kawasan = null;
    public $idKawasanTerpilih = null;
    public $idRTTerpilih = null;
    public $rt = null;
    public $tahun = null;
    public $investasi = null;
    public $locked = false;
    public $preview = false;
    public $kumuhAwal = null;
    public $kumuhAwalArr = null;
    public $kumuhAkhir = null;
    public $header = null;


    public InvForm $form;

    public function swapPreview()
    {
        $this->preview = !$this->preview;
    }


    public function lock()
    {
        InvestasiModel::where(['tahun' => $this->tahun, 'id_kawasan' => $this->idKawasanTerpilih])->update(['locked' => 2]);
        $namaKawasan = Kawasan::where('id_kawasan', $this->idKawasanTerpilih)->get()->first()->kawasan;
        session()->flash('info', 'Berhasil Mengunci Data Investasi ' . $namaKawasan);
        $this->updatedidKawasanTerpilih();
    }

    public function save()
    {
        $this->form->store($this->tahun, $this->idKawasanTerpilih, $this->idRTTerpilih, $this->user->id_user);

        session()->flash('success', 'berhasil menambah investasi.');
        $this->updatedidRTTerpilih();
    }

    public function updatedidKawasanTerpilih()
    {
        $this->reset('rt');
        $this->reset('idRTTerpilih');
        $this->reset('investasi');
        $this->reset('locked');
        $this->reset('kumuhAwal');
        $this->reset('kumuhAwalArr');
        $this->reset('kumuhAkhir');
        $this->reset('header');
        $this->reset('preview');



        $this->header = Kawasan::find($this->idKawasanTerpilih)->toArray();

        $this->rt = Rtrw::where(['id_kawasan' => $this->idKawasanTerpilih])->get(['id_rtrw', 'rtrw'])->toArray();
        $investasi = InvestasiModel::where(['tahun' => $this->tahun, 'id_kawasan' => $this->idKawasanTerpilih])->get()->toArray();

        $this->investasi = Arr::map($investasi, function ($value) {
            return [
                ...$value,
                'anggaran' => Number::currency(intval($value['anggaran']), 'IDR', 'id')
            ];
        });
        $this->kumuhAwal = KumuhKawasan::where(['tahun' => ($this->tahun - 1), 'id_kawasan' => $this->idKawasanTerpilih])->first();

        $this->kumuhAwalArr = $this->kumuhAwal->toArray();
        // $this->kumuhAkhir = $this->hitungKumuhRtAkhir($this->investasi, $this->kumuhAwal, $this->header);

        if ($this->investasi) {
            if ($this->investasi[0]['locked'] == 1) {
                $this->locked = true;
            }
        }
        // dd($this->kumuhAkhir);
        $this->dispatch('updated-investasi');
    }

    public function updatedidRTTerpilih()
    {
        $this->reset('investasi');
        $this->reset('kumuhAwal');
        $this->reset('kumuhAkhir');
        $this->reset('header');
        $this->reset('preview');



        if ($this->idRTTerpilih == 0) {
            $this->updatedidKawasanTerpilih();
        } else {
            $investasi = InvestasiModel::where(['tahun' => $this->tahun, 'id_kawasan' => $this->idKawasanTerpilih, 'id_rtrw' => $this->idRTTerpilih])->get()->toArray();
            $this->investasi = Arr::map($investasi, function ($value) {
                return [
                    ...$value,
                    'anggaran' => Number::currency(intval($value['anggaran']), 'IDR', 'id')
                ];
            });
            $this->header = Rtrw::find($this->idRTTerpilih);
            $this->kumuhAwal = KumuhRT::where(['tahun' => ($this->tahun - 1), 'id_kawasan' => $this->idKawasanTerpilih, 'id_rtrw' => $this->idRTTerpilih])->first();

            // $this->kumuhAkhir = $this->hitungKumuhRtAkhir($this->investasi, $this->kumuhAwal, $this->header);
        }
        $this->dispatch('updated-investasi');
    }

    public function delete($param)
    {
        $this->form->delete($param);
        $this->updatedidRTTerpilih();
    }
    public function getWarnaAttribute($tingkatKekumuhan)
    {
        switch ($tingkatKekumuhan) {
            case "TK":
                return ["TIDAK KUMUH", 'text-green-600 bg-green-50'];
            case "KR":
                return ["KUMUH RINGAN", 'text-yellow-600 bg-yellow-50'];
            case "KS":
                return ["KUMUH SEDANG", 'text-orange-600 bg-orange-50'];
            case "KB":
                return ["KUMUH BERAT", 'text-red-600 bg-red-50'];
        }
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->tahun = Carbon::now()->year;

        if ($this->user->role == 'admin') {
            // ambil semua kawasan
            $this->kawasan = Kawasan::umum();
        } else {
            // hanya kawasan yang di wenangi sekaligus rt
            $this->kawasan = Kawasan::where(['id_kawasan' => $this->user->kawasan_id])->get(['id_kawasan', 'kawasan'])->first()->toArray();
            $this->idKawasanTerpilih = $this->kawasan['id_kawasan'];
            $this->updatedidKawasanTerpilih();
        }
    }

    public function render()
    {
        return view('livewire.investasi');
    }


    // // function hitungKumuhRtAkhir($investasi, $kumuhRTAwal, $headerRT, $tahun = 0)
    // // {
    //     // kumuh akhir = kumuh awal - investasi
    //     $kumuhRTAkhir = [];
    //     $kumuhRTAkhir['kawasan'] = $kumuhRTAwal['kawasan'];
    //     $kumuhRTAkhir['rt'] = $kumuhRTAwal['rt'];
    //     $kumuhRTAkhir['tahun'] = ($tahun != 0) ? $tahun : date("Y");

    //     // map investasi menjadi total volume per kriteria
    //     $dataVolume = [];
    //     if (count($investasi) > 0) {
    //         foreach ($investasi as $element) {
    //             $idKriteria = $element['idkriteria'];
    //             $volume = floatval($element['volume']);
    //             if (!isset($dataVolume[$idKriteria])) {
    //                 $dataVolume[$idKriteria] = $volume;
    //             } else {
    //                 $dataVolume[$idKriteria] += $volume;
    //             }
    //         }

    //         // investasi 2a/2b
    //         if (isset($dataVolume['2a']) | isset($dataVolume['2b'])) {


    //             // masukkan untuk 1a
    //             if (!isset($dataVolume['1a'])) {
    //                 $dataVolume['1a'] = $headerRT['jumlahBangunan'];
    //             } else {
    //                 $dataVolume['1a'] += $headerRT['jumlahBangunan'];
    //             }
    //             // masukkan untuk 7b
    //             if (!isset($dataVolume['7b'])) {
    //                 $dataVolume['7b'] = $headerRT['jumlahBangunan'];
    //             } else {
    //                 $dataVolume['7b'] += $headerRT['jumlahBangunan'];
    //             }
    //         }
    //     }

    //     // loop per id kriteria
    //     $kumuhRTAkhir['totalNilai'] = 0;
    //     $rata = [];
    //     $totalRata = [];
    //     $kriteriaid = [
    //         "1a",
    //         "1b",
    //         "1c",
    //         "1r",
    //         "2a",
    //         "2b",
    //         "2r",
    //         "3a",
    //         "3b",
    //         "3r",
    //         "4a",
    //         "4b",
    //         "4c",
    //         "4r",
    //         "5a",
    //         "5b",
    //         "5r",
    //         "6a",
    //         "6b",
    //         "6r",
    //         "7a",
    //         "7b",
    //         "7r"
    //     ];

    //     foreach ($kriteriaid as $id) {
    //         if ($id[1] == 'r') {
    //             // masukkan rata rata aspek
    //             $jumlah = array_sum($rata);
    //             $kumuhRTAkhir[$id] = $jumlah / count($rata);
    //             $totalRata[] = $kumuhRTAkhir[$id];
    //             $rata = [];
    //         } else {
    //             if (isset($dataVolume[$id])) {
    //                 $kumuhRTAkhir["{$id}v"] = $kumuhRTAwal["{$id}v"] - $dataVolume[$id];
    //                 $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAkhir["{$id}v"]);

    //                 // hitung p dan n
    //                 $kumuhRTAkhir["{$id}p"] = $this->hitungProsenKumuh($kumuhRTAkhir["{$id}v"], $id, $headerRT);
    //                 $kumuhRTAkhir["{$id}n"] = $this->hitungNilaiKumuh($kumuhRTAkhir["{$id}p"]);
    //             } else {
    //                 $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAwal["{$id}v"]);
    //                 $kumuhRTAkhir["{$id}p"] = max(0, $kumuhRTAwal["{$id}p"]);
    //                 $kumuhRTAkhir["{$id}n"] = max(0, $kumuhRTAwal["{$id}n"]);
    //             }
    //             $kumuhRTAkhir['totalNilai'] += intval($kumuhRTAkhir["{$id}n"]);
    //             $rata[] = $kumuhRTAkhir["{$id}p"];
    //         }
    //     }

    //     // data footer total (tingkat Kekumuhan)
    //     $kumuhRTAkhir['tingkatKekumuhan'] = $this->hitungTingkatKekumuhan($kumuhRTAkhir['totalNilai']);
    //     $kumuhRTAkhir['ratarataKekumuhan'] = count($totalRata) > 0 ? array_sum($totalRata) / count($totalRata) : 0;

    //     // kontribusi penanganan
    //     $kontribusi = ($kumuhRTAwal['ratarataKekumuhan'] - $kumuhRTAkhir['ratarataKekumuhan']) / $kumuhRTAwal['ratarataKekumuhan'];
    //     $kumuhRTAkhir['kontribusiPenanganan'] = min(1, $kontribusi);

    //     $kumuhRTAkhir['ket'] = $this->getWarnaAttribute($kumuhRTAkhir['tingkatKekumuhan']);

    //     return $kumuhRTAkhir;
    // // }

    // function hitungProsenKumuh($volume, $id, $headerRT)
    // {
    //     switch ($id) {
    //         case "1a":
    //         case "1c":
    //         case "7a":
    //         case "7b":
    //             return $volume / $headerRT['jumlahBangunan'];
    //         case "1b":
    //         case "4a":
    //             return $volume / $headerRT['luasVerifikasi'];
    //         case "2a":
    //         case "2b":
    //             return $volume / $headerRT['panjangJalanIdeal'];
    //         case "3a":
    //         case "3b":
    //         case "5a":
    //         case "5b":
    //         case "6a":
    //         case "6b":
    //             return $volume / $headerRT['jumlahKK'];
    //         case "4b":
    //         case "4c":
    //             return $volume / $headerRT['panjangDrainaseIdeal'];
    //         default:
    //             return 0;
    //     }
    // }

    // function hitungNilaiKumuh($prosen)
    // {
    //     if ($prosen >= 0.75995) return 5;
    //     if ($prosen >= 0.50995) return 3;
    //     if ($prosen >= 0.24995) return 1;
    //     return 0;
    // }

    // function hitungTingkatKekumuhan($nilai)
    // {
    //     if ($nilai >= 60) return "KB";
    //     if ($nilai >= 38) return "KS";
    //     if ($nilai >= 16) return "KR";
    //     return "TK";
    // }

    // function hitungProsenDanNilai($volume, $headerRT, $tahun = 0)
    // {
    //     $kumuhRTAkhir = [];
    //     $kumuhRTAkhir['kawasan'] = $volume['kawasan'];
    //     $kumuhRTAkhir['rt'] = $volume['rt'];
    //     $kumuhRTAkhir['tahun'] = ($tahun != 0) ? $tahun : date("Y");
    //     $kumuhRTAkhir['totalNilai'] = 0;
    //     $rata = [];
    //     $totalRata = [];

    //     global $kriteriaid; // Assuming $kriteriaid is defined globally as in the previous function

    //     foreach ($kriteriaid as $id) {
    //         if ($id[1] == 'r') {
    //             // masukkan rata rata aspek
    //             $jumlah = array_sum($rata);
    //             $kumuhRTAkhir[$id] = $jumlah / count($rata);
    //             $totalRata[] = $kumuhRTAkhir[$id];
    //             $rata = [];
    //         } else {
    //             $kumuhRTAkhir["{$id}v"] = $volume[$id];
    //             $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAkhir["{$id}v"]);

    //             // hitung p dan n
    //             $kumuhRTAkhir["{$id}p"] = $this->hitungProsenKumuh($kumuhRTAkhir["{$id}v"], $id, $headerRT);
    //             $kumuhRTAkhir["{$id}n"] = $this->hitungNilaiKumuh($kumuhRTAkhir["{$id}p"]);

    //             $kumuhRTAkhir['totalNilai'] += intval($kumuhRTAkhir["{$id}n"]);
    //             $rata[] = $kumuhRTAkhir["{$id}p"];
    //         }
    //     }

    //     $kumuhRTAkhir['tingkatKekumuhan'] = $this->hitungTingkatKekumuhan($kumuhRTAkhir['totalNilai']);
    //     // $kumuhRTAkhir['warna'] = $this->getWarnaAttribute($kumuhRTAkhir['tingkatKekumuhan'])[1];


    //     $kumuhRTAkhir['ratarataKekumuhan'] = count($totalRata) > 0 ? array_sum($totalRata) / count($totalRata) : 0;

    //     // kontribusi penanganan
    //     $kumuhRTAkhir['kontribusiPenanganan'] = 0; // This seems to be set but not calculated, please clarify if needed.

    //     return $kumuhRTAkhir;
    // }
}