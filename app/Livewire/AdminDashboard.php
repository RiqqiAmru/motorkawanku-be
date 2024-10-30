<?php

namespace App\Livewire;

use App\Models\Investasi;
use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Rtrw;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

class AdminDashboard extends Component
{
    public $tahun = null;
    public $allInvestasi = '';

    public $user = null;
    public $kawasan = null;
    public $idKawasanTerpilih = null;
    public $idRTTerpilih = null;
    public $rt = null;
    public $investasi = null;
    public $locked = false;
    public $preview = false;
    public $kumuhAwal = null;
    public $kumuhAwalArr = null;
    public $kumuhAkhir = null;
    public $header = null;


    public function swapPreview($idKawasan = null, $idRT = null)
    {
        $this->preview = !$this->preview;
        if ($idKawasan) {
            $this->idKawasanTerpilih = $idKawasan;
            $this->idRTTerpilih = $idRT;
            $this->rt = Rtrw::where(['kawasan' => $this->idKawasanTerpilih])->get(['id', 'rtrw'])->toArray();
            $this->updatedidRTTerpilih();
        }
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



        $this->header = Kawasan::find($this->idKawasanTerpilih)->toArray();

        $this->rt = Rtrw::where(['kawasan' => $this->idKawasanTerpilih])->get(['id', 'rtrw'])->toArray();
        $this->investasi = Investasi::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih])->get()->toArray();
        // $investasi = DB::table('investasi')->selectRaw('idkriteria, sum(volume),anggaran, sumberAnggaran, kegiatan')->where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih])->groupBy('idkriteria')->get()->toArray();
        // $this->investasi = $investasi;
        // dd($investasi);

        $this->kumuhAwal = KumuhKawasan::where(['tahun' => ($this->tahun - 1), 'kawasan' => $this->idKawasanTerpilih])->first();
        $this->kumuhAwalArr = $this->kumuhAwal->toArray();

        $header = Rtrw::where('kawasan', $this->idKawasanTerpilih)->get(['id', 'jumlahBangunan'])->pluck('jumlahBangunan', 'id');
        $dataVolume = $this->totalVolumeInvestasi($this->investasi, $header, true);
        $this->kumuhAkhir = $this->hitungKumuhRtAkhir($dataVolume, $this->kumuhAwal, $this->header);

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

        if ($this->idRTTerpilih == 0) {
            $this->updatedidKawasanTerpilih();
        } else {
            $this->investasi = Investasi::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih, 'idRTRW' => $this->idRTTerpilih])->get()->toArray();
            $this->header = Rtrw::find($this->idRTTerpilih);
            $this->kumuhAwal = KumuhRT::where(['tahun' => ($this->tahun - 1), 'kawasan' => $this->idKawasanTerpilih, 'rt' => $this->idRTTerpilih])->first();

            $dataVolume = $this->totalVolumeInvestasi($this->investasi, $this->header);
            $this->kumuhAkhir = $this->hitungKumuhRtAkhir($dataVolume, $this->kumuhAwal, $this->header);
        }
        $this->dispatch('updated-investasi');
    }

    public function mount()
    {
        $this->tahun = Carbon::now()->year;
        $this->allInvestasi = Investasi::where(['tahun' => $this->tahun])->orderBy('idKawasan')->get()->toArray();
        $this->allInvestasi  = DB::table('investasi')
            ->join('kawasan', 'investasi.idKawasan', '=', 'kawasan.id')
            ->join('rtrw', 'investasi.idRTRW', '=', 'rtrw.id')
            ->join('users', 'investasi.id_user', '=', 'users.id')
            ->select('investasi.*', 'kawasan.kawasan', 'rtrw.rtrw', 'users.name')->orderBy('investasi.idKawasan')->get()->toArray();
        $this->user = Auth::user();
        $this->kawasan = Kawasan::umum();
    }

    public function destroy($id)
    {
        Investasi::find($id)->delete();
        session()->flash('success', 'berhasil menghapus investasi.');
        $this->mount();
        $this->dispatch('close');
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

    public function lock($id, $kawasan)
    {
        Investasi::where(['tahun' => Carbon::now()->year, 'idKawasan' => $id])->update(['locked' => 1]);
        session()->flash('success', 'berhasil mengunci investasi ' . $kawasan);
        $this->mount();

        // input tabel kumuh
    }
    public function unlock($id, $kawasan)
    {
        Investasi::where(['tahun' => Carbon::now()->year, 'idKawasan' => $id])->update(['locked' => 0]);
        session()->flash('success', 'berhasil membuka kunci  investasi ' . $kawasan);
        $this->mount();

        // hapus kumuh
        KumuhRT::where(['tahun' => Carbon::now()->year, 'idKawasan' => $id])->delete();
        KumuhKawasan::where(['tahun' => Carbon::now()->year, 'idKawasan' => $id])->delete();
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
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
        $kumuhRTAkhir['kawasan'] = $kumuhRTAwal['kawasan'];
        $kumuhRTAkhir['rt'] = $kumuhRTAwal['rt'];
        $kumuhRTAkhir['tahun'] =  date("Y");

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
                } else {
                    $kumuhRTAkhir["{$id}v"] = max(0, $kumuhRTAwal["{$id}v"]);
                    $kumuhRTAkhir["{$id}p"] = max(0, $kumuhRTAwal["{$id}p"]);
                    $kumuhRTAkhir["{$id}n"] = max(0, $kumuhRTAwal["{$id}n"]);
                }
                $kumuhRTAkhir['totalNilai'] += intval($kumuhRTAkhir["{$id}n"]);
                $rata[] = $kumuhRTAkhir["{$id}p"];
            }
        }

        // data footer total (tingkat Kekumuhan)
        $kumuhRTAkhir['tingkatKekumuhan'] = $this->hitungTingkatKekumuhan($kumuhRTAkhir['totalNilai']);
        $kumuhRTAkhir['ratarataKekumuhan'] = count($totalRata) > 0 ? array_sum($totalRata) / count($totalRata) : 0;

        // kontribusi penanganan
        $kontribusi = ($kumuhRTAwal['ratarataKekumuhan'] - $kumuhRTAkhir['ratarataKekumuhan']) / $kumuhRTAwal['ratarataKekumuhan'];
        $kumuhRTAkhir['kontribusiPenanganan'] = min(1, $kontribusi);

        $kumuhRTAkhir['ket'] = $this->getWarnaAttribute($kumuhRTAkhir['tingkatKekumuhan']);

        return $kumuhRTAkhir;
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