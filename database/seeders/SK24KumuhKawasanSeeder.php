<?php

namespace Database\Seeders;

use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Rtrw;
use App\Models\SK24Kawasan;
use App\Models\SK24KumuhKawasan;
use App\Models\SK24KumuhRT;
use App\Models\SK24Rtrw;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as FacadesDB;

class SK24KumuhKawasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ambil data kumuh kawasan 2023 
        // hitung kumuh akhir tanpa investasi
        // masukkan ke tabel sk24kumuhkawasan dg tahun 2023

        FacadesDB::table('sk24_kumuh_rt')->truncate();
        FacadesDB::table('sk24_kumuh_kawasan')->truncate();

        $headerKawasan = SK24Kawasan::all()->toArray();

        $no = 1;
        foreach ($headerKawasan as $h) {
            $header = SK24Rtrw::where('kawasan', $h['id'])->get(['id'])->toArray();
            $kumuhAwal = KumuhKawasan::where(['tahun' => 2023, 'kawasan' => $h['id']])->first();
            $kumuhAkhir = $this->hitungKumuhRtAkhir([], $kumuhAwal, $h);
            Arr::forget($kumuhAkhir, 'rt');

            SK24KumuhKawasan::create(
                $kumuhAkhir
            );


            foreach ($header as $item) {
                $headerRT = SK24Rtrw::find($item['id']);
                $kumuhAwal = KumuhRT::where(['tahun' => 2023, 'kawasan' => $h['id'], 'rt' => $item['id']])->first();
                $kumuhAkhir = $this->hitungKumuhRtAkhir([], $kumuhAwal, $item);
                Arr::forget($kumuhAkhir, 'rt');
                dump($no++ . '|' . $h['id'] . '|' . $item['id']);
                if ($kumuhAwal) {
                    $kumuhAkhir = $this->hitungKumuhRtAkhir([], $kumuhAwal, $headerRT);
                    if ($h['id'] == 22 && $item['id'] == 274) {
                        SK24KumuhRT::create([
                            'rt' => '274',
                            'kawasan' => 22,
                            'tahun' => 2023,
                            '1av' => 2,
                            '1ap' => 0.377358490566038,
                            '1an' => 0,
                            '1bv' => 0,
                            '1bp' => 0,
                            '1bn' => 0,
                            '1cv' => 43,
                            '1cp' => 0.811320754716981,
                            '1cn' => 5,
                            '1r' => 0.270440251572327,
                            '2av' => 160,
                            '2ap' => 0.254,
                            '2an' => 1,
                            '2bv' => 470,
                            '2bp' => 0.74,
                            '2bn' => 3,
                            '2r' => 0.5,
                            '3av' => 42,
                            '3ap' => 0.6774,
                            '3an' => 3,
                            '3bv' => 62,
                            '3bp' => 1,
                            '3bn' => 5,
                            '3r' => 0.8387,
                            '4av' => 0.2,
                            '4ap' => 0.2159,
                            '4an' => 0,
                            '4bv' => 400,
                            '4bp' => 0.8163,
                            '4bn' => 5,
                            '4cv' => 90,
                            '4cp' => 0.1837,
                            '4cn' => 0,
                            '4r' => 0.2721,
                            '5av' => 62,
                            '5ap' => 1,
                            '5an' => 5,
                            '5bv' => 62,
                            '5bp' => 1,
                            '5bn' => 5,
                            '5r' => 1,
                            '6av' => 62,
                            '6ap' => 1,
                            '6an' => 5,
                            '6bv' => 62,
                            '6bp' => 1,
                            '6bn' => 5,
                            '6r' => 1,
                            '7av' => 53,
                            '7ap' => 1,
                            '7an' => 5,
                            '7bv' => 0,
                            '7bp' => 0,
                            '7bn' => 0,
                            '7r' => 0.5,
                            'totalNilai' => 47,
                            'tingkatKekumuhan' => 'KS',
                            'ratarataKekumuhan' => 0.6259,
                            'kontribusiPenanganan' => 0
                        ]);
                    } else {
                        SK24KumuhRT::create($kumuhAkhir);
                    }
                }
            }
        }

        // update yang keliru
        $json = file_get_contents(database_path('seeders/tambahanSK24.json'));
        $data = json_decode($json, true);
        foreach ($data as $d) {
            $headerRT = SK24Rtrw::find($d['id']);
            dump('upd' . $headerRT->kawasan . '|' . $d['id']);
            $d['kawasan'] = '';
            $d['rt'] = '';
            $kumuh = $this->hitungKumuhRtAkhir([], $d, $headerRT);
            Arr::forget($kumuh, ['kawasan', 'rt', 'tahun']);
            SK24KumuhRT::where(['rt' => $d['id'], 'kawasan' => $headerRT->kawasan])->update($kumuh);
        }

        // totalkan keseluruhan volume rt untuk mengganti kumuh kawasan
        foreach ($headerKawasan as $hk) {

            $kumuhAwal = [
                "1av" => 0,
                "1bv" => 0,
                "1cv" => 0,
                "2av" => 0,
                "2bv" => 0,
                "3av" => 0,
                "3bv" => 0,
                "4av" => 0,
                "4bv" => 0,
                "4cv" => 0,
                "5av" => 0,
                "5bv" => 0,
                "6av" => 0,
                "6bv" => 0,
                "7av" => 0,
                "7bv" => 0,
                'kawasan' => '',
                'rt' => ''
            ];
            $kumuhRT =  KumuhRT::where(['tahun' => 2023, 'kawasan' => $hk['id']])->get()->toArray();
            foreach ($kumuhRT as $kr) {
                $kumuhAwal["1av"] += $kr["1av"];
                $kumuhAwal["1bv"] += $kr["1bv"];
                $kumuhAwal["1cv"] += $kr["1cv"];
                $kumuhAwal["2av"] += $kr["2av"];
                $kumuhAwal["2bv"] += $kr["2bv"];
                $kumuhAwal["3av"] += $kr["3av"];
                $kumuhAwal["3bv"] += $kr["3bv"];
                $kumuhAwal["4av"] += $kr["4av"];
                $kumuhAwal["4bv"] += $kr["4bv"];
                $kumuhAwal["4cv"] += $kr["4cv"];
                $kumuhAwal["5av"] += $kr["5av"];
                $kumuhAwal["5bv"] += $kr["5bv"];
                $kumuhAwal["6av"] += $kr["6av"];
                $kumuhAwal["6bv"] += $kr["6bv"];
                $kumuhAwal["7av"] += $kr["7av"];
                $kumuhAwal["7bv"] += $kr["7bv"];
            }
            $kumuhAkhir = $this->hitungKumuhRtAkhir([], $kumuhAwal, $hk);
            Arr::forget($kumuhAkhir, ['rt', 'kawasan']);
            dump('upd' . $hk['kawasan']);

            SK24KumuhKawasan::where(['tahun' => 2023, 'kawasan' => $hk])->update($kumuhAkhir);
        }
    }

    function totalVolumeInvestasi($investasi, $headerRT, $kawasan = false)
    {
        $dataVolume = [];
        $idRTkrit2ab = [];
        if (count($investasi) > 0) {
            // idkriteria, idRTRW, idKawasan
            foreach ($investasi as $element) {
                $idKriteria = $element['idkriteria'];
                $volume = floatval($element['volume']);
                if ($element['idkriteria'] == '2a' || $element['idkriteria'] == '2b') {
                    $idRTkrit2ab = Arr::add($idRTkrit2ab, $element['idRTRW'], $element['idRTRW']);
                }
                if (!isset($dataVolume[$idKriteria])) {
                    $dataVolume[$idKriteria] = $volume;
                    $dataVolume["k{$idKriteria}"] = $element['kegiatan'];
                } else {
                    $dataVolume[$idKriteria] += $volume;
                    $dataVolume["k{$idKriteria}"] = $dataVolume["k{$idKriteria}"] . ', ' . $element['kegiatan'];
                }
            }

            // investasi 2a/2b
            if (isset($dataVolume['2a']) | isset($dataVolume['2b'])) {
                $jumlahBangunan = 0;
                if ($kawasan) {
                    // cari dulu rt mana yang ada pembangunan 2a/2b
                    if ($idRTkrit2ab) {
                        foreach ($idRTkrit2ab as $item) {
                            $jumlahBangunan += ($headerRT[$item]);
                        }
                    }
                } else {
                    $jumlahBangunan = ($headerRT['jumlahBangunan']);
                }
                // masukkan untuk 1a
                if (!isset($dataVolume['1a'])) {
                    $dataVolume['1a'] = $jumlahBangunan;
                } else {
                    $dataVolume['1a'] += ($jumlahBangunan);
                }
                // masukkan untuk 7b
                if (!isset($dataVolume['7b'])) {
                    $dataVolume['7b'] = $jumlahBangunan;
                } else {
                    $dataVolume['7b'] += ($jumlahBangunan);
                }
            }
        }
        return $dataVolume;
    }

    function hitungKumuhRtAkhir($dataVolume, $kumuhRTAwal, $headerRT)
    {
        // kumuh akhir = kumuh awal - investasi
        $kumuhRTAkhir = [];
        // dump($kumuhRTAwal['kawasan']);
        $kumuhRTAkhir['kawasan'] = $kumuhRTAwal['kawasan'];
        $kumuhRTAkhir['rt'] = $kumuhRTAwal['rt'];
        $kumuhRTAkhir['tahun'] =  2023;

        // map investasi menjadi total volume per kriteria


        // loop per id kriteria
        $kumuhRTAkhir['totalNilai'] = 0;
        $rata = [];
        $totalRata = [];
        $kriteriaid = [
            "1a",
            "1b",
            "1c",
            "1r",
            "2a",
            "2b",
            "2r",
            "3a",
            "3b",
            "3r",
            "4a",
            "4b",
            "4c",
            "4r",
            "5a",
            "5b",
            "5r",
            "6a",
            "6b",
            "6r",
            "7a",
            "7b",
            "7r"
        ];

        foreach ($kriteriaid as $id) {
            if ($id[1] == 'r') {
                // masukkan rata rata aspek
                $jumlah = array_sum($rata);
                $kumuhRTAkhir[$id] = $jumlah / count($rata);
                $totalRata[] = $kumuhRTAkhir[$id];
                $rata = [];
            } else {
                if (isset($dataVolume[$id])) {
                    $kumuhRTAkhir["{$id}v"] = $kumuhRTAwal["{$id}v"] - $dataVolume[$id];
                    $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAkhir["{$id}v"]);
                    $kumuhRTAkhir["k{$id}"] = isset($dataVolume["k{$id}"]) ? $dataVolume["k{$id}"] : '';
                    $kumuhRTAkhir["v{$id}"] = $dataVolume[$id];

                    // hitung p dan n
                    $kumuhRTAkhir["{$id}p"] = $this->hitungProsenKumuh($kumuhRTAkhir["{$id}v"], $id, $headerRT);
                    $kumuhRTAkhir["{$id}n"] = $this->hitungNilaiKumuh($kumuhRTAkhir["{$id}p"]);
                } elseif (isset($kumuhRTAwal["{$id}p"])) {
                    $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAwal["{$id}v"]);
                    $kumuhRTAkhir["{$id}p"] = max(0, $kumuhRTAwal["{$id}p"]);
                    $kumuhRTAkhir["{$id}n"] = max(0, $kumuhRTAwal["{$id}n"]);
                } else {
                    $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAwal["{$id}v"]);
                    $kumuhRTAkhir["{$id}p"] = $this->hitungProsenKumuh($kumuhRTAkhir["{$id}v"], $id, $headerRT);
                    $kumuhRTAkhir["{$id}n"] = $this->hitungNilaiKumuh($kumuhRTAkhir["{$id}p"]);
                }
                $kumuhRTAkhir['totalNilai'] += intval($kumuhRTAkhir["{$id}n"]);
                $rata[] = $kumuhRTAkhir["{$id}p"];
            }
        }

        // data footer total (tingkat Kekumuhan)
        $kumuhRTAkhir['tingkatKekumuhan'] = $this->hitungTingkatKekumuhan($kumuhRTAkhir['totalNilai']);
        $kumuhRTAkhir['ratarataKekumuhan'] = count($totalRata) > 0 ? array_sum($totalRata) / count($totalRata) : 0;

        // kontribusi penanganan
        if (isset($kumuhRTAwal['ratarataKekumuhan'])) {
            $kontribusi = ($kumuhRTAwal['ratarataKekumuhan'] - $kumuhRTAkhir['ratarataKekumuhan']) / $kumuhRTAwal['ratarataKekumuhan'];
            $kumuhRTAkhir['kontribusiPenanganan'] = min(1, $kontribusi);
        } else {
            $kumuhRTAkhir['kontribusiPenanganan'] = 0;
        }

        // $kumuhRTAkhir['ket'] = $this->getWarnaAttribute($kumuhRTAkhir['tingkatKekumuhan']);

        return $kumuhRTAkhir;
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

    function hitungProsenKumuh($volume, $id, $headerRT)
    {
        switch ($id) {
            case "1a":
            case "1c":
            case "7a":
            case "7b":
                return $volume / $headerRT['jumlahBangunan'];
            case "1b":
            case "4a":
                return $volume / $headerRT['luasVerifikasi'];
            case "2a":
            case "2b":
                return $volume / $headerRT['panjangJalanIdeal'];
            case "3a":
            case "3b":
            case "5a":
            case "5b":
            case "6a":
            case "6b":
                return $volume / $headerRT['jumlahKK'];
            case "4b":
            case "4c":
                return $volume / $headerRT['panjangDrainaseIdeal'];
            default:
                return 0;
        }
    }

    function hitungNilaiKumuh($prosen)
    {
        if ($prosen >= 0.75995) return 5;
        if ($prosen >= 0.50995) return 3;
        if ($prosen >= 0.24995) return 1;
        return 0;
    }

    function hitungTingkatKekumuhan($nilai)
    {
        if ($nilai >= 60) return "KB";
        if ($nilai >= 38) return "KS";
        if ($nilai >= 16) return "KR";
        return "TK";
    }

    function hitungProsenDanNilai($volume, $headerRT, $tahun = 0)
    {
        $kumuhRTAkhir = [];
        $kumuhRTAkhir['kawasan'] = $volume['kawasan'];
        $kumuhRTAkhir['rt'] = $volume['rt'];
        $kumuhRTAkhir['tahun'] = ($tahun != 0) ? $tahun : date("Y");
        $kumuhRTAkhir['totalNilai'] = 0;
        $rata = [];
        $totalRata = [];

        global $kriteriaid; // Assuming $kriteriaid is defined globally as in the previous function

        foreach ($kriteriaid as $id) {
            if ($id[1] == 'r') {
                // masukkan rata rata aspek
                $jumlah = array_sum($rata);
                $kumuhRTAkhir[$id] = $jumlah / count($rata);
                $totalRata[] = $kumuhRTAkhir[$id];
                $rata = [];
            } else {
                $kumuhRTAkhir["{$id}v"] = $volume[$id];
                $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAkhir["{$id}v"]);

                // hitung p dan n
                $kumuhRTAkhir["{$id}p"] = $this->hitungProsenKumuh($kumuhRTAkhir["{$id}v"], $id, $headerRT);
                $kumuhRTAkhir["{$id}n"] = $this->hitungNilaiKumuh($kumuhRTAkhir["{$id}p"]);

                $kumuhRTAkhir['totalNilai'] += intval($kumuhRTAkhir["{$id}n"]);
                $rata[] = $kumuhRTAkhir["{$id}p"];
            }
        }

        $kumuhRTAkhir['tingkatKekumuhan'] = $this->hitungTingkatKekumuhan($kumuhRTAkhir['totalNilai']);
        // $kumuhRTAkhir['warna'] = $this->getWarnaAttribute($kumuhRTAkhir['tingkatKekumuhan'])[1];


        $kumuhRTAkhir['ratarataKekumuhan'] = count($totalRata) > 0 ? array_sum($totalRata) / count($totalRata) : 0;

        // kontribusi penanganan
        $kumuhRTAkhir['kontribusiPenanganan'] = 0; // This seems to be set but not calculated, please clarify if needed.

        return $kumuhRTAkhir;
    }
}
