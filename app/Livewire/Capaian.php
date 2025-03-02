<?php

namespace App\Livewire;

use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Rtrw;
use App\Models\SK24Kawasan;
use App\Models\SK24KumuhKawasan;
use App\Models\SK24KumuhRT;
use App\Models\SK24Rtrw;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;

class Capaian extends Component
{
    public $kawasan = null;
    public $idKawasanTerpilih = null;
    public $tahun = null;
    public $namaKawasan = null;
    public $daftarRT = null;
    public $kumuhKawasan = null;
    public $luasVerifikasiyangSudahBerkurang = 0;
    public $test = '';

    public array $kumuhRT;

    public function mount()
    {
        $this->kawasan = SK24Kawasan::umum();
        $this->tahun = Carbon::now()->year;
        $this->test = DB::table('sk24_kumuh_rt')
            ->join('sk24_rtrw', 'sk24_kumuh_rt.rt', '=', 'sk24_rtrw.id')
            ->join('sk24_kawasan', 'sk24_kumuh_rt.kawasan', '=', 'sk24_kawasan.id')
            ->select(['sk24_kawasan.kawasan', 'sk24_kumuh_rt.totalNilai', 'sk24_rtrw.rtrw'])
            ->get()->toArray();
        $this->updatedidKawasanTerpilih();
    }

    public function updatedidKawasanTerpilih()
    {
        $this->reset('namaKawasan');
        $this->reset('daftarRT');
        $this->reset('kumuhKawasan');
        $this->reset('kumuhRT');

        $this->namaKawasan = SK24Kawasan::where('id', $this->idKawasanTerpilih)->get('kawasan')->first()?->toArray();
        if ($this->namaKawasan) {
            $this->daftarRT = SK24Rtrw::where(['kawasan' => $this->idKawasanTerpilih])?->pluck('rtrw', 'id')->all();
            $this->kumuhKawasan = SK24KumuhKawasan::join('sk24_kawasan', 'sk24_kawasan.id', '=', 'sk24_kumuh_kawasan.kawasan')
                ->where('sk24_kumuh_kawasan.kawasan', $this->idKawasanTerpilih)
                ->orderBy('sk24_kumuh_kawasan.tahun')
                ->get(['sk24_kumuh_kawasan.tahun', 'sk24_kumuh_kawasan.totalNilai', 'sk24_kumuh_kawasan.tingkatKekumuhan', 'sk24_kumuh_kawasan.tahun', 'sk24_kawasan.luasVerifikasi', 'sk24_kawasan.id']);



            $kumuhRT = SK24KumuhRT::join('sk24_rtrw', 'sk24_rtrw.id', '=', 'sk24_kumuh_rt.rt')
                ->where('sk24_kumuh_rt.kawasan', $this->idKawasanTerpilih)
                ->get(['sk24_kumuh_rt.rt', 'sk24_kumuh_rt.tahun', 'sk24_kumuh_rt.totalNilai', 'sk24_kumuh_rt.tingkatKekumuhan', 'sk24_rtrw.luasVerifikasi']);

            $this->kumuhRT = $kumuhRT->groupby('rt')->all();

            // Initialize variables to store total luasVerifikasi for kawasan and for 'Tidak Kumuh'


            // Loop through the results to adjust luasVerifikasi based on tingkatKekumuhan
            $this->luasVerifikasiyangSudahBerkurang = SK24Kawasan::where('id', $this->idKawasanTerpilih)->get('luasVerifikasi')->first()?->luasVerifikasi;
            $kumuhRT = SK24KumuhRT::join('sk24_rtrw', 'sk24_rtrw.id', '=', 'sk24_kumuh_rt.rt')
                ->where('sk24_kumuh_rt.kawasan', $this->idKawasanTerpilih)
                ->where('sk24_kumuh_rt.tahun', Carbon::now()->year)
                ->get(['sk24_kumuh_rt.rt', 'sk24_kumuh_rt.tahun', 'sk24_kumuh_rt.totalNilai', 'sk24_kumuh_rt.tingkatKekumuhan', 'sk24_rtrw.luasVerifikasi']);
            foreach ($kumuhRT as $record) {
                // If tingkatKekumuhan is 'Tidak Kumuh', set luasVerifikasi to 0 and add to total for 'Tidak Kumuh'
                if ($record->tingkatKekumuhan == 'TK') {
                    $this->luasVerifikasiyangSudahBerkurang -= $record->luasVerifikasi;
                }
            }
        } else {
            $this->daftarRT = SK24Kawasan::pluck('kawasan', 'id')->all();
            $kumuhRT = SK24KumuhKawasan::join('sk24_kawasan', 'sk24_kawasan.id', '=', 'sk24_kumuh_kawasan.kawasan')
                ->get(['sk24_kumuh_kawasan.kawasan', 'sk24_kumuh_kawasan.tahun', 'sk24_kumuh_kawasan.totalNilai', 'sk24_kumuh_kawasan.tingkatKekumuhan', 'sk24_kawasan.luasVerifikasi']);

            // sum total nilai kumuh kawasan per tahun
            $kumuhPerTahun = $kumuhRT->groupby('tahun')->all();
            foreach ($kumuhPerTahun as $tahun => $kumuh) {
                $totalNilai = 0;
                $totalLuasVerifikasi = 0;
                foreach ($kumuh as $record) {
                    $totalNilai += $record->totalNilai;
                    $totalLuasVerifikasi += $record->luasVerifikasi;
                }
                $totalNilai = $totalNilai / count($kumuh);
                $ket = $this->getWarnaAttribute($this->hitungTingkatKekumuhan($totalNilai));
                $this->kumuhKawasan[$tahun] = [
                    'totalNilai' => $totalNilai,
                    'totalLuasVerifikasi' => $totalLuasVerifikasi,
                    'tahun' => $tahun,
                    'tingkatKekumuhan' => $ket,
                ];
            }
            $this->kumuhRT = $kumuhRT->groupby('kawasan')->all();
        }
    }

    function hitungTingkatKekumuhan($nilai)
    {
        if ($nilai >= 60) return "KB";
        if ($nilai >= 38) return "KS";
        if ($nilai >= 16) return "KR";
        return "TK";
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

    public function render()
    {

        return view('livewire.capaian');
    }
}